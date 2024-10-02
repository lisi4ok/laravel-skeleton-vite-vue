<?php

namespace App\Services;

use Illuminate\Http\JsonResponse;
use \Psr\Http\Client\ClientInterface;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Psr\Http\Message\ResponseInterface;

class TVMService
{
    public function __construct(
        public ClientInterface $client,
        public string $uri,
        public string $username,
        public string $password,
        public array $headers = [
            'content-type' => 'application/json',
            'Accept' => 'application/json',
        ],
    )
    {
        $this->uri = config('api.tvm.uri');
        $this->client =  new Client(['base_uri' => $this->uri]);
        $this->username = config('api.tvm.username');
        $this->password = config('api.tvm.password');
    }

    public function create(string $body): ResponseInterface
    {
        $options = [
            'auth' => [
                $this->username,
                $this->password,
            ],
            'headers'  => $this->headers,
            'body'     => $body,
            //'body' => json_encode(json_decode($body, true)),
            //'debug' => true,
        ];

        $response = null;
        try {
            $response = $this->client->post($this->uri . '/api/v2/tickets', $options);
        } catch (ClientException $exception) {
            throw new \Exception(
                $exception->getMessage(),
                $exception->getResponse()->getStatusCode()
            );
        }

        return $response;
    }
}
