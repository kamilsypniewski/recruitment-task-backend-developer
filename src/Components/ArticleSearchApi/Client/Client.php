<?php

declare(strict_types=1);

namespace App\Components\ArticleSearchApi\Client;

final class Client implements \App\Components\ArticleSearchApi\Client
{
    public function __construct(
        private readonly \GuzzleHttp\Client $client,
        private readonly string $apiUrl,
        private readonly string $apiKey
    ) {
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function request(string $url): string
    {
        $response = $this->client->request('GET', $url);

        if (200 !== $response->getStatusCode()) {
            throw new \RuntimeException(\sprintf('Api nytimes returned an unexpected response code %s.', $response->getStatusCode()));
        }

        return $response->getBody()->getContents();
    }

    public function getUrl(string $apiPath, string $apiParams): string
    {
        return \sprintf('%s%s?api-key=%s%s', $this->apiUrl, $apiPath, $this->apiKey, $apiParams);
    }
}
