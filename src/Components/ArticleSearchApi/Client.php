<?php

declare(strict_types=1);

namespace App\Components\ArticleSearchApi;

class Client
{
    public function __construct(
        private readonly string $apiUrl,
        private readonly string $apiKey
    ) {
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function request(string $apiPath, string $apiParams): array
    {
        $url = \sprintf('%s%s?api-key=%s%s', $this->apiUrl, $apiPath, $this->apiKey, $apiParams);

        $client   = new \GuzzleHttp\Client();
        $response = $client->request('GET', $url);

        if (200 !== $response->getStatusCode()) {
            throw new \RuntimeException(\sprintf('Api nytimes returned an unexpected response code %s.', $response->getStatusCode()));
        }

        try {
            $contents = \json_decode($response->getBody()->getContents(), true);
        } catch (\Exception $exception) {
            throw new \RuntimeException(\sprintf('Invalid Api nytimes response format, message %s.', $exception->getMessage()));
        }

        if (!\is_array($contents)) {
            throw new \RuntimeException('Invalid api response format');
        }

        $response = $contents['response'];
        if (!\is_array($response)) {
            throw new \RuntimeException('Invalid api response format');
        }

        return $response;
    }
}
