<?php
declare(strict_types=1);

namespace App\Components\ArticleSearchApi;



class ArticleSearchApiFacade implements \App\Components\Contracts\ArticleSearchApiFacade
{
    public function __construct(private readonly Client $client)
    {
    }


    public function list(): array
    {
        $apiPath = 'articlesearch.json';
        $response =  $this->client->request($apiPath);
        return $response['docs'];
    }
}