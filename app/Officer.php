<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Officer extends Model
{
    protected $fillable = [
        'id', 'nama', 'email', 'password', 'latitude', 'kendaraan', 'peralatan', 'longitude', 'created_at', 'updated_at'
    ];
}
