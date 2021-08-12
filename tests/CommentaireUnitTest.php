<?php

namespace App\Tests;

use App\Entity\Peinture;
use App\Entity\Commentaire;
use App\Entity\Blogpost;
use DateTime;
use PHPUnit\Framework\TestCase;

class CommentaireUnitTest extends TestCase
{
    public function testIsTrue()
    {
        $peinture= new Peinture();
        $datetime = new DateTime();
        $blogpost = new Blogpost();
        $commentaire = new Commentaire();


        $commentaire->setEmail('email@test.com')
                    ->setAuteur('auteur')
                    ->setCreatedAt($datetime)
                    ->setContenu('contenu')
                    ->setBlogpost($blogpost)
                    ->setPeinture($peinture);

        $this->assertTrue($commentaire->getEmail() === 'email@test.com');
        $this->assertTrue($commentaire->getAuteur() == 'auteur');
        $this->assertTrue($commentaire->getCreatedAt() === $datetime);
        $this->assertTrue($commentaire->getContenu() === 'contenu');
        $this->assertTrue($commentaire->getBlogpost() === $blogpost);
        $this->assertTrue($commentaire->getPeinture() === $peinture);



    }

    public function testIsFalse()
    {
        $peinture= new Peinture();
        $datetime = new DateTime();
        $blogpost = new Blogpost();
        $commentaire = new Commentaire();


        $commentaire->setEmail('email@test.com')
            ->setAuteur('auteur')
            ->setCreatedAt($datetime)
            ->setContenu('contenu')
            ->setBlogpost(new Blogpost())
            ->setPeinture(new Peinture());

        $this->assertFalse($commentaire->getEmail() === 'false');
        $this->assertFalse($commentaire->getAuteur() == 'false');
        $this->assertFalse($commentaire->getCreatedAt() === new DateTime());
        $this->assertFalse($commentaire->getContenu() === 'false');
        $this->assertFalse($commentaire->getBlogpost() === $blogpost);
        $this->assertFalse($commentaire->getPeinture() === $peinture);




    }

    public function testIsEmpty()
    {
        $commentaire= new Commentaire();


        $this->assertEmpty($commentaire->getEmail());
        $this->assertEmpty($commentaire->getAuteur());
        $this->assertEmpty($commentaire->getCreatedAt());
        $this->assertEmpty($commentaire->getContenu());
        $this->assertEmpty($commentaire->getBlogpost());
        $this->assertEmpty($commentaire->getPeinture());


    }
}
