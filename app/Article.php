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

    public static function getAnotherArticle($id)
    {
        $data = Article::where('id', '!=', $id)->orderBy('id', 'desc')->take(5)->get();
        return $data;
    }

    public static function getArticleById($id)
    {
        $select = Article::where('id', $id)->get();
        if ($select->count() > 0) {
            $data['status'] = 1;
            $data['article'] = $select->first();
        } else {
            $data['status'] = 0;
        }
        return $data;
    }
}
