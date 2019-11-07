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
use App\Exception\EntityNotFoundException;
use App\Model\Article;
use Faker\Factory;

final class FakeArticlePresentationService implements ArticlePresentationInterface
{
    private const CATEGORIES = [
        'World',
        'Sport',
        'IT',
        'Science',
    ];
    private const ARTICLE_COUNT = 10;

    /**
     * Get latest Article[].
     */
    public function getLatest(): ArticleCollection
    {
        $faker = Factory::create();
        $articles = [];
        for ($i = 0; $i < self::ARTICLE_COUNT; ++$i) {
            $article = new Article(
                $faker->numberBetween(1, self::ARTICLE_COUNT),
                $faker->randomElement(self::CATEGORIES),
                $faker->words($faker->numberBetween(3, 5), true),
                \DateTimeImmutable::createFromMutable($faker->dateTimeBetween('-7 days'))
            );
            $article->setDescription(
                $faker->words($faker->numberBetween(4, 8), true)
            );
            $article->setImage($faker->imageUrl());
            $articles[] = $article;
        }

        return new ArticleCollection(...$articles);
    }

    /**
     * Find Article by id.
     *
     * @param int $id
     *
     * @return Article
     */
    public function findOne(int $id): Article
    {
        if ($id > self::ARTICLE_COUNT || $id < 1) {
            throw new EntityNotFoundException('Article does not exist.');
        }

        $faker = Factory::create();
        $article = new Article(
                $id,
                $faker->randomElement(self::CATEGORIES),
                $faker->words($faker->numberBetween(3, 5), true),
                \DateTimeImmutable::createFromMutable($faker->dateTimeBetween('-7 days'))
            );
        $article->setDescription(
                $faker->words($faker->numberBetween(100, 200), true)
            );
        $article->setImage($faker->imageUrl());

        return $article;
    }
}
