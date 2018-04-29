<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker;
use App\Entity\Affiliate;
use App\Entity\Category;


class AffiliateFixtures extends Fixture implements DependentFixtureInterface
{

    const COUNT = 20;

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create();

        for ($i = 1; $i <= self::COUNT; $i++) {
            $affiliate = new Affiliate();
            $affiliate
                ->setEmail($faker->email)
                ->setToken($faker->sha256)
                ->setUrl($faker->url)
                ->setActive($faker->boolean);

            $categoryIds = \range(1, CategoryFixtures::COUNT);
            $randomKeys = \array_rand($categoryIds, \rand(3, 12));

            foreach ($randomKeys as $key) {
                $categoryId = $categoryIds[$key];

                /** @var Category $category */
                $category = $this->getReference(CategoryFixtures::generateReferenceKey($categoryId));

                $affiliate->addCategory($category);
            }

            $manager->persist($affiliate);
        }

        $manager->flush();
    }


    /**
     * @inheritDoc
     */
    function getDependencies(): array
    {
        return [
            CategoryFixtures::class,
        ];
    }
}
