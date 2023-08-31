<?php

namespace Nima\AwsTranscribe;

use Aws\S3\S3Client;

class S3Service
{
    private S3Client $s3;
    public function __construct()
    {
        $this->s3 = new S3Client([
            'region' => config('AWSConfig.aws.credentials.region'),
            'version' => 'latest',
            'credentials' => [
                'key' => config('AWSConfig.aws.credentials.key'),
                'secret' => config('AWSConfig.aws.credentials.secret')
            ]
        ]);
    }

    public function store($path,$file,$type): string
    {
        $bucket = config('AWSConfig.aws.s3.bucket');
        $audioContents = file_get_contents($file->getRealPath());
        $audioName = time() .'.'. $type;
        $this->s3->putObject([
            'Bucket' => $bucket,
            'Key' => $path.'/' . $audioName,
            'Body' => $audioContents,
        ]);
        return $this->s3->getObjectUrl($bucket, $path.'/' . $audioName);
    }
}
