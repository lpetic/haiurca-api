<?php

namespace App\DataFixtures;

use App\Entity\Travel;
use App\Repository\CityRepository;
use App\Repository\UserRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker;

class TravelFixtures extends Fixture implements DependentFixtureInterface
{
    private $userRepository;
    private $cityRepository;

    public function __construct(UserRepository $userRepository, CityRepository $cityRepository)
    {
        $this->userRepository = $userRepository;
        $this->cityRepository = $cityRepository;
    }

    private static $numberTravels = 20;

    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('ro_RO');
        $users = $this->userRepository->findAll();
        $cities = $this->cityRepository->findAll();
        for ($i = 0; $i < self::$numberTravels; $i++){
            $travel = new Travel();
            $travel->setUser($users[$faker->numberBetween(1,count($users)-1)])
                ->setOrigin($cities[$faker->numberBetween(1,count($cities)-1)])
                ->setDestination($cities[$faker->numberBetween(1,count($cities)-1)])
                ->setDescription($faker->realText(200,2))
                ->setPrice($faker->numberBetween(30,150))
                ->setGo($faker->dateTime);
            $manager->persist($travel);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            UserFixtures::class,
            CountryCityFixtures::class
        );
    }
}
