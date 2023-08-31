<?php
return [
    'aws' => [
        'credentials' => [
            'region' => env('AWS_DEFAULT_REGION'),
            'key' => env('AWS_KEY'),
            'secret' => env('AWS_SECRET'),
        ],
        's3' => [
            'bucket' => env('AWS_S3_BUCKET'),
        ]
    ]
];
