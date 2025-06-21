<?php

namespace App\Repositories\Interfaces;

interface AuthRepositoryInterface
{
    public function login(array $credentials): ?string;
    public function register(array $data): \App\Models\User;
    public function logout(): void;
}
