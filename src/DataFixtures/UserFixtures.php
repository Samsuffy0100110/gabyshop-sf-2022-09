<?php

namespace App\DataFixtures;

use App\Entity\User;
use DateTimeImmutable;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setEmail("admin@localhost.fr");
        $user->setRoles(["ROLE_ADMIN"]);
        $hashPassword = $this->passwordHasher->hashPassword($user, "admin");
        $user->setFirstname("Admin");
        $user->setLastname("Lastname");
        $user->setIsPro(true);
        $user->setIdpro("123456789");
        $user->setCompanyname("GABYshop");
        $user->setGoogleId("123456789");
        $user->setIsNewsletterOk(true);
        $user->setBirthday(new DateTimeImmutable());
        $user->setGender("Femme");
        $user->setPhone("0631896524");
        $this->addReference("Admin", $user);
        $user->setPassword($hashPassword);
        $manager->persist($user);
        $manager->flush();
    }
}
