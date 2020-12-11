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

    private static $numberUsers = 5;
    private static $defaultPassword = '123123';
    private static $defaultRole = ['ROLE_USER'];
    private static $adminRole = ['ROLE_ADMIN'];

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $this->createAdmin($manager);
        $faker = Faker\Factory::create('ro_RO');
        for($i = 0; $i < self::$numberUsers; $i++){
            $this->createUser($faker, $manager);
        }
        $manager->flush();
    }

    private function createUser(Faker\Generator $faker, ObjectManager $manager){
        $user = new User();
        $user->setName($faker->userName)
            ->setPassword($this->encoder->encodePassword($user, self::$defaultPassword))
            ->setEmail($faker->safeEmail)
            ->setRoles(self::$defaultRole)
            ->setPhone($faker->phoneNumber);
        $manager->persist($user);
    }

    private function createAdmin(ObjectManager $manager){
        $user = new User();
        $user->setName("Administrator")
            ->setPassword('$argon2id$v=19$m=65536,t=4,p=1$tUwlHq040EbTwNfoGoHx6g$fqpgeQG7/xBAsykSiHRer4sbq2eQ4il+oXUslDCAq44')
            ->setEmail("admin@haiurca.com")
            ->setRoles(self::$adminRole);
        $manager->persist($user);
    }
}
