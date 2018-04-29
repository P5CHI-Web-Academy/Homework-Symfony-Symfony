<?php

namespace App\DataFixtures;

use App\Entity\Affiliate;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class AffiliateFixtures extends Fixture implements DependentFixtureInterface
{
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('en_US');

        for ($i = 0; $i < 10; $i++) {
            $affiliate = new Affiliate();
            $affiliate->setUrl($faker->url);
            $affiliate->setEmail($faker->email);
            $affiliate->setToken($faker->password(6, 6));
            $affiliate->setActive($faker->boolean);
            $affiliate->addCategory($this->getReference('category_' . $i));
            $manager->persist($affiliate);
        }

        $manager->flush();
    }

    /**
     * @return array
     */
    public function getDependencies(): array
    {
        return [
            CategoryFixtures::class,
        ];
    }
}
