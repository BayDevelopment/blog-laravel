<?php

namespace App\Models;

use Database\Factories\PostFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PostModel extends Model
{
     use HasFactory;

    protected $table = 'posts'; // atau 'post' kalau itu nama tabelmu

    protected $fillable = [
        'user_id',
        'category',
        'title',
        'author',
        'slug',
        'body',
    ];

    protected static function newFactory()
    {
        return PostFactory::new();
    }

        
}
