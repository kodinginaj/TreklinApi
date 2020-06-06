<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Officer extends Model
{
    protected $fillable = [
        'id', 'nama', 'email', 'password', 'latitude', 'kendaraan', 'peralatan', 'longitude', 'created_at', 'updated_at'
    ];

    public static function getOfficer()
    {
        $data = Officer::select('*')->get();
        if ($data->count() > 0) {
            $data = $data->toArray();
        } else {
            $data = [];
        }
        return $data;
    }
}
