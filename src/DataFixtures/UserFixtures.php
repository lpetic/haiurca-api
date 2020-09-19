<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private $encoder;

    private static $numberUsers = 10;
    private static $defaultPassword = '123456';
    private static $defaultRole = ['ROLE_USER'];

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('ro_RO');
        for($i = 0; $i < self::$numberUsers; $i++){
            $user = new User();
            $user->setName($faker->userName)
                ->setPassword($this->encoder->encodePassword($user, self::$defaultPassword))
                ->setEmail($faker->safeEmail)
                ->setRoles(self::$defaultRole)
                ->setPhone($faker->phoneNumber);
            $manager->persist($user);
        }
        $manager->flush();
    }
}
