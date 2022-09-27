<?php
declare(strict_types=1);

namespace App\Components\Articles;

use App\Components\Contracts\ArticleSearchApiFacade;

class ArticleFacade implements \App\Components\Contracts\ArticleFacade
{
    public function __construct(private readonly ArticleSearchApiFacade $articleSearchFacade)
    {
    }

    public function getLatestAutomotiveArticles():array
    {
        $articles =  $this->articleSearchFacade->list();

        $list = [];
        foreach ($articles as $article) {
            $list[] = [
                'title' => $article['headline']['main'],
                'publicationDate' => $article['pub_date'],
                'lead' => $article['lead_paragraph'],
                'image' => $this->prepareImageWithMultimedia($article['multimedia']),
                'url' => $article['web_url'],
            ];
        }

        return $list;
    }

    private function prepareImageWithMultimedia(array $multimediaList): array
    {
        $image = [];
        foreach ($multimediaList as $multimedia) {
            if ('superJumbo' === $multimedia['subtype']) {
                $image = $multimedia;
            }
        }

        return $image;
    }
}