<?php

namespace App\Services;

use Exception;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class GeminiAiService
{
    protected $client;
    protected $API_KEY = 'AIzaSyBc4Nxb2bTc3vTvLZR6YGoCmz_EL8fhGXA';

    public function __construct()
    {
        $this->client = new Client();
    }

    public function fetchData(Request $request)
    {
        $prompt = $request->input('prompt');
        $url = 'https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash-latest:generateContent?key=' . $this->API_KEY;
        
        $payload = [
            'contents' => [
                [
                    'parts' => [
                        [
                            'text' => $prompt
                        ]
                    ]
                ]
            ]
        ];

        try {
            $response = $this->client->post($url, [
                'json' => $payload,
                'headers' => [
                    'Content-Type' => 'application/json',
                ],
            ]);

            $responseBody = json_decode($response->getBody()->getContents(), true);
            return $responseBody;
        } catch (\Exception $e) {
            if ($e->hasResponse()) {
                $response = $e->getResponse();
                $statusCode = $response->getStatusCode();
                $body = $response->getBody()->getContents();
                throw new Exception("Request failed with status code $statusCode: $body");
            } else {
                throw new Exception('Request failed: ' . $e->getMessage());
            }
        }
    }
}
?>