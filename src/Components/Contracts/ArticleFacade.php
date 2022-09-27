<?php
declare(strict_types=1);

namespace App\Components\Contracts;


interface ArticleFacade
{
    public function getLatestAutomotiveArticles():array;
}