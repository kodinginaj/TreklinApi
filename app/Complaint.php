<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    protected $fillable = [
        'id', 'user_id', 'petugas_id', 'complaint', 'created_at', 'updated_at'
    ];
}
