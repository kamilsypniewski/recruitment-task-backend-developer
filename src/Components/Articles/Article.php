<?php

declare(strict_types=1);

namespace App\Components\Articles;

class Article
{
    public function articleExtendedData(string $query, array $article): array
    {
        $articleExtendedData = [];
        if (!empty($query)) {
            $articleExtendedData = [
                'section'    => $article['section_name']       ?? '',
                'subsection' => $article['subsection_name']    ?? '',
            ];
        }

        return $articleExtendedData;
    }

    public function articleBasicData(array $article): array
    {
        return [
            'title'           => $article['headline']['main']    ?? '',
            'publicationDate' => $article['pub_date']            ?? '',
            'lead'            => $article['lead_paragraph']      ?? '',
            'url'             => $article['web_url']             ?? '',
            'image'           => $this->prepareImageWithMultimedia($article['multimedia'] ?? []),
        ];
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
