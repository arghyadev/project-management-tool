<?php

return [
    'stateful' => explode(',', env('SANCTUM_STATEFUL_DOMAINS', 'localhost:3000,127.0.0.1:3000')),
    'expiration' => null,
];
