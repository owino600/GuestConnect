<?php

namespace GuestConnect\Contracts;

interface ControllerInterface
{
    /**
     * Authenticate with the controller.
     */
    public function login(): bool;

    /**
     * Authorize a guest.
     */
    public function authorizeGuest(string $mac): bool;

    /**
     * Disconnect a guest.
     */
    public function disconnectGuest(string $mac): bool;

    /**
     * Return currently connected clients.
     */
    public function getOnlineClients(): array;

    /**
     * Return controller name.
     */
    public function getName(): string;
}
