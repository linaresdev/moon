<?php
namespace Moon\Model;

use Illuminate\Database\Eloquent\Model;

class Device extends Model {

    protected $table = 'devices';

    protected $fillable = [
        "deviceable_type",
        "deviceable_id",
        "type",
        "name",
        "description",
        "servitag",
        "model",
        "serial",
        "number",
        "ip",
        "macIPV4",
        "macIPV6",
        "activated",
        "meta",
        "created_at",
        "updated_at"
    ];

    public function avatar() {
        return $this->morphOne(\Moon\Model\Avatar::class, "avatable");
    }

    public function users() {
        return $this->morphedByMany(\Moon\Model\User::class, "deviceable");
    }

    public function user() {
        return $this->users()->first() ?? null;
    }

    public function getAvatar()
    {
        if( $this->avatar == null ){
            return '<span class="mdi mdi-device"></span>';
        }
        return 33;
    }
}