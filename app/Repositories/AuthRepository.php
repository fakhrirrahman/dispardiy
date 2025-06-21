<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Repositories\Interfaces\AuthRepositoryInterface;

class AuthRepository implements AuthRepositoryInterface
{
    public function login(array $credentials): ?string
    {
        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if ($user->hasRole(['admin', 'user'])) {
                session()->regenerate();

                return $user->getRoleNames()->first(); // return 'admin' / 'user'
            }

            Auth::logout(); // Tidak punya role yang valid
        }

        return null;
    }

    public function register(array $data): User
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        $user->assignRole('user'); // default role

        Auth::login($user);
        return $user;
    }

    public function logout(): void
    {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
    }
}
