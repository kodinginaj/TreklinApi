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

    public static function updateLocation($id, $data)
    {
        try {
            $pekerja = Officer::where('id', $id)->update($data);
            return 1;
        } catch (\Illuminate\Database\QueryException $e) {
            return 0;
        }
    }
}
