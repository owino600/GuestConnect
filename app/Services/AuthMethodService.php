<?php

namespace GuestConnect\Services;

class AuthMethodService
{
    public function getMethod(): array
    {
        /*
         * Later this will come from the database.
         */

        return [

            'type' => 'password',

            'label' => 'Password',

            'placeholder' => 'Enter Wi-Fi Password'

        ];
    }
}
