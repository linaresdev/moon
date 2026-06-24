<?php
namespace Moon\Model;

use Illuminate\Pagination\Paginator;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

use Illuminate\Database\Eloquent\Model;

class Post extends Model {

    protected $table = 'posts';

    protected $fillable = [
        "id",
        "postable_type",
        "postable_id",
        "parent",
        "type",
        "author",
        "author_name",
        "author_email",
        "title",
        "body",
        "share",
        "state",
        "visibility",
        "password",
        "published_at",
        "comment_state",
        "comment_counter",
        "ip_address",
        "user_agent",
        "created_at",
        "updated_at"
    ];



    ## AUTHOR
    public function author(): Attribute {
        return Attribute::make(
            #set: fn ($value) => (new UserMeta($value))->save(),
            get: fn ($value) => (new \Moon\Model\User)->find($value)
        );
    }
    
    public function authorName() {
        return $this->author->name ?? null;
    }
    public function authorRol() 
    {
        if($this->author->rol ?? null ) {
            return __("words.{$this->author->rol}");
        }
    }

    public function authorPhone() {
        return $this->author->info("phone");
    }
    public function authorSmartphone() {
        return $this->author->info("smartphone");
    }
    public function authorExtPhone() {
        return $this->author->info("extension");
    }

    public function avatable() {
        return $this->morphOne(\Moon\Model\Avatar::class, "avatable");
    }

    public function addAvatar($data)  {
        return $this->avatable()->create($data);
    }

    public function commentable() {
        return $this->morphMany(\Moon\Model\Comment::class, "commentable");
    }

    public function addComment($data) {
        return $this->commentable()->create($data);
    }

    public function dateHuman() {
        return $this->created_at->diffForHumans();
    }
    public function devices() {
        return $this->morphToMany(\Moon\Model\Device::class, "deviceable");
    }

    public function groupable(): MorphToMany 
    {
        return $this->morphToMany(\Moon\Model\Group::class, "groupable");
    }

    public function password(): Attribute {        
        return Attribute::make(
            set: fn ($value) => bcrypt($value)
        );
    }

    public function metable() {
        return $this->morphMany(\Moon\Model\Meta::class, "metable");
    }

    public function addMeta( $type, $data ) 
    {
        foreach($data as $key => $value ) {
            $this->metable()->create(["slug" => $key, "meta" => $value]);
        }
    }

    public function optionable() {
        return $this->morphMany(\Moon\Model\Option::class, "optionable");
    }

}