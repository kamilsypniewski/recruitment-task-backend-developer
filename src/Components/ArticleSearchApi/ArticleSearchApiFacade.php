<?php

declare(strict_types=1);

namespace App\Components\ArticleSearchApi;

use GuzzleHttp\Exception\GuzzleException;

class ArticleSearchApiFacade implements \App\Components\Contracts\ArticleSearchApiFacade
{
    private const API_PATH = 'articlesearch.json';

    public function __construct(private readonly Client $client)
    {
    }

    /**
     * @throws GuzzleException
     */
    public function list(string $query): array
    {
        $apiParams = '&fq=news_desk:("Automobiles")';
        if (!empty($query)) {
            $apiParams = \sprintf('&fq=news_desk:("Automobiles") body("%s")', $query);
        }

        $response = $this->client->request(self::API_PATH, $apiParams);

        return $response['docs'];
    }
}
