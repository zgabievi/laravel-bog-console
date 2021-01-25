<?php

return [
    /**
     * Merchant portal id for requests.
     */
    'portal_id' => env('BOG_CONSOLE_PORTAL_ID'),

    /**
     * OpenAPI console url.
     */
    'api_url' => env('BOG_CONSOLE_API_URL', 'https://mpi.gc.ge/open/api/v4/'),

    /**
     * OpenAPI console username.
     */
    'username' => env('BOG_CONSOLE_USERNAME'),

    /**
     * OpenAPI console password.
     */
    'password' => env('BOG_CONSOLE_PASSWORD'),
];
