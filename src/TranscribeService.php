<?php

namespace Nima\AwsTranscribe;

use Aws\TranscribeService\TranscribeServiceClient;

class TranscribeService
{
    private TranscribeServiceClient $awsTranscribeClient;
    public function __construct()
    {
        $this->awsTranscribeClient = new TranscribeServiceClient([
            'region' => config('AWSConfig.aws.credentials.region'),
            'version' => 'latest',
            'credentials' => [
                'key' => config('AWSConfig.aws.credentials.key'),
                'secret' => config('AWSConfig.aws.credentials.secret')
            ]
        ]);
    }

    public function transcribeFile($url, $jobId)
    {
        $transcriptionResult = $this->awsTranscribeClient->startTranscriptionJob([
            'LanguageCode' => 'en-US',
            'Media' => [
                'MediaFileUri' => $url,
            ],
            'TranscriptionJobName' => $jobId,
        ]);
        $status = array();
        while (true) {
            $status = $this->awsTranscribeClient->getTranscriptionJob([
                'TranscriptionJobName' => $jobId
            ]);

            if ($status->get('TranscriptionJob')['TranscriptionJobStatus'] == 'COMPLETED') {
                break;
            }

            sleep(5);
        }
        return $status->get('TranscriptionJob')['Transcript']['TranscriptFileUri'];
    }

    public function getTranscript($url): bool|string
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, false);
        $data = curl_exec($curl);
        if (curl_errno($curl)) {
            $error_msg = curl_error($curl);
            echo $error_msg;
        }
        curl_close($curl);
        return $data;
    }
}
