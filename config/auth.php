<?php

return [
<<<<<<< HEAD
    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],

        'admin' => [
            'driver' => 'session',
            'provider' => 'admins',
        ],

        'siswa' => [
            'driver' => 'session',
            'provider' => 'siswas',
        ],
    ],

    'providers' => [
        'admins' => [
            'driver' => 'eloquent',
            'model' => App\Models\Admin::class,
        ],

        'users' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class,
        ],

        'siswas' => [
            'driver' => 'eloquent',
            'model' => App\Models\Siswa::class,
        ],
    ],
=======
'guards' => [
    'web' => [
        'driver' => 'session',
        'provider' => 'users',
    ],

    'admin' => [
        'driver' => 'session',
        'provider' => 'admins',
    ],

    'siswa' => [
        'driver' => 'session',
        'provider' => 'siswas',
    ],
],

'providers' => [
    'admins' => [
        'driver' => 'eloquent',
        'model' => App\Models\Admin::class,
    ],

    'admins' => [
        'driver' => 'eloquent',
        'model' => App\Models\User::class,
    ],

    'siswas' => [
        'driver' => 'eloquent',
        'model' => App\Models\Siswa::class,
    ],
],
>>>>>>> 722639d6daabffc6f303b1c182c07a331f2f6475
];
