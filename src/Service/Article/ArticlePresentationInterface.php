<?php

declare(strict_types=1);

/*
 * This file is part of the "News Portal" project.
 *
 * (c) Vadim Selyan <vadimselyan@gmail.com>
 *
 */

namespace App\Service\Article;

use App\Collection\ArticleCollection;

interface ArticlePresentationInterface
{
    public function getLatest(): ArticleCollection;
}
