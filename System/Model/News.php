<?php
namespace Moon\Model;

/*
*---------------------------------------------------------
* ©Delta
*---------------------------------------------------------
*/

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class News extends Model {

    protected $table = 'news';

    protected $fillable = [
        "id",
        "newsable_type",
        "newsable_id",
        "header",
        "title",
        "meta",
        "activated",
        "created_at",
        "updated_at"
    ];

    public function meta(): Attribute {
        return Attribute::make(
            set: fn ($value) => json_encode($value),
            get: fn ($value) => (array) json_decode($value)
        );
    }

}