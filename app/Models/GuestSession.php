<?php

namespace GuestConnect\Models;

class GuestSession
{
    public ?int $id = null;

    public int $guest_id;

    public string $controller;

    public ?string $session_identifier = null;

    public string $login_time;

    public ?string $logout_time = null;

    public int $duration_seconds = 0;

    public string $status = 'active';
}
