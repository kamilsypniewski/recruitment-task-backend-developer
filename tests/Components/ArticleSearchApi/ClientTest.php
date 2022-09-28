<?php

declare(strict_types=1);

namespace App\Tests\Components\ArticleSearchApi;

use App\Components\ArticleSearchApi\Client;
use PHPUnit\Framework\TestCase;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 * @psalm-suppress RedundantCondition
 */
final class ClientTest extends TestCase
{
    use Fixtures;


    public function testRequest(): void
    {
        $text = $this->string() ;
        $guzzleHttpClientMock = $this->guzzleHttpClientMock();
        $guzzleHttpClientMock->expects($this->once())
            ->method('request')
            ->with(
                $this->isType('string'),
                $this->isType('string'),
            )
            ->willReturn($this->response(200, $text));

        $client = new Client($guzzleHttpClientMock, $this->string(), $this->string());
        $request = $client->request($this->string());

        $this->assertSame($text, \json_decode($request));
    }

    public function testRequestIncorrectResponse(): void
    {
        $text = $this->string() ;
        $guzzleHttpClientMock = $this->guzzleHttpClientMock();
        $guzzleHttpClientMock->expects($this->once())
            ->method('request')
            ->with(
                $this->isType('string'),
                $this->isType('string'),
            )
            ->willReturn($this->response(500, $text));

        $client = new Client($guzzleHttpClientMock, $this->string(), $this->string());
        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('Api nytimes returned an unexpected response code 500.');
        $client->request($this->string());
    }

    public function testGetUrl(): void
    {
        $apiUrl = $this->string() ;
        $apiPath = $this->string() ;
        $apiKey = $this->string() ;
        $apiParams = $this->string() ;

        $guzzleHttpClientMock = $this->guzzleHttpClientMock();
        $client = new Client($guzzleHttpClientMock, $apiUrl, $apiKey);

        $url = $client->getUrl($apiPath,$apiParams );
        $expectedUrl = \sprintf('%s%s?api-key=%s%s', $apiUrl, $apiPath, $apiKey, $apiParams);
        $this->assertSame($expectedUrl, $url);
    }
}
