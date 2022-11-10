<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;
use App\Entity\Jeu;
use Faker;

class AppFixtures extends Fixture
{
    public function __construct(UserPasswordHasherInterface $userPasswordHasher){
        $this->userPasswordHasher = $userPasswordHasher;
    }

    public function load(ObjectManager $manager): void
    {

        $genre = ["Coopératif","Familiale","Trahison","Stratégie"];
        $j=0;
        $faker = Faker\Factory::create();

        for($i = 0; $i<10; $i++){

            // -- JEU --
            $jeu = new Jeu();
            $jeu->setNom($faker->streetName);
            $jeu->setDateSortie($faker->dateTime);
            $jeu->setGenre($genre[$j]);
            $jeu->setDescription($faker->text(50));
            $manager->persist($jeu);

            $j++;
            if($j == 3){
                $j=0;
            }

            // -- USER --
            $user = new User();
            $user->setEmail("user".$i."@gmail.com");
            $user->setRoles(['ROLE_USER']);
            $user->setPassword($this->userPasswordHasher->hashPassword($user,"123"));
            $user->setNom($faker->lastname);
            $user->setPrenom($faker->firstname);
            $manager->persist($user);

        }

        $manager->flush();
    }
}
