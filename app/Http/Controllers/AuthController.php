<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
     // Menampilkan form login
    public function showLoginForm()
    {
        $data = [
            'title' => 'Login | Belajar Laravel',
            'navlink' => 'Login'
        ];
        return view('auth.login', $data); // sesuaikan jika view kamu beda
    }

    // Proses login
    public function login(Request $request)
    {
        // Validasi input
        $credentials = $request->validate([
                'email'    => 'required|email',
                'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
        $request->session()->regenerate();

        $user = Auth::user();

        // Redirect sesuai role user + pesan sukses
        return match ($user->role) {
            'admin' => redirect()->intended('/admin/dashboard')->with('success', 'Login berhasil!'),
            'user'  => redirect()->intended('/user/dashboard')->with('success', 'Login berhasil!'),
            default => redirect('/')->with('success', 'Login berhasil!'),
        };
    }


        // Jika login gagal
        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    public function showRegisterForm()
    {
        $data = [
            'title' => 'Register | Belajar Laravel',
            'navlink' => 'Register'
        ];
        return view('auth.register', $data); // sesuaikan jika view kamu beda
    }

    public function register(Request $request)
    {
        // Validasi input dengan pesan bahasa Indonesia
        $validated = $request->validate([
            'name'                  => 'required|string|max:255',
            'email'                 => 'required|string|email|max:255|unique:users,email',
            'password'              => 'required|string|min:6|confirmed',
        ],[
            'name.required'         => 'Nama wajib diisi.',
            'name.max'              => 'Nama maksimal 255 karakter.',

            'email.required'        => 'Email wajib diisi.',
            'email.email'           => 'Format email tidak valid.',
            'email.max'             => 'Email maksimal 255 karakter.',
            'email.unique'          => 'Email sudah terdaftar.',

            'password.required'     => 'Password wajib diisi.',
            'password.min'          => 'Password minimal 6 karakter.',
            'password.confirmed'    => 'Konfirmasi password tidak cocok.',
        ]);

        // Buat user baru
        User::create([
            'name'     => $validated['name'],
            'email'    => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role'     => 'user',
        ]);

        // Redirect ke login + SweetAlert sukses
        return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login.');
    }

}
