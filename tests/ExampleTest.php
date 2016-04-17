<?php

use GuzzleHttp\Client;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExampleTest extends TestCase
{
    public function test_try_out_key_words()
    {
        $config = [
            'headers' => [
                'Ocp-Apim-Subscription-Key' => env('MS_KEY'),
                'Content-Type' => 'application/json',
                'Accept' => 'application/json'
            ]
        ];

        $client = new Client($config);

        $documents[] = ['id' => 1, 'text' => 'Foobar fox hat cat'];
        $documents[] = ['id' => 2, 'text' => 'Foobar rat dog bus'];

        $url = 'https://westus.api.cognitive.microsoft.com/text/analytics/v2.0/keyPhrases';
        $results = $client->request('POST', $url,
            ['json' => ['documents' => $documents]]);

        dd(json_decode($results->getBody(), true));
    }


    public function test_try_out_sentiment()
    {
        $config = [
            'headers' => [
                'Ocp-Apim-Subscription-Key' => env('MS_KEY'),
                'Content-Type' => 'application/json',
                'Accept' => 'application/json'
            ]
        ];

        $client = new Client($config);

        $documents[] = ['id' => 1, 'text' => 'This is a really BAD idea'];
        $documents[] = ['id' => 2, 'text' => 'This is a really really GOOD idea'];

        $url = 'https://westus.api.cognitive.microsoft.com/text/analytics/v2.0/sentiment';
        $results = $client->request('POST', $url,
            ['json' => ['documents' => $documents]]);

        dd(json_decode($results->getBody(), true));
    }
}
