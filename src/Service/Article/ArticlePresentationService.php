<?php


namespace App\Service\Article;


use App\Collection\ArticleCollection;
use App\Model\Article;
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

    /**
     * @param int $id
     * @return Article
     */
    public function findOne(int $id): Article
    {
        // TODO: Implement findOne() method.
    }
}
