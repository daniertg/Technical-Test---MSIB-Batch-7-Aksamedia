<?php

use Laravel\Sanctum\Sanctum;

return [

    'stateful' => explode(',', env('SANCTUM_STATEFUL_DOMAINS', sprintf(
        '%s%s',
        'localhost,localhost:3000,127.0.0.1,127.0.0.1:8000,::1',
        Sanctum::currentApplicationUrlWithPort()
    ))),

    'guard' => ['api'],

    'expiration' => null, // Atau tentukan dalam menit jika diinginkan

    'token_prefix' => env('SANCTUM_TOKEN_PREFIX', ''),

    'middleware' => [
        // Jika Anda tidak memerlukan middleware untuk sesi web, bisa dihapus atau disesuaikan
        'authenticate_session' => Laravel\Sanctum\Http\Middleware\AuthenticateSession::class,
        // Middleware ini hanya diperlukan jika Anda menggunakan cookies
        'encrypt_cookies' => App\Http\Middleware\EncryptCookies::class,
        // Pastikan ini sesuai dengan kebutuhan Anda
        'verify_csrf_token' => App\Http\Middleware\VerifyCsrfToken::class,
    ],

];
