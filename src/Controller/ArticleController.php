<?php

namespace App\Controller;

use App\Service\Article\FakeArticlePresentationService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

final class ArticleController extends AbstractController
{
    /**
     * Render single Article.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show(int $id): Response
    {
        $article = FakeArticlePresentationService::findOne($id);

        return $this->render('article/show.html.twig', ['article' => $article]);
    }
}
