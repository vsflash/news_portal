<?php

namespace App\DataFixtures;

use App\Entity\Article;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class ArticleFixture extends AbstractFixture
{
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 15; $i++) {
            $title = ucfirst($this->faker->words($this->faker->numberBetween(3, 5), true));
            $article = new Article($title);

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
}
