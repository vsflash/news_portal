<?php

namespace App\Controller;

use App\Exception\EntityNotFoundException;
use App\Service\Article\ArticlePresentationInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

final class ArticleController extends AbstractController
{
    /**
     * Render single Article.
     *
     * @param int $id
     *
     * @param ArticlePresentationInterface $presentationService
     *
     * @return Response
     */
    public function show(int $id, ArticlePresentationInterface $presentationService): Response
    {
        try {
            $article = $presentationService->findOne($id);
        } catch (EntityNotFoundException $e) {
            throw new EntityNotFoundException('Article does not exist.');
        }


        return $this->render('article/show.html.twig', ['article' => $article]);
    }
}
