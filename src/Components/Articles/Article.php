<?php

declare(strict_types=1);

namespace App\Components\Articles;

interface Article
{
    public function articleExtendedData(string $query, array $article): array;

    public function articleBasicData(array $article): array;
}
