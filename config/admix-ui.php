<?php

return [
    'prefix' => '',
    // https://github.com/tabler/tabler/releases
    'tabler' => [
        'path' => 'vendor/agenciafmd/admix-ui',
        'version' => 'v1.0.0-beta20',
    ],
    'easymde' => [
        'upload' => [
            'max_size' => 5 * 1024 * 1024, // 5MB
            'max_width' => 1920, // Max width for images
            'max_height' => 1080, // Max height for images
            'quality' => 90, // JPEG quality
        ],
    ],
];
