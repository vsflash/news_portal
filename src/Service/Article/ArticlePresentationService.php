<?php


namespace App\Service\Article;


use App\Collection\ArticleCollection;
use App\Entity\Article;
use App\Repository\Article\ArticleRepositoryInterface;

final class ArticlePresentationService implements ArticlePresentationInterface
{
    private $articleRepository;

    public function __construct(ArticleRepositoryInterface $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }

    /**
     * {@inheritDoc}
     */
    public function getLatest(): ArticleCollection
    {
        $articles = $this->articleRepository->findLatest();

        return new ArticleCollection(...$articles);
    }

    public function getLatestByCategoryId(int $id): ArticleCollection
    {
        $articles = $this->articleRepository->findLatestByCategoryId($id);

        return new ArticleCollection(...$articles);
    }

    /**
     * {@inheritdoc}
     */
    public function findOne(int $id): Article
    {
        return $this->articleRepository->findOne($id);
    }
}
