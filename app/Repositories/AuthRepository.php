<?php

namespace App\Repositories;

use App\Models\Role;
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

            if ($user->hasRole(Role::ROLE['ADMIN']) || $user->hasRole(Role::ROLE['USER'])) {
                session()->regenerate();
                return $user->getRoleNames()->first();
            }

            Auth::logout();
        }

        return null;
    }

    public function register(array $data): User
    {
        $user = User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        $user->assignRole(Role::ROLE['USER']);

        Auth::login($user);
        session()->regenerate();

        return $user;
    }

    public function logout(): void
    {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
    }
}
