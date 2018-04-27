<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class CategoryFixtures extends Fixture
{
    public const TOTAL = 4;

    /**
     * Generate random categories
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        for ($i = 0; $i < self::TOTAL; $i++) {
            $category = new Category();
            $category->setName($faker->word);

            $manager->persist($category);

            $this->addReference('category-' . $i, $category);
        }

        $manager->flush();
    }
}
