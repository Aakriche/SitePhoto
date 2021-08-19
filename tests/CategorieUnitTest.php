<?php

namespace App\Tests;

use App\Entity\Categorie;
use App\Entity\Peinture;
use PHPUnit\Framework\TestCase;

class CategorieUnitTest extends TestCase
{
    public function testIsTrue()
    {
        $user = new Categorie();

        $user->setSlug('slug')
            ->setDescription('description')
            ->setNom('nom');


        $this->assertTrue($user->getSlug() === 'slug');
        $this->assertTrue($user->getDescription() === 'description');
        $this->assertTrue($user->getNom() === 'nom');


    }
    public function testIsFalse()
    {
        $user = new Categorie();

        $user->setSlug('slug')
            ->setDescription('description')
            ->setNom('nom');


        $this->assertFalse($user->getSlug() === 'false');
        $this->assertFalse($user->getDescription() === 'false');
        $this->assertFalse($user->getNom() === 'false');


    }

    public function testIsEmpty()
    {
        $user = new Categorie();


        $this->assertEmpty($user->getSlug());
        $this->assertEmpty($user->getDescription());
        $this->assertEmpty($user->getNom());
        $this->assertEmpty($user->getId());

    }

    public function testAddGetRemovePeinture()
    {
        $peinture = new Peinture();
        $categorie = new Categorie();

        $this->assertEmpty($categorie->getPeintures());

        $categorie->addPeinture($peinture);
        $this->assertContains($peinture, $categorie->getPeintures());

        $categorie->removePeinture($peinture);
        $this->assertEmpty($categorie->getPeintures());
    }

}

