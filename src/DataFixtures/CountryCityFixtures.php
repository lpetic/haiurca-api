<?php

namespace App\DataFixtures;

use App\Entity\City;
use App\Entity\Country;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\DataFixtures\AppData;

class CountryCityFixtures extends Fixture
{

    public function load(ObjectManager $manager)
    {
        foreach (AppData::$countriesCities as $countryName => $arrayCities){
            $country = new Country();
            $country->setName($countryName);
            $manager->persist($country);
            foreach ($arrayCities as $cityName){
                $city = new City();
                $city->setName($cityName)
                    ->setCountry($country);
                $manager->persist($city);
            }
        }
        $manager->flush();
    }
}
