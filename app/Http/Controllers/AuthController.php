<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Interfaces\AuthRepositoryInterface;

class AuthController extends Controller
{
    protected AuthRepositoryInterface $authRepo;

    public function __construct(AuthRepositoryInterface $authRepo)
    {
        $this->authRepo = $authRepo;
    }

    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

        $role = $this->authRepo->login($credentials);

        if ($role === 'ADMIN') {
            return redirect()->route('home')->with('success', 'Login berhasil sebagai Admin.');
        }

        if ($role === 'USER') {
            return redirect()->route('home')->with('success', 'Login berhasil sebagai User.');
        }

        return back()->withErrors([
            'email' => 'Login gagal. Pastikan email, password, dan role Anda benar.',
        ])->withInput();
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        $this->authRepo->register($validated);

        return redirect()->route('login')->with('success', 'Registrasi berhasil. Selamat datang!');
    }

    public function logout(Request $request)
    {
        $this->authRepo->logout();
        return redirect()->route('login')->with('success', 'Anda telah logout.');
    }
}
