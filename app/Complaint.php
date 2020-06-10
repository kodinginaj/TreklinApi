<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    protected $fillable = [
        'id', 'user_id', 'officer_id', 'complaint', 'latitude', 'longitude', 'created_at', 'updated_at'
    ];

    public static function insertComplaint($userid, $officerid, $complaint, $latitude, $longitude)
    {
        $insert = Complaint::create([
            'user_id' => $userid,
            'officer_id' => $officerid,
            'complaint' => $complaint,
            'latitude' => $latitude,
            'longitude' => $longitude,
        ]);
        return $insert;
    }
    public static function getComplaintByIdOfficer($id)
    {
        $data = Complaint::with('user')->where('officer_id', $id)->orderBy('id', 'desc')->take(10)->get();
        return $data;
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
