<?php

namespace GuestConnect\Services;

use GuestConnect\Repositories\AdminRepository;

class AdminAuthService
{
    private AdminRepository $repository;

    public function __construct()
    {
        $this->repository = new AdminRepository();
    }

    public function login(
        string $username,
        string $password
    ): bool
    {
        $admin = $this->repository
            ->findByUsername($username);

        if (!$admin) {
            return false;
        }

        if (!password_verify(
            $password,
            $admin['password']
        )) {
            return false;
        }

        $_SESSION['admin'] = [

            'id'=>$admin['id'],

            'name'=>$admin['name'],

            'username'=>$admin['username']

        ];

        return true;
    }

    public function check(): bool
    {
        return isset($_SESSION['admin']);
    }

    public function logout(): void
    {
        unset($_SESSION['admin']);
    }
}
