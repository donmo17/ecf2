<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    public function __construct(private UserPasswordHasherInterface $hasher) {}

    public function load(ObjectManager $manager): void
    {
        // USER
        $user = new User();
        $user->setEmail('johndoe@test.fr')
            ->setRoles(['ROLE_USER'])
            ->setPassword($this->hasher->hashPassword($user, 'password'))
            ->setFirstName('John')
            ->setLastName('DOE')
            ->setAddress('12 avenue du Général Leclerlc')
            ->setZipCode('95130')
            ->setCity('Franconville')
            ->setImage('https://images.pexels.com/photos/4298629/pexels-photo-4298629.jpeg?auto=compress&cs=tinysrgb&w=600')
        ;
        $manager->persist($user);

        // ADMIN

        // ROOMS

        // BOOKINGS

        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
