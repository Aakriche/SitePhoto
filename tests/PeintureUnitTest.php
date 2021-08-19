<?php

namespace App\Tests;

use App\Entity\Commentaire;
use App\Entity\Peinture;
use App\Entity\User;
use App\Entity\Categorie;
use DateTime;
use PHPUnit\Framework\TestCase;

class PeintureUnitTest extends TestCase
{
    public function testIsTrue()
    {
        $peinture= new Peinture();
        $datetime = new DateTime();
        $user = new User();
        $categorie = new Categorie();


        $peinture->setEnVente(true)
                ->setLargeur(20.20)
                ->setHauteur(20.20)
                ->setNom('nom')
                ->setDateRealisation($datetime)
                ->setCreatedAt($datetime)
                ->setDescription('description')
                ->setPortfolio(true)
                ->setSlug('slug')
                ->addCategorie($categorie)
                ->setPrix(20.20)
                ->setUser($user)
                ->setFile('file');

        $this->assertTrue($peinture->getEnVente() === true);
        $this->assertTrue($peinture->getLargeur() == 20.20);
        $this->assertTrue($peinture->getNom() === 'nom');
        $this->assertTrue($peinture->getHauteur() == 20.20);
        $this->assertTrue($peinture->getDateRealisation() === $datetime);
        $this->assertTrue($peinture->getCreatedAt() === $datetime);
        $this->assertTrue($peinture->getDescription() === 'description');
        $this->assertTrue($peinture->getPortfolio() === true);
        $this->assertTrue($peinture->getSlug() === 'slug');
        $this->assertTrue($peinture->getFile() === 'file');
        $this->assertTrue($peinture->getPrix() == 20.20);
        $this->assertTrue($peinture->getUser() === $user);
        $this->assertContains($categorie, $peinture->getCategorie());


    }

    public function testIsFalse()
    {
        $peinture= new Peinture();
        $datetime = new DateTime();
        $user = new User();
        $categorie = new Categorie();


        $peinture->setEnVente(true)
            ->setLargeur(20.20)
            ->setHauteur(20.20)
            ->setNom('nom')
            ->setDateRealisation($datetime)
            ->setCreatedAt($datetime)
            ->setDescription('description')
            ->setPortfolio(true)
            ->setSlug('slug')
            ->addCategorie($categorie)
            ->setPrix(20.20)
            ->setUser($user)
            ->setFile('file');

        $this->assertFalse($peinture->getEnVente() === false);
        $this->assertFalse($peinture->getLargeur() == 22.20);
        $this->assertFalse($peinture->getNom() === 'false');
        $this->assertFalse($peinture->getHauteur() == 22.20);
        $this->assertFalse($peinture->getDateRealisation() === new DateTime());
        $this->assertFalse($peinture->getCreatedAt() === new DateTime());
        $this->assertFalse($peinture->getDescription() === 'false');
        $this->assertFalse($peinture->getPortfolio() === false);
        $this->assertFalse($peinture->getSlug() === 'false');
        $this->assertFalse($peinture->getFile() === 'false');
        $this->assertFalse($peinture->getPrix() == 22.20);
        $this->assertFalse($peinture->getUser() === new User());
        $this->assertNotContains(new Categorie(), $peinture->getCategorie());


    }

    public function testIsEmpty()
    {
        $peinture= new Peinture();


        $this->assertEmpty($peinture->getEnVente());
        $this->assertEmpty($peinture->getLargeur());
        $this->assertEmpty($peinture->getNom());
        $this->assertEmpty($peinture->getHauteur());
        $this->assertEmpty($peinture->getDateRealisation());
        $this->assertEmpty($peinture->getCreatedAt());
        $this->assertEmpty($peinture->getDescription());
        $this->assertEmpty($peinture->getPortfolio());
        $this->assertEmpty($peinture->getSlug());
        $this->assertEmpty($peinture->getFile());
        $this->assertEmpty($peinture->getPrix());
        $this->assertEmpty($peinture->getUser());
        $this->assertEmpty($peinture->getCategorie());
        $this->assertEmpty($peinture->getId());



    }

    public function testAddGetRemoveCommentaire()
    {
        $peinture = new Peinture();
        $commentaire = new Commentaire();

        $this->assertEmpty($peinture->getCommentaires());

        $peinture->addCommentaire($commentaire);
        $this->assertContains($commentaire, $peinture->getCommentaires());

        $peinture->removeCommentaire($commentaire);
        $this->assertEmpty($peinture->getCommentaires());
    }

    public function testAddGetRemoveCategorie()
    {
        $peinture = new Peinture();
        $categorie = new Categorie();

        $this->assertEmpty($peinture->getCategorie());

        $peinture->addCategorie($categorie);
        $this->assertContains($categorie, $peinture->getCategorie());

        $peinture->removeCategorie($categorie);
        $this->assertEmpty($peinture->getCategorie());
    }


}
