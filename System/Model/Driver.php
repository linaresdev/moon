<?php
namespace Moon\Model;

use Illuminate\Pagination\Paginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Driver extends Model {

    protected $table = 'drivers';

    protected $fillable = [
        "id",
        "parent",
        "type",
        "file",
        "state",
        "align",
        "created_at",
        "updated_at"
    ];

    ## ATTRIBUTE
    //((object) array_merge(($app = new $value)->info(), $app->app()))
    public function file(): Attribute 
    {
        return Attribute::make(
            get: fn ($value) => new \Moon\Model\Support\Driver($value)
        );
    }

    ## VALIDATE
    public function has($driver) {
        return ((new self)->where("file", $driver)->count() > 0);
    }

    public function makeNameSpace($slug) 
    {
        if( is_string($slug) ) {
            return $slug;
        } elseif(is_object($slug)) {
            return get_class($slug);
        }
    }

    public function add($driver, $parent=0) 
    {
        try {
            if( !empty( ($namespace = $this->makeNameSpace($driver)) ) && !$this->has($namespace) ) 
            {
                if( class_exists($namespace) ) 
                {
                    $data["token"]      = $app["token"] ?? null;
                    $data["file"]       = $namespace;

                    $app = ($driver = (new $namespace))->app();                    
                    
                    $data["type"]       = $app["type"] ?? "zombie";
                    $data["parent"]     = $parent;
                    $data["state"]      = $app["activated"] ?? 0;

                    if( ($create = $this->create($data)) ) 
                    {
                        $ID = $create->id;

                        if( method_exists($driver, "drivers") ) 
                        {
                            if( !empty( ($parents = $driver->drivers()) ) && is_array($parents) ) 
                            {
                                foreach($parents as $parent ) {
                                    (new self)->add($parent, $ID);
                                }
                            }
                        }
                    }
                }
            //return $this->create(["file" => $namespace]);
            }
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }


}