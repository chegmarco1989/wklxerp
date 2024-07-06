<?php

return [

    'guards' => [
        'api' => [
            'driver' => 'passport',
            'provider' => 'users',
        ],

        'customer' => [
            'driver' => 'session',
            'provider' => 'contacts',
        ],
    ],

    'providers' => [
        'contacts' => [
            'driver' => 'eloquent',
            'model' => App\Contact::class,
        ],
    ],

    'passwords' => [
        'contacts' => [
            'provider' => 'contacts',
            'table' => 'password_resets_contacts',
            'expire' => 60,
        ],
    ],

];
