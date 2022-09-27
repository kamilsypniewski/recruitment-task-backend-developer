<?php
declare(strict_types=1);

namespace App\Controller;

use App\Components\Contracts\ArticleFacade;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class Nytimes extends AbstractController
{
    #[Route('/nytimes', name: 'app_nytimes_list_articles', methods: ['GET'])]
    public function listArticles(ArticleFacade $articleFacade):JsonResponse
    {
        return new JsonResponse(
            [
                $articleFacade->getLatestAutomotiveArticles()
            ]
        );
    }
}