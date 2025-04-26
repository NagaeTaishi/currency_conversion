<?php

namespace Src\Domain\Infrastructures;

use GuzzleHttp\Client;
use Src\Domain\Exception\ClientException;

class OpenExchangeClient
{
    private Client $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => config('api.open_exchange.base_uri'),
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => 'Token ' . config('api.open_exchange.api_key'),
            ],
        ]);
    }

    public function getRates(): array
    {

        $response = $this->request('GET', 'latest.json');

        if ($response->getStatusCode() !== 200) {
            throw new ClientException('Failed to fetch rates: ' . $response->getBody()?->message ?? $response->getReasonPhrase());
        }

        $data = json_decode($response->getBody(), true);
        if (!array_key_exists('rates', $data)) {
            throw new \RuntimeException('Failed to fetch rates: ' . $data['error']);
        }

        return $data['rates'];
    }

    private function request(string $method, string $path, array $options = [])
    {
        return $this->client->request($method, $path, $options);
    }
}
