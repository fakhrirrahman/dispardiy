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

    // ✅ Tampilkan form login
    public function showLogin()
    {
        return view('auth.login');
    }

    // ✅ Proses login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        $role = $this->authRepo->login($credentials);

        if ($role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        if ($role === 'user') {
            return redirect()->route('user.dashboard');
        }

        return back()->withErrors([
            'email' => 'Login gagal atau role tidak sesuai.',
        ])->withInput();
    }

    // ✅ Tampilkan form register
    public function showRegister()
    {
        return view('auth.register');
    }

    // ✅ Proses register
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name'                  => 'required|string|max:255',
            'email'                 => 'required|email|unique:users',
            'password'              => 'required|min:6|confirmed',
        ]);

        $this->authRepo->register($validated);

        return redirect()->back()->with('success', 'Registrasi berhasil, silakan login.');
    }

    public function logout(Request $request)
    {
        $this->authRepo->logout();

        return redirect()->route('login');
    }
}
