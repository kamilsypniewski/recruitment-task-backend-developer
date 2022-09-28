<?php

declare(strict_types=1);

namespace App\Tests\Components\ArticleSearchApi;

use App\Components\ArticleSearchApi\ArticleSearchApiFacade;
use PHPUnit\Framework\TestCase;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 * @psalm-suppress RedundantCondition
 */
final class ArticleSearchApiFacadeTest extends TestCase
{
    use Fixtures;

    public function testList(): void
    {
        $apiParams = '&fq=news_desk:("Automobiles")';

        $clientMock = $this->clientMock();
        $clientMock->expects($this->once())
            ->method('getUrl')
            ->with(
                $this->isType('string'),
                $apiParams
            );
        $clientMock->expects($this->once())
            ->method('request')
            ->with(
                $this->isType('string'),
            )
            ->willReturn($this->contents());

        $articleSearchApiFacade = new ArticleSearchApiFacade($clientMock);

        $doc = $articleSearchApiFacade->list('');

        $this->assertIsArray($doc);
        $this->assertEmpty($doc);
    }

    public function testListWithQuery(): void
    {
        $query = $this->string();
        $apiParams =  \sprintf('&fq=news_desk:("Automobiles") body("%s")', $query);

        $clientMock = $this->clientMock();
        $clientMock->expects($this->once())
            ->method('getUrl')
            ->with(
                $this->isType('string'),
                $apiParams
            );
        $clientMock->expects($this->once())
            ->method('request')
            ->willReturn($this->contents());

       $articleSearchApiFacade = new ArticleSearchApiFacade($clientMock);

       $articleSearchApiFacade->list($query);
    }

    public function testListRequestEmpty(): void
    {
        $clientMOck = $this->clientMock();
        $clientMOck->expects($this->once())
            ->method('request')
            ->with(
                $this->isType('string'),
            )
            ->willReturn('{""}');

        $articleSearchApiFacade = new ArticleSearchApiFacade($clientMOck);

        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('Invalid api response format');
        $articleSearchApiFacade->list('');
    }
}
