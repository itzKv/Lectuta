<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class AssemblyAiService
{
    protected $client;
    protected $API_KEY = '35dcec4501b54bf889c452ba667688b7';
    protected $apiBaseURL = 'https://api.assemblyai.com/v2/';

    public function __construct()
    {
        $this->client = new Client();
        ini_set('max_execution_time', 1000);
    }

    public function fetchFile(Request $request)
    {
        $httpClient = new Client();

        $apiURL = $request->input('apiURL'); // Retrieve the apiURL parameter
        $param = $request->input('param');

        try {
            $response = $httpClient->request('POST',  $this->apiBaseURL . $apiURL, [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->API_KEY,
                    'Content-Type' => 'application/octet-stream',
                ],
                'body' => fopen($param, 'r'),
            ]);

            $responseBody = json_decode($response->getBody()->getContents(), true);
            return $responseBody;
        } catch (\Exception $e) {
            // Handle API request error
            throw new \Exception('Error fetching file: ' . $e->getMessage());
        }
    }

    public function fetchData(Request $request)
    {
        $headers = [
            'Authorization' => 'Bearer ' . $this->API_KEY,
            'Content-Type' => 'application/json',
        ];

        $apiURL = $request->input('apiURL'); 
        $audioURL = $request->input('audioURL');
        $audio_language = $request->input('audio_language');
        $auto_language_detection = $request->input('auto_language_detection');

        $data = [
            "audio_url" => $audioURL,
            "boost_param" => "high",
            "language_code" => $audio_language,
            "language_detection" => $auto_language_detection,
            "punctuate" => true,
            "speech_model" => "nano",
            "speech_threshold" => 0.5,
        ];

        try {
            $response = $this->client->post($this->apiBaseURL . $apiURL, [
                'headers' => $headers,
                'json' => $data,
            ]);

            $responseBody = json_decode($response->getBody()->getContents(), true);
            $pollingEndpoint = $responseBody['id'];
            return $this->pollForTranscript($pollingEndpoint, $apiURL, $headers);
        } catch (RequestException $e) {
            // Handle API request error
            if ($e->hasResponse()) {
                $error = $e->getResponse()->getBody()->getContents();
            } else {
                $error = $e->getMessage();
            }
            throw new \Exception('Error creating transcript: ' . $error);
        }
    }

    private function pollForTranscript($pollingEndpoint, $apiURL, $headers)
    {
        $pollingUrl = $this->apiBaseURL . $apiURL . "/" . $pollingEndpoint;
        while (true) {
            try {
                $pollingResponse = $this->client->get($pollingUrl, [
                    'headers' => $headers
                ]);
                $transcriptionResult = json_decode($pollingResponse->getBody()->getContents(), true);

                if ($transcriptionResult['status'] === 'completed') {
                    return $transcriptionResult;
                } elseif ($transcriptionResult['status'] === 'error') {
                    throw new \Exception('Transcription failed: ' . $transcriptionResult['error']);
                } else {
                    sleep(3); // Wait for 3 seconds before polling again
                }
            } catch (RequestException $e) {
                // Handle API request error
                if ($e->hasResponse()) {
                    $error = $e->getResponse()->getBody()->getContents();
                } else {
                    $error = $e->getMessage();
                }
                throw new \Exception('Error polling for transcript: ' . $error);
            }
        }
    }
}
