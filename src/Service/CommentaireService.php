<?php

namespace App\Service;

use App\Entity\Blogpost;
use App\Entity\Commentaire;
use App\Entity\Peinture;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;

class CommentaireService
{
    private $manager;
    private $flash;

    public function __construct(EntityManagerInterface $manager, FlashBagInterface $flash)
    {
        $this->manager = $manager;
        $this->flash = $flash;
    }

    public function persistCommentaire(
        Commentaire $commentaire,
        Blogpost $blogpost = null,
        Peinture $peinture = null
    ): void {
        $commentaire->setIsPublished(false)
            ->setBlogpost($blogpost)
            ->setPeinture($peinture)
            ->setCreatedAt(new DateTime('now'));

        $this->manager->persist($commentaire);
        $this->manager->flush();
        $this->flash->add('success', 'Votre commentaire a bien été envoyé, il sera publié après validation');

    }

}