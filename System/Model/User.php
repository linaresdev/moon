<?php
namespace Moon\Model;

/*
*---------------------------------------------------------
* ©Delta
*---------------------------------------------------------
*/

use Moon\Core\Support\Guard;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Moon\Model\Group;

use Illuminate\Pagination\Paginator;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class User extends Authenticatable
{
    protected $fillable = [
        'code',
        'name',
        'email',
        "user",
        "activated",
        'password',
        "meta",
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function meta(): Attribute {
        return Attribute::make(
            set: fn ($value) => (new UserMeta($value))->save(),
            get: fn ($value) => (new UserMeta($value))->data()
        );
    }

    public function password(): Attribute {        
        return Attribute::make(
            set: fn ($value) => bcrypt($value)
        );
    }

    public function getFromCode($code) {
        return $this->where("code", $code)->first() ?? null;
    }

    // public function usrGroup() {
    //     return $value;
    // }

    public function options() {
        return $this->morphMany(\Moon\Model\Option::class, "optionable");
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
            return $option->update(["key" => $key, "value" => $value]);
        }
    }

    public function loadOptions() 
    {
        if( !empty($this->options) ) {
            foreach( $this->options as $row ) {
                app("config")->set($row->key, $row->value);
            }
        }
    }

    public function policies() {
        return $this->morphMany(\Moon\Model\Policy::class, "policiable");
    }

    public function hasPolicy( $rol ) {
        return ($this->policies()->where("rol", $rol)->count() > 0);
    }

    public function addPolicy( $rol )
    {
        if( !$this->hasPolicy($rol) ) {
            return $this->policies()->create(["rol" => $rol]);
        }
    }

    public function deleteRol( $rol )
    {
        if( $this->hasPolicy($rol) ) {
            return $this->policies()->create(["rol" => $rol]);
        }
    }

    public function media() {
        return $this->morphMany(\Moon\Model\Media::class, "mediable");
    }

    public function metas() {
        return $this->morphMany(\Moon\Model\Meta::class, "metable");
    }

    public function addInfo($data)
    {
        if( !empty($data) && is_array($data) ) 
        {
            foreach($data as $slug => $value) {
                $this->metas()->create([
                    "type" => "info", "slug" => $slug, "meta" => $value
                ]);
            }
        }

        return $this;
    }

    public function getInfo($slug, $default=null) 
    {
        if( ($data = $this->metas()->where("type", "info")->where("slug", $slug))->count() > 0 ) {
            return $data->first()->meta;
        }

        return $default;
    }

    public function updateOrCreateInfo( $data )
    {
        $flat = true;

        foreach($data as $key => $value ) 
        {
            if( ($info  = $this->metas()->where("type", "info")->where("slug", $key))->count() > 0 ) {
                if( !$info->first()->update(["meta" => $value]) )  {
                    $flat = false;
                }
            }
            else {
                if($this->metas()->create(["slug" => $key, "meta" => $value]) ) {
                    $flat = false;
                }
            }
        }

        return $flat;
    }

    public function meton($type) {
        return new \Moon\Model\Support\MetaType(
            $this->metas()->where("type", $type)->get()
        );
    }

    public function getMeta($slug) {
        if( ($data = $this->metas()->where("slug", $slug))->count() > 0 ) {
            return $data->first()->meta;
        }
    }

    public function hasMeta($slug) {
        return $this->metas()->where("slug", $slug)->count() > 0;
    }

    public function addRowMeta( $slug, $data ) 
    {  
        if( !empty( ($metas = $this->getMeta($slug)) ) ) {
            
            $metadata = $metas->meta;

            foreach( $data as $row ) {
                $metadata[] = $row;
            }

            $metas->meta = $metadata;

            return $metas->save();
        }
        
        return $this->metas()->create([
            "slug" => $slug,
            "meta" => $data
        ]);
    }

    public function createMeta( $slug, $data ) {       
        return $this->metas()->create(["slug" => $slug, "meta" => $data]);
    }

    public function addOrupdateMeta($slug=null, $meta=null)
    {
        if( $this->hasMeta($slug) ) 
        {
            $data = $this->metas()->where("slug", $slug)->first();
            $data->meta = $meta;
            
            return $data->save();
        }

        return $this->metas()->create(["slug" => $slug, "meta" => $meta]);
    }

    public function meshMeta($slug, $data)
    { 
        if( ($meta  = $this->metas()->where("slug", $slug))->count() > 0 )
        {
            $meta   = $meta->first();
            $stors  = $meta->meta;

            foreach( $data as $key => $value ) {
                $stors[$key] = $value;
            }     
            
            $meta->meta = $stors;
            
            return $meta->save();
        }
    }

    public function groups(): MorphToMany 
    {
        return $this->morphToMany(\Moon\Model\Group::class, "groupable");
    }
    public function getGR() {
        return $this->groups()->whereIn("type", ["GR", "UO"])->get();
    }
    public function grType($data) {
        return $this->groups()->whereIn("type", $data)->get();
    }
    public function getRO() {
        return $this->groups()->where("type", "RO")->get();
    }
    public function getROIDS() 
    {
        $ids=[];

        foreach( $this->groups()->where("type", "RO")->get() as $row ) {
            $ids[] = $row->id;
        }

        return $ids;
    }

    public function rols( $default = [] )
    {
        $data = [];

        foreach( $this->groups()->where("type", "RO")->get() as $row ) {
            $data[] = $row->slug;
        }

       return $data;
    }

    public function rol($slug=null) 
    {
        if( ($group = $this->group($slug)) ?? false ) {
            return $group->rols();
        }

        return [];
    }

    public function hasRol( $rol ) {
        return in_array( $rol, $this->rols() );
    }

    public function devices() {
        return $this->morphToMany(\Moon\Model\Device::class, "deviceable");
    }

    public function avatar() {
        return $this->morphOne(\Moon\Model\Avatar::class, "avatable");
    }

    public function createAvatar($data)  {
        return $this->avatar()->create($data);
    }

    public function updateAvatar($data) {
        $this->avatar->update($data);
        return $this->avatar;
    }

    public function saveOrUpdateAvatar($data) {

        if( empty($this->avatar) ) {
            return $this->createAvatar($data);
        }

        return $this->updateAvatar($data);
    }

    public function getAvatar()
    {
        if( $this->avatar != null) {
            if( app("files")->exists(__path("{base}/public/".$this->avatar->url)) ) {
                return $this->avatar->url;
            }
        }

        return "cdn/images/users/avatar.png";
    }

    public function getAvatares() {
        if( $this->avatar != null ) {
            return $this->avatar->getAvatares();
        }
    }

    public function group($slug) {
        return $this->groups()->where("slug", $slug)->first();
    }    

    public function isGroup( $slug ) { 
        return ($this->groups()->where("slug", $slug)->count() > 0);
    }
    public function hasAnyGroup($slug) {
        return ($this->groups()->where("slug", "LIKE", $slug.'%')->count() > 0) ;
    }
    public function sameGroup($slug) {
        return $this->groups()->where("slug", "LIKE", $slug.'%')->get();
    }

    public function getSameGroup($slug)
    {
        foreach( $this->groups as $row ) {
            if( \Str::is("$slug*", $row->slug) ) {
                return $row;
            }
        }        
    }

    public function getMechanicGroup($slug) {
        return $this->groups()->where('slug', "mechanic-$slug")->first();
    }

    public function attachGroup($slug=null )
    {
        if( !empty($slug) )
        {
            if( ($group = (new Group)->where("slug", $slug)->first() ?? false) )
            {
                ## Agregar a grupo
                $group->users()->attach($this->id);

                ## Touched counter
                #$group->increment('counter');  
                
                ## Touched counter parent
                // if( $group->parentID() > 0 ) {             

                //     $row = (new Group)->find($group->parentID());
                //     $row->increment('counter');
                    
                //     if( $row->parentID() > 0 )
                //     {
                //         $row1 = (new Group)->find($row->parentID());
                //         $row1->increment('counter');

                //         if( $row1->parentID() > 0 ) {
                            
                //             $row2 = (new Group)->find($row1->parentID());
                //             $row2->increment('counter');

                //             if( $row2->parent > 0 ) {
                //                 $row3 = (new Group)->find($row2->parentID());
                //                 $row3->increment('counter');
                //             }
                //         }
                //     }                    
                // }
            }
        }
    }
    ## NEWS
    public function news() {
        return $this->morphMany(\Moon\Model\News::class, "newsable");
    }

    public function newsUserInfo($messages=null) {

        $agent = request()->userAgent();
        $guard = (new \Moon\Support\Guard);
        $meta  = [
            "ip_address"    => request()->ip(),
            "agent"         => $agent,
            "path"          => request()->path(),
            "device"        => $guard->device($agent),
            "platform"      => $guard->getPlatform($agent),
            "browser"       => $guard->getBrowser($agent),
            "robot"         => $guard->getRobot($agent),
        ];

        $meta["message"]    = $messages;

        return $meta;
    }

    ## Securities
    public function getConnections( $paginate ) {
        Paginator::useBootstrapFive();
        return $this->news()->where("header", "login")
            ->orWhere("header", "logout")->paginate( $paginate );
    }

    public function addNews( $header="info", $title=null, $messages=[] )
    {        
        return $this->news()->create([
            "header"    => $header,
            "title"     => $title,
            "meta"      => $this->newsUserInfo($messages)
        ]);
    } 

    public function session() {
        return $this->hasMany(\Moon\Model\Session::class);
    }

    public function currentSession() {
        return $this->session->last();
    }
    
    ## User Policies
    public function policieDefault() {
        return [
            __("user.view")     => "user-view",
            __("user.update")   => "user-update",
            __("user.insert")   => "user-insert",
            __("user.delete")   => "user-delete",
        ];
    }
}