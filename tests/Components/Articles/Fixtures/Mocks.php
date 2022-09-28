<?php

declare(strict_types=1);

namespace App\Tests\Components\Articles\Fixtures;

use App\Components\Articles\Article;
use App\Components\Contracts\ArticleSearchApiFacade;
use PHPUnit\Framework\MockObject\MockObject;

trait Mocks
{
    abstract protected function createMock(string $originalClassName): MockObject;

    protected function articleSearchApiFacadeMock(): ArticleSearchApiFacade|MockObject
    {
        return $this->createMock(ArticleSearchApiFacade::class);
    }
    protected function articleMock(): Article|MockObject
    {
        return $this->createMock(Article::class);
    }


}
