<?php

declare(strict_types=1);

namespace App\Tests\Components\Articles;


use App\Components\Articles\Article;
use App\Components\Articles\ArticleFacade;
use PHPUnit\Framework\TestCase;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 * @psalm-suppress RedundantCondition
 */
final class ArticleTest extends TestCase
{
    use Fixtures;

    public function testArticleBasicData(): void
    {
        $article = new Article();

        $articleBasicData = $article->articleBasicData($this->getArticleResponse());

        $this->assertArrayHasKey('title', $articleBasicData);
        $this->assertArrayHasKey('publicationDate', $articleBasicData);
        $this->assertArrayHasKey('lead', $articleBasicData);
        $this->assertArrayHasKey('image', $articleBasicData);
        $this->assertArrayHasKey('url', $articleBasicData);

        $this->assertNotEmpty($articleBasicData['title']);
        $this->assertNotEmpty($articleBasicData['publicationDate']);
        $this->assertNotEmpty($articleBasicData['lead']);
        $this->assertEmpty($articleBasicData['image']);
        $this->assertNotEmpty($articleBasicData['url']);

    }

    public function testArticleBasicDataWithSetMultimediaSubtype(): void
    {
        $article = new Article();

        $articleBasicData = $article->articleBasicData($this->getArticleResponse(
            multimediaSubType:'superJumbo'
        ));

        $this->assertArrayHasKey('subtype', $articleBasicData['image']);
    }

    public function testArticleExtendedDataWithSetQuery(): void
    {
        $article = new Article();

        $articleBasicData = $article->articleExtendedData($this->string(), $this->getArticleResponse());

        $this->assertArrayHasKey('section', $articleBasicData);
        $this->assertArrayHasKey('subsection', $articleBasicData);

        $this->assertNotEmpty($articleBasicData['section']);
        $this->assertNotEmpty($articleBasicData['subsection']);

    }

    public function testArticleExtendedDataWithQueryEmpty(): void
    {
        $article = new Article();

        $articleBasicData = $article->articleExtendedData('', $this->getArticleResponse());

        $this->assertIsArray($articleBasicData);
        $this->assertEmpty($articleBasicData);
    }
}
