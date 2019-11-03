<?php

namespace App\Service\Article;

use App\Model\Article;

interface ArticleEntityInterface
{
    public static function findOne(int $id): Article;
}
