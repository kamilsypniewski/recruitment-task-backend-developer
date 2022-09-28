<?php

declare(strict_types=1);

namespace App\Components\Articles;

use App\Components\Contracts\ArticleSearchApiFacade;

final class ArticleFacade implements \App\Components\Contracts\ArticleFacade
{
    public function __construct(
        private readonly ArticleSearchApiFacade $articleSearchFacade,
        private readonly Article $article,
    ) {
    }

    public function getLatestAutomotiveArticles(string $query = ''): array
    {
        $articles = $this->articleSearchFacade->list($query);

        $list = [];
        foreach ($articles as $article) {
            $list[] = \array_merge(
                $this->article->articleBasicData($article),
                $this->article->articleExtendedData($query, $article)
            );
        }

        return $list;
    }
}
