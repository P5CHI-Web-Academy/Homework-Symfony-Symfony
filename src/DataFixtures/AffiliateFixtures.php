<?php

namespace App\DataFixtures;

use App\Entity\Affiliate;
use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class AffiliateFixtures extends Fixture implements DependentFixtureInterface
{
    /**
     * Generate random affiliates
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        for ($i = 0; $i < 4; $i++) {
            $affiliate = new Affiliate();
            $affiliate->setUrl($faker->url);
            $affiliate->setEmail($faker->email);
            $affiliate->setToken($faker->md5);
            $affiliate->setActive(true);

            for ($y = 0; $y < 4; $y++) {
                if ($y === $i) {
                    continue;
                }
                /** @var Category $category */
                $category = $this->getReference('category-' . $y);
                $category->addAffiliate($affiliate);

                $manager->persist($category);
            }

            $manager->persist($affiliate);
        }

        $manager->flush();
    }

    /**
     * @return array
     */
    public function getDependencies(): array
    {
        return array(
            CategoryFixtures::class,
        );
    }
}
