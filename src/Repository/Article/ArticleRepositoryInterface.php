<?php


namespace App\Repository\Article;


use App\Entity\Article;

interface ArticleRepositoryInterface
{
    /**
     * @return Article[]
     */
    public function findLatest(): iterable;

}
