<?php
namespace Moon\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Group extends Model {

    protected $table = 'groups';

    protected $fillable = [
        "groupable_type",
        "groupable_id",
        "type",
        "parent",
        "slug",
        "icon",
        "name",
        "description",
        "counter",
        "meta",
        "created_at",
        "updated_at"
    ];   

    public function options() {
        return $this->morphMany(\Moon\Model\Option::class, "optionable");
    }

    public function getOption($key)
    {
        if( ($data = $this->options()->where("key", $key))->count() > 0 ) {
            return $data->first()->value;
        }
    }

    public function hasOption($key) {
        return ($this->options()->where("key", $key)->count() > 0);
    }

    public function addOption($key, $value) {
        return $this->options()->create(["key" => $key, "value" => $value]);
    }

    public function updateOption( $key, $value ) 
    {
        if( ($option = $this->options()->where("key", $key))->count() > 0 ) {
            return $option->update(["value" => $value]);
        }
    }

    public function users() {
        return $this->morphedByMany(\Moon\Model\User::class, "groupable");
    }

    public function parent(): Attribute {
        return Attribute::make(
            set: fn ($value) => $this->setParentData($value),
            //get: fn ($value) => $this->getParentData($value)
        );
    }    
    
    public function setParentData($value)
    {
        if( is_numeric($value) ) {
            return $value;
        }

        if( is_string($value) ) {
            return ( new self )->where("slug", $value)->first()->id;
        }
    }

    public function postable() {
        return $this->morphMany(\Moon\Model\Post::class, "postable");
    }

    public function addPost($data) 
    {          
        $data["ip_address"] = request()->ip();
        $data["user_agent"] = request()->userAgent();

        return $this->postable()->create($data);
    }

    public function getParentData() {
        return (new self)->where("parent", $this->id)->get() ?? null;
    }

    public function meta(): Attribute {
        return Attribute::make(
            set: fn ($value) => json_encode($value),
            get: fn ($value) => (array) json_decode($value)
        );
    }

    public function link($key)
    {
        if( array_key_exists("link", $this->meta) ) {
            if( isset( $this->meta["link"]->{$key}) ) {
                return $this->meta["link"]->{$key};
            }
        }
    }

    public function parentID() {
        return $this->attributes["parent"];
    }
    public function parentIDS()
    {
        $IDS=[];

        foreach( $this->where("parent", $this->id)->get() as $row ) {
            $IDS[] = $row->id;
        }

        return $IDS;
    }

    public function parents() {        
        return  (new self)->where("parent", $this->attributes["id"])->get();
    }

    public function rols() 
    {
        $data = (new self)->where("parent", $this->attributes["id"])
            ->where("type", "RO")->get();

        $rols = null;
        foreach($data as $row) {
            $rols[] = $row->slug;
        }

        return $rols;
    }

    public function mechanicHomeWork() {
        return (new self)->where("slug", "mechanic-$this->slug")->first() ?? null;            
    }

    ## GROUPS
    public function getGroup($slug) {
        return $this->where("slug", $slug)->first();
    }

    public function getSupervsores() 
    {
        $parent     = $this->id;
        $slug       = "supervisor-".$this->slug;
        $data = (new self)->where("parent", $parent)->where("slug", $slug)->first();

        if( $data ?? false ) {
            return $data->users;
        }
    }

    public function type($type=null) 
    {
        if( is_string($type) ) {
            return $this->where("type", $type)->where("parent", $this->id)->get();
        }

        if( is_array($type) ) {
            return $this->whereIn("type", $type)->where("parent", $this->id)->get();
        }
    }

    public function getUserFromSlug( $slug ) {
        if( ($data = $this->where("slug", $slug)->first()) ?? false ) {
            return $data->users;
        }
    }

    ## ROLS

    public function hasRO() {
        return ( $this->where("type", "RO")->count() > 0 );
    }

    public function getRO() {
        return $this->where("type", "RO")->where("parent", $this->id)->get();
    }

    public function supervisores() {
        $data = $this->parents()->where(
            "slug", "supervisor-".$this->slug
            )->first();

        if( $data ?? false ) {
            return $data->users;
        }
    }

    public function getMechanics($user) 
    {
        $GR = (new self)->where(
            "slug", "mechanic-".$this->slug."-".$user
        )->first();

        if( $GR->users->count() > 0 ) {
            return $GR->users;
        }
        else {
            $GR = (new self)->where("slug", "mechanic-$this->slug")->first();
            return $GR->users;
        }
    }
}