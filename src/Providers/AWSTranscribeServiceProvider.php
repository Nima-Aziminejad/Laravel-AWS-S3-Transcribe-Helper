<?php

namespace Nima\AwsTranscribe\Providers;
use Illuminate\Support\ServiceProvider;
use Nima\AwsTranscribe\S3Service;
use Nima\AwsTranscribe\TranscribeService;

class AWSTranscribeServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->publishes([
            __DIR__ . '/../config/AWSConfig.php' => config_path('AWSConfig.php')
        ]);
    }

    public function register(): void
    {
        parent::register();
        $this->app->bind(S3Service::class,function ($app){
            return new S3Service;
        });
        $this->app->bind(TranscribeService::class,function ($app){
            return new TranscribeService;
        });
    }
}
