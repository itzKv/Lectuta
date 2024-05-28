<?php

namespace App\Services;

use GuzzleHttp\Client;

class AssemblyAI_APIService
{
    protected $client;
    protected $apiKey;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://api.assemblyai.com/v2/',
        ]);

        // Ini API key kalo bisa simpen di .env. also it's limited so don't spam ;)
        $this->apiKey = "1b6435d5930847be973604f868675921";
    }

    public function transcribe($audioUrl)
    {
        $response = $this->client->post('transcript', [
            'headers' => [
                'Authorization' => $this->apiKey,
                'Content-Type' => 'application/json',
            ],
            'json' => [
                'audio_url' => $audioUrl,
            ],
        ]);

        return json_decode($response->getBody(), true);
    }

    public function getTranscription($transcriptionId)
    {
        $response = $this->client->get("transcript/$transcriptionId", [
            'headers' => [
                'Authorization' => $this->apiKey,
            ],
        ]);

        return json_decode($response->getBody(), true);
    }
}
