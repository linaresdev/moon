<?php
namespace Moon\Model;

/*
*---------------------------------------------------------
* ©Delta
*---------------------------------------------------------
*/

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Media extends Model {

    protected $table = 'medias';

    protected $fillable = [
        "mediable_type",
        "mediable_id",
        "type",
        "description",
        "url",
        "created_at",
        "updated_at"
    ];
}