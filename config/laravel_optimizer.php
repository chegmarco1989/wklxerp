<?php

return [
    'static_cache_ttl' => env('LARAVEL_OPTIMIZER_STATIC_CACHE_TTL', 60),
    'gzip_compression' => [
        'level' => 9, // Default compression level for Gzip.
    ],
];