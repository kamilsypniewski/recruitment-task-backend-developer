<?php

declare(strict_types=1);

namespace App\Tests\Components\Articles;


use App\Components\Articles\ArticleFacade;
use PHPUnit\Framework\TestCase;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 * @psalm-suppress RedundantCondition
 */
final class ArticleFacadeTest extends TestCase
{
    use Fixtures;

    public function testGetLatestAutomotiveArticles(): void
    {
        $articleSearchApiFacadeMock = $this->articleSearchApiFacadeMock();

        $articleSearchApiFacadeMock->expects($this->once())
            ->method('list')
            ->with(
                $this->isType('string'),
            )
            ->willReturn(
                [[],[]]
            );

        $articleMock = $this->articleMock();

        $articleMock->expects($this->exactly(2))
            ->method('articleBasicData')
            ->willReturn([], []);
        $articleMock->expects($this->exactly(2))
            ->method('articleExtendedData')
            ->willReturn([], []);

        $articleFacade = new ArticleFacade($articleSearchApiFacadeMock, $articleMock);

        $query = '';

        $list = $articleFacade->getLatestAutomotiveArticles($query);
        $this->assertIsArray($list);
        $this->assertCount(2, $list);

    }
}
