<?php
namespace Moon\Model;

use Illuminate\Database\Eloquent\Model;

class Avatar extends Model 
{
    protected $table = 'avatars';

    protected $fillable = [
        "avatable_type",
        "avatable_id",
        "name",
        "url",
        "activated",
        "created_at",
        "updated_at"
    ];

    public function avatares() {
        return $this->morphMany(\Moon\Model\Media::class, "mediable");
    }

    public function createAvatare($data) {
        return $this->avatares()->create($data);
    }

    public function getAvatares() {
        return $this->avatares;
    }
}