<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = [
        'id', 'judul', 'penulis', 'foto', 'isi', 'created_at', 'updated_at'
    ];
}
