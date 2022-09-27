<?php

declare(strict_types=1);

namespace App\Components\Contracts;

interface ArticleSearchApiFacade
{
    public function list(string $query): array;
}
