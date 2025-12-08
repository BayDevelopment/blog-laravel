<?php

namespace App\Http\Controllers;

use App\Models\PostModel;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(){
        $posts = PostModel::all();
        return view('blog',
        [
            'title' => 'Blog | Belajar Laravel',
            'navlink' => 'Blog',
            'posts' => $posts
        ]);
    }

   public function blogBySlug($slug)
    {
        $post = PostModel::where('slug', $slug)->firstOrFail();

        return view('blogs', [
            'title'   => $post->title . ' | Belajar Laravel',
            'navlink' => $post->title,
            'post'    => $post
        ]);
    }

}
