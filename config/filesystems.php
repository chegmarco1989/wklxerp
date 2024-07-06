<?php

return [

    'disks' => [
        'local' => [
            'driver' => 'local',
            'root' => public_path('uploads'),
            'throw' => false,
        ],

        'dropbox' => [
            'driver' => 'dropbox',
            'authorization_token' => env('DROPBOX_ACCESS_TOKEN'),
        ],
    ],

];
