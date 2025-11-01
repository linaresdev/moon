<?php
namespace Moon\Model;

/*
*---------------------------------------------------------
* ©Delta
*---------------------------------------------------------
*/

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Policy extends Model {

    protected $table = 'policies';

    protected $fillable = [
        "id", 
        "policiable_type",
        "policiable_id",
        "rol",
    ];

    public $timestamps = false;

    public function users() {
        return $this->belongsTo(
            \Moon\Model\User::class, "policiable_id", "id"
        );
    }   
}