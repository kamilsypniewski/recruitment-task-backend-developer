<?php

declare(strict_types=1);

namespace App\Components\ArticleSearchApi;

interface Client
{
    public function request(string $url): string;
    public function getUrl(string $apiPath, string $apiParams): string;
}
