<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{   
    private $encoder;

    public function __construct(UserPasswordHasherInterface $encoder){
        $this->encoder = $encoder;
    }
    public function load(ObjectManager $manager): void
    {
        $users = [
            [
            'firstname' => 'admin',
            'lastname' => 'admin',
            'email' => 'rh@humanbooster.com',
            'password' => 'rh123@',
            'picture' => 'http://',
            'isAdmin' => true
            ]
        ];

        foreach ($users as $User) {
            $object = new User($users);
            $object->setFirstname($user->getFirstname());
            $object->setLastname($user->getLastname());
            $object->setEmail($user->getEmail());
            
            if($User['isAdmin']) {
                $object->setRoles(['ROLE_RH']);
            }
            $object->setPassword($this->encoder->hashPassword($object, $user['password']));
            $manager->persist($object);
        }

        $manager->flush();
    }
}
