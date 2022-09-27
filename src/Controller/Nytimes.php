<?php

declare(strict_types=1);

namespace App\Controller;

use App\Components\Contracts\ArticleFacade;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class Nytimes extends AbstractController
{
    #[Route('/nytimes', name: 'app_nytimes_list_articles', methods: ['GET'])]
    public function listArticles(ArticleFacade $articleFacade): JsonResponse
    {
        return new JsonResponse(
            [
                $articleFacade->getLatestAutomotiveArticles(),
            ]
        );
    }

    #[Route('/nytimes/{query}', name: 'app_nytimes_list_articles_with_filters', methods: ['GET'])]
    public function listArticlesWithFilters(ArticleFacade $articleFacade, string $query): JsonResponse
    {
        return new JsonResponse(
            [
                $articleFacade->getLatestAutomotiveArticles($query),
            ]
        );
    }
}
