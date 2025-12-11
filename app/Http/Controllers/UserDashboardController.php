<?php

namespace App\Http\Controllers;

use App\Models\PostModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

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
            'category' => ['required', 'max:100', 'in:Pemrograman,Prestasi,Crypto'],
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
            ->route('user.postingan-saya')
            ->with('success', 'Postingan berhasil dibuat.');
    }

    // show
    public function show_blogBySlug($slug)
    {
        // Ambil post berdasarkan slug dan milik user yang sedang login
        $post = PostModel::where('user_id', Auth::id())
            ->where('slug', $slug)
            ->firstOrFail();

        $data = [
            'title' => $post->title.' | Belajar Laravel',
            'navlink' => 'Detail Blog',
            'post' => $post,
        ];

        return view('dashboard.users.show', $data);
    }

    // edit
    public function edit_postBySlug($slug)
    {
        // Ambil post milik user yang sedang login berdasarkan slug
        $post = PostModel::where('user_id', Auth::id())
            ->where('slug', $slug)
            ->firstOrFail();

        // Kategori statis
        $categories = [
            'Pemrograman',
            'Prestasi',
            'Crypto',
        ];

        return view('dashboard.users.edit-post', [
            'title' => 'Edit Blog | Belajar Laravel',
            'navlink' => 'Edit Blog',
            'categories' => $categories,
            'post' => $post,
        ]);
    }

    public function aksi_update(Request $request, $slug)
    {
        // Cari post milik user yang sedang login berdasarkan slug
        $post = PostModel::where('user_id', Auth::id())
            ->where('slug', $slug)
            ->firstOrFail();

        // Validasi input
        $validated = $request->validate([
            'category' => ['required', 'max:100', 'in:Pemrograman,Prestasi,Crypto'],
            'title' => ['required', 'max:255'],
            'slug' => [
                'nullable',
                'max:255',
                Rule::unique('posts', 'slug')->ignore($post->id),
            ],
            'body' => ['required'],
        ]);

        // user_id & author tetap diset dari Auth (optional, bisa dipertahankan)
        $validated['user_id'] = Auth::id();
        $validated['author'] = Auth::user()->name;

        // Handle slug:
        // - Jika input slug kosong → generate dari title
        // - Jika slug diubah → pastikan unik
        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        $originalSlug = $validated['slug'];
        $counter = 1;

        // Cek slug sudah dipakai user lain / post lain
        while (
            PostModel::where('slug', $validated['slug'])
                ->where('id', '!=', $post->id)
                ->exists()
        ) {
            $validated['slug'] = $originalSlug.'-'.$counter++;
        }

        // Update data
        $post->update([
            'user_id' => $validated['user_id'],
            'category' => $validated['category'],
            'title' => $validated['title'],
            'author' => $validated['author'],
            'slug' => $validated['slug'],
            'body' => $validated['body'],
        ]);

        return redirect()
            ->route('user.postingan-saya')
            ->with('success', 'Postingan berhasil diperbarui.');
    }

    // delete blog by id
    public function delete_blog($id)
    {
        // Cari post berdasarkan ID yang dimiliki user yang sedang login
        $post = PostModel::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        // Hapus post
        $post->delete();

        return redirect()
            ->route('user.postingan-saya')
            ->with('success', 'Postingan berhasil dihapus.');
    }
}
