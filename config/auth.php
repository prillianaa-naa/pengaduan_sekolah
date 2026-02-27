<?php

return [
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
];
