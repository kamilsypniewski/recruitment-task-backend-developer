<?php

declare(strict_types=1);

namespace App\Tests\Components\ArticleSearchApi\Fixtures;


use App\Components\ArticleSearchApi\Client;
use PHPUnit\Framework\MockObject\MockObject;
use Psr\Http\Message\ResponseInterface;

trait Mocks
{
    abstract protected function createMock(string $originalClassName): MockObject;

    protected function guzzleHttpClientMock(): \GuzzleHttp\Client|MockObject
    {
        return $this->createMock(\GuzzleHttp\Client::class);
    }

    protected function clientMock(): Client|MockObject
    {
        return $this->createMock(Client::class);
    }


}
