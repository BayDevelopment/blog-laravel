<?php

namespace App\Http\Controllers;

use App\Models\PostModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class UserDashboardController extends Controller
{
    public function index()
    {
        $postCount = PostModel::where('user_id', Auth::id())->count();

        return view('dashboard.user', [
            'title' => 'Dashboard User | Belajar Laravel',
            'navlink' => 'Dashboard User',
            'postCount' => $postCount,
        ]);
    }

    public function page_postingan_allByUser(Request $request)
    {
        $query = PostModel::where('user_id', Auth::id());

        // Search (judul, body, author)
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('body', 'like', "%{$search}%")
                    ->orWhere('author', 'like', "%{$search}%");
            });
        }

        // Filter by kategori
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        // Pagination (10 per halaman) + keep query string
        $d_postByUser = $query->latest()
            ->paginate(10)
            ->withQueryString();

        // List kategori untuk dropdown
        $categories = PostModel::where('user_id', Auth::id())
            ->select('category')
            ->distinct()
            ->pluck('category');

        return view('dashboard.users.postingan-saya', [
            'title' => 'Postingan Saya',
            'navlink' => 'Postingan Saya',
            'd_post_byUser' => $d_postByUser,
            'categories' => $categories,
        ]);
    }

    // tambah post
    public function page_create_post()
    {
        // Kalau mau pakai select category, definisikan statis di sini
        $categories = [
            'Pemrograman',
            'Prestasi',
            'Crypto',
        ];

        return view('dashboard.users.create-posts', [
            'title' => 'Create Blog | Belajar Laravel',
            'navlink' => 'Create Blog',
            'categories' => $categories,
        ]);
    }

    public function create_post(Request $request)
    {
        $validated = $request->validate([
            'category' => ['required', 'max:100'],   // langsung string
            'title' => ['required', 'max:255'],
            'slug' => ['nullable', 'max:255', 'unique:posts,slug'],
            'body' => ['required'],
        ]);

        // user_id & author ISI di controller
        $validated['user_id'] = Auth::id();
        $validated['author'] = Auth::user()->name;

        // kalau slug kosong → generate dari title
        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);

            $originalSlug = $validated['slug'];
            $counter = 1;

            while (PostModel::where('slug', $validated['slug'])->exists()) {
                $validated['slug'] = $originalSlug.'-'.$counter++;
            }
        }

        // kalau Post model pakai field 'category' (string)
        PostModel::create([
            'user_id' => $validated['user_id'],
            'category' => $validated['category'], // langsung isi string kategori
            'title' => $validated['title'],
            'author' => $validated['author'],
            'slug' => $validated['slug'],
            'body' => $validated['body'],
        ]);

        return redirect()
            ->route('aksi.create')
            ->with('success', 'Postingan berhasil dibuat.');
    }
}
