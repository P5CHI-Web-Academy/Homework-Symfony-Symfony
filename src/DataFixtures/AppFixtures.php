<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Job;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create();

        for ( $i = 1; $i <= 10; $i++ ):
            $category = new Category();
            $category->setName(strtoupper($faker->word));
            $manager->persist($category);

            $this->addReference('category_' . $i, $category);

        endfor;
        $manager->flush();

        for ($i = 1; $i <= 10; $i++):
            $job = new Job();
            $job->setCategoryId($this->getReference('category_' . rand(1,10)));
            $job->setType($faker->word);
            $job->setCompany($faker->company);
            $job->setLogo($faker->imageUrl(100, 100));
            $job->setUrl($faker->url);
            $job->setPosition($faker->randomDigit);
            $job->setLocation($faker->city);
            $job->setDescription($faker->text);
            $job->setHowToApply($faker->paragraph);
            $job->setToken(uniqid());
            $job->setPublic($faker->boolean(90));
            $job->setActivated($faker->boolean(95));
            $job->setEmail($faker->email);
            $job->setExpiresAt($faker->dateTime($max = 'now'));
            $job->setCreatedAt($faker->dateTime($max = 'now'));
            $job->setUpdatedAt($faker->dateTime($max = 'now'));

            $manager->persist($job);
        endfor;
        $manager->flush();


    }
}
