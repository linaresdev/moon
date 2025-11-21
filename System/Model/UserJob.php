<?php
namespace Moon\Model;

use Moon\Model\UserMeta;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class UserJob extends Model 
{
    protected $table = 'userjobs';

    protected $fillable = [
        "id", 
        "type", 
        "email", 
        "subject",
        "zip",
        "meta",
        "activated",
        "created_at",
        "updated_at"
    ];    

    public function meta(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => (new UserMeta($value))->save(),
            get: fn ($value) => (new UserMeta($value))->data()
        );
    }

    public function zip(): Attribute {        
        return Attribute::make(
            set: fn ($value) => bcrypt($value)
        );
    }
}