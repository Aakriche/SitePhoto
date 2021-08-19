<?php

namespace App\DataFixtures;

use App\Entity\Blogpost;
use App\Entity\Categorie;
use App\Entity\User;
use App\Entity\Peinture;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;



class AppFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        //Utilisation de Faker
        $faker = Factory::create('fr_FR');

        //Creation User
        $user = new User();

        $user->setEmail('user@test.com')
            ->setPrenom($faker->firstName())
            ->setNom($faker->lastName())
            ->setTelephone($faker->phoneNumber())
            ->setAPropos($faker->text())
            ->setInstagram('instagram')
            ->setRoles(['ROLE_PEINTRE']);

        $password = $this->encoder->encodePassword($user, 'password');
        $user->setPassword($password);

        $manager->persist($user);

        //Creation 10 Blogposts
        for ($i=0; $i < 10; $i++) {

            $blogpost = new Blogpost();

            $blogpost->setTitre($faker->words(3, true))
                ->setCreatedAt(\DateTimeImmutable::createFromFormat('Y-m-d', "2018-09-09"))
                ->setContenu($faker->text(350))
                ->setSlug($faker->slug(3))
                ->setUser($user);

            $manager->persist($blogpost);
        }

        //Creation un blogpost pour test
        $blogpost = new Blogpost();

        $blogpost->setTitre('Blogpost test')
            ->setCreatedAt(\DateTimeImmutable::createFromFormat('Y-m-d', "2018-09-09"))
            ->setContenu($faker->text(350))
            ->setSlug('blogpost-test')
            ->setUser($user);

        $manager->persist($blogpost);


        //Creation de 5 Catégories
        for ($k=0; $k <5; $k++)   {
            $categorie = new Categorie();

            $categorie->setNom($faker->word())
                ->setDescription($faker->words(10, true))
                ->setSlug($faker->slug());

            $manager->persist($categorie);

            //Creation de 2 peintures par catégorie
            for ($j=0; $j<2; $j++) {
                $peinture = new Peinture();


                $peinture->setNom($faker->words(3, true))
                    ->setHauteur($faker->randomFloat(2,20,60))
                    ->setLargeur($faker->randomFloat(2,20,60))
                    ->setEnVente($faker->randomElement([true, false]))
                    ->setDateRealisation(\DateTimeImmutable::createFromFormat('Y-m-d', "2018-09-09"))
                    ->setCreatedAt(\DateTimeImmutable::createFromFormat('Y-m-d', "2019-09-09"))
                    ->setDescription($faker->text())
                    ->setPortfolio($faker->randomElement([true, false]))
                    ->setSlug($faker->slug())
                    ->setFile('/img/placeholder.jpg')
                    ->addCategorie($categorie)
                    ->setPrix($faker->randomFloat(2, 100, 9999))
                    ->setUser($user);

                $manager->persist($peinture);

            }
        }

        //Creation catégorie de test

        $categorie = new Categorie();

        $categorie->setNom('categorie test')
            ->setDescription($faker->words(10, true))
            ->setSlug('categorie-test');

        $manager->persist($categorie);

        //Creation peinture pour test

        $peinture = new Peinture();

        $peinture->setNom('peinture de test')
            ->setHauteur($faker->randomFloat(2,20,60))
            ->setLargeur($faker->randomFloat(2,20,60))
            ->setEnVente($faker->randomElement([true, false]))
            ->setDateRealisation(\DateTimeImmutable::createFromFormat('Y-m-d', "2018-09-09"))
            ->setCreatedAt(\DateTimeImmutable::createFromFormat('Y-m-d', "2019-09-09"))
            ->setDescription($faker->text())
            ->setPortfolio($faker->randomElement([true, false]))
            ->setSlug('peinture-test')
            ->setFile('/img/placeholder.jpg')
            ->addCategorie($categorie)
            ->setPrix($faker->randomFloat(2, 100, 9999))
            ->setUser($user);

        $manager->persist($peinture);


        $manager->flush();
    }
}
