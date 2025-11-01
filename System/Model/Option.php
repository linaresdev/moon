<?php
namespace Moon\Model;

/*
*---------------------------------------------------------
* ©Delta
*---------------------------------------------------------
*/

use Illuminate\Database\Eloquent\Model;

class Option extends Model {

    protected $table = 'options';

    protected $fillable = [
        "id", 
        "key",
        "value",
        "activated"
    ];

    public $timestamps = false;

    public function users() {
        return $this->belongsTo(\Moon\Model\User::class, "optionable_id", "id");
    }
}