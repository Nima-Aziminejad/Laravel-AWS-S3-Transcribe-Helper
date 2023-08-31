## Laravel AWS S3 and Transcribe Package

The Laravel AWS S3 and Transcribe Package simplifies working with AWS S3 and Transcribe services within your Laravel projects. This package enables developers to seamlessly integrate AWS S3 for file storage and Amazon Transcribe for audio transcription. It also provides flexible configuration options for AWS credentials and S3 bucket settings.
## Features

- Dependency Injection: Developers can easily utilize the S3Service and TranscribeService classes through dependency injection, enabling seamless integration into various components of your Laravel application.

- Configurable Parameters: Configure your AWS credentials and S3 bucket settings conveniently through the config/aws.php file:
```php
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
```

## Usage
## Using Dependency Injection

You can inject the `S3Service` and `TranscribeService` classes directly into your classes, controllers, or services:
```php
use YourVendor\AWSTranscribe\Services\S3Service;
use YourVendor\AWSTranscribe\Services\TranscribeService;

public function __construct(S3Service $s3Service, TranscribeService $transcribeService)
{
    $this->s3Service = $s3Service;
    $this->transcribeService = $transcribeService;
}
```

### Contribution
Contributions are highly appreciated! If you encounter any issues or have suggestions for improvement, please submit a pull request or open an issue on our GitHub repository.
