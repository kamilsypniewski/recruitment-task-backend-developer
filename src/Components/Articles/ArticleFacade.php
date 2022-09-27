<?php
declare(strict_types=1);

namespace App\Components\Articles;

use App\Components\Contracts\ArticleSearchApiFacade;

class ArticleFacade implements \App\Components\Contracts\ArticleFacade
{
    public function __construct(private readonly ArticleSearchApiFacade $articleSearchFacade)
    {
    }

    public function getLatestAutomotiveArticles(string $query = ''):array
    {
        $articles =  $this->articleSearchFacade->list($query);

        $list = [];
        foreach ($articles as $article) {
            $list[] = array_merge(
                $this->articleBasicData($article),
                $this->articleExtendedData($query, $article)
            );
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

    private function articleExtendedData(string $query, array $article): array
    {
        $articleExtendedData = [];
        if (!empty($query)) {
            $articleExtendedData = [
                'section' => $article['section_name'] ?? '',
                'subsection' => $article['subsection_name'] ?? '',
            ];
        }

        return $articleExtendedData;
    }

    private function articleBasicData(array $article): array
    {
        return [
            'title' => $article['headline']['main'] ?? '',
            'publicationDate' => $article['pub_date'] ?? '',
            'lead' => $article['lead_paragraph'] ?? '',
            'image' => $this->prepareImageWithMultimedia($article['multimedia']),
            'url' => $article['web_url'] ?? '',
        ];
    }
}