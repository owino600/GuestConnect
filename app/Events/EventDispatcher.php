<?php

namespace GuestConnect\Events;

class EventDispatcher
{
    private array $listeners = [];

    public function listen(
        string $event,
        callable $listener
    ): void {

        $this->listeners[$event][] = $listener;

    }

    public function dispatch(
        string $event,
        mixed $payload = null
    ): void {

        if (!isset($this->listeners[$event])) {

            return;

        }

        foreach ($this->listeners[$event] as $listener) {

            $listener($payload);

        }

    }
}
