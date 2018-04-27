<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;
use App\Entity\Category;


class CategoryFixtures extends Fixture
{
    const COUNT = 20;

    const REFERENCE = 'category';

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        for ($i = 1; $i <= self::COUNT; $i++) {
            $category = new Category();
            $category->setName($faker->domainWord);

            $manager->persist($category);

            $this->addReference(static::generateReferenceKey($i), $category);
        }

        $manager->flush();
    }

    /**
     * @return string
     */
    public static function generateRandomKeyReference(): string
    {
        return static::generateReferenceKey(\rand(1, CategoryFixtures::COUNT));
    }

    /**
     * @param int $id
     * @return string
     */
    public static function generateReferenceKey($id): string
    {
        return CategoryFixtures::REFERENCE.$id;
    }
}
