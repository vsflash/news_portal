<?php

namespace App\DataFixtures;

use App\Entity\Article;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

final class ArticleFixture extends AbstractFixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 15; $i++) {
            $title = ucfirst($this->faker->words($this->faker->numberBetween(3, 5), true));
            $category = $this->getReference($this->faker->randomElement(array_keys(CategoryFixture::CATEGORIES)));
            $article = new Article($title);

            $article->setCategory($category);
            $article->setDescription(ucfirst($this->faker->words($this->faker->numberBetween(4, 8), true)));
            $article->setImage($this->faker->imageUrl());

            $body = '';
            $sentences = $this->faker->numberBetween(4, 8);

            for ($j = 0; $j < $sentences; $j++) {
                $body .= '<p>'
                . $this->faker->words($this->faker->numberBetween(4, 8), true)
                . '</p>';
            }

            $article->setBody($body);

            if ($this->faker->boolean(80)) {
                $article->publish();
            }

            $manager->persist($article);
        }

        $manager->flush();
    }

    /**
     * This method must return an array of fixtures classes
     * on which the implementing class depends on
     *
     * @return array
     */
    public function getDependencies()
    {
        return [CategoryFixture::class];
    }
}
