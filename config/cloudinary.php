<?php

return [
    'notification_url' => env('CLOUDINARY_NOTIFICATION_URL'),
    'cloud_url'        => env('CLOUDINARY_URL'),
    'cloudinary_url'   => env('CLOUDINARY_URL'),
    'upload_preset'    => env('CLOUDINARY_UPLOAD_PRESET'),
    'upload_route'     => env('CLOUDINARY_UPLOAD_ROUTE'),
    'upload_action'    => env('CLOUDINARY_UPLOAD_ACTION'),

    // Had l-keys homa li kay-crashi 3lihom l-provider:
    'cloud' => [
        'cloud_name' => env('CLOUDINARY_CLOUD_NAME', 'dmtkoxpc'),
        'api_key'    => env('CLOUDINARY_KEY', '917547698922988'),
        'api_secret' => env('CLOUDINARY_SECRET', 'DaceDzqFxF_hgvNqKt7iKMhsbvQ'),
    ],
    'cloud_name' => env('CLOUDINARY_CLOUD_NAME', 'dmtkoxpc'),
    'api_key'    => env('CLOUDINARY_KEY', '917547698922988'),
    'api_secret' => env('CLOUDINARY_SECRET', 'DaceDzqFxF_hgvNqKt7iKMhsbvQ'),
];
