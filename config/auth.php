<?php

return [

    'defaults' => [
        'guard' => 'web',
        'passwords' => 'users',
    ],

    'guards' => [

        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],

        'api' => [
            'driver' => 'token',
            'provider' => 'users',
            'input_key' => 'api_token',
            'storage_key' => 'api_token',
        ],

        'admin' => [ // ✅ guard جديد للأدمن
            'driver' => 'token',
            'provider' => 'admins',
            'input_key' => 'api_token',
            'storage_key' => 'api_token',
        ],

    ],

    'providers' => [

        'users' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class,
        ],

        'admins' => [ // ✅ provider جديد للأدمن
            'driver' => 'eloquent',
            'model' => App\Models\Admin::class,
        ],

    ],

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    'password_timeout' => 10800,

];
