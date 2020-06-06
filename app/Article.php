<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = [
        'id', 'judul', 'penulis', 'foto', 'isi', 'created_at', 'updated_at'
    ];

    public static function insertArticle($data)
    {
        $insert = Article::create($data);
        return $insert;
    }

    public static function getArticle()
    {
        $data = Article::orderBy('id', 'desc')->get();
        return $data;
    }
}
