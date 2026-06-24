<?php
namespace Moon\Model;

/*
*---------------------------------------------------------
* ©Delta
*---------------------------------------------------------
*/

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Meta extends Model {

    protected $table = 'metas';

    protected $fillable = [
        "id", 
        "metable_type",
        "metable_id",
        "type",
        "slug",
        "meta",
    ];

    public $timestamps = false;

    public function users() {
        return $this->belongsTo(
            \Moon\Model\User::class, "optionable_id", "id"
        );
    }

    // public function meta(): Attribute {
    //     return Attribute::make(
    //         set: fn ($value) => json_encode($value),
    //        // get: fn ($value) => (array) json_decode($value)
    //     );
    // }    
}