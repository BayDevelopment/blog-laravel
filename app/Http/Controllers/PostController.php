<?php

namespace App\Http\Controllers;

use App\Models\PostModel;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $categories = [
            'Pemrograman',
            'Prestasi',
            'Crypto',
        ];

        $posts = PostModel::query()
            ->when($request->filled('search'), function ($query) use ($request) {
                $search = $request->search;
                $query->where(function ($q) use ($search) {
                    $q->where('title', 'like', "%{$search}%")
                        ->orWhere('body', 'like', "%{$search}%")
                        ->orWhere('author', 'like', "%{$search}%");
                });
            })
            ->when($request->filled('category'), function ($query) use ($request) {
                $query->where('category', $request->category);
            })
            ->latest()
            ->paginate(9)           // biar enak: 9 per halaman (3x3 grid)
            ->withQueryString();    // jaga query ?search=&category= di pagination

        return view('blog', [
            'title' => 'Blog | Belajar Laravel',
            'navlink' => 'Blog',
            'posts' => $posts,
            'categories' => $categories,
        ]);
    }

    public function blogBySlug($slug)
    {
        $post = PostModel::where('slug', $slug)->firstOrFail();

        return view('blogs', [
            'title' => $post->title.' | Belajar Laravel',
            'navlink' => $post->title,
            'post' => $post,
        ]);
    }
}
