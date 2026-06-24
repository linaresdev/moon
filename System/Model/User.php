<?php
namespace Moon\Model;

use Moon\Support\Guard;
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
        "rol",
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

    public function postable() {
        return $this->morphMany(\Moon\Model\Post::class, "postable");
    }

    public function addEntry($data) {
        return $this->postable()->create($data);
    }

    public function options() {
        return $this->morphMany(\Moon\Model\Option::class, "optionable");
    }

    public function hasOption($key) {
        return ($this->options()->where("key", $key)->count() > 0);
    }

    public function addOption($key, $value) {
        return $this->options()->create(["key" => $key, "value" => $value]);
    }

    public function addOrUpdateOption($key, $value) 
    {
        if( ( $opt = $this->options()->where("key", $key) )->count() > 0 ) {
            return ($opt->first())->update(["key" => $key, "value" => $value]);
        }
        else {
            return $this->addOption($key, $value);
        }
    }

    public function updateOption( $key, $value ) 
    {
        if( ($option = $this->options()->where("key", $key))->count() > 0 ) {
            return ($option->first())->update(["key" => $key, "value" => $value]);
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
    
    ### Info
    public function info($slug=null, $default=null)
    {
        if( !empty($slug) && $this->metas ) 
        {
            $data = $this->metas->where("type", "info")->where("slug", $slug);
            if( $data->count() > 0 ) {
                return ($data->first())->meta;
            }

            return $default;
        }

        return new \Moon\Model\Support\UserInfo($this->metas->where("type", "info"));
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
    

    public function hasInfo($slug=null) {
        return ($this->metas()->where("type", "info")->where("slug", $slug)->count() > 0);
    }

    public function createInfo($slug, $value) 
    {
        return $this->metas()->create([
            "type" => "info",
            "slug" => $slug,
            "meta" => $value
        ]);
    }

    public function updateInfo( $slug=null, $value=null ) 
    {
        $data = $this->metas()->where("type", "info")
            ->where("slug", $slug)->first();
        
        $data->meta = $value;

        return $data->save();
    }

    public function saveInfo($data=[]) 
    {
        $out = true;
         
        if( !empty($data) )
        { 
            foreach( $data as $slug => $value ) 
            {
                if( $this->hasInfo($slug) ) {
                    if(!$this->updateInfo($slug, $value)) {
                        $out = false;
                        
                        return $out;
                    }
                }
                else {
                    if( !$this->createInfo($slug, $value)) {
                        $out = false;
                        return $out;
                    }
                }                
            }
            
        }      
                    
        return $out;
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
    
    public function addOrUpdateMeta($slug=null, $meta=null)
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

    public function inRol( $slug ) {
        return ($this->groups->where("slug", $slug)->count() > 0);
    }

    public function hasRol( $rol ) {
        return in_array( $rol, $this->rols() );
    }

    public function isSupervisor() {
        $dep = __segment(2);
        return $this->hasRol("supervisor-$dep-view");        
    }

    public function getSupervisor($slug) 
    {
        if( ( $group = (new Group)->where("slug", $slug)->first()) ?? false )
        {
            $oopls = [];
            
            foreach( $group->users as $row ) {
                $pools[] = $row->user;
            }

            return $pools;
        }

        return [];
    }

    public function authAdminFromCosole($password)
    {
        $root = $this->where("email", "admin@deltacomercial.com.do")
            ->first() ?? false;
        
        if( $root != false ) {
            return \Hash::check($password, $root->password);
        }

        return false;
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

    public function getAvatares() 
    {
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
            "date"      => date("Ymd"),
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