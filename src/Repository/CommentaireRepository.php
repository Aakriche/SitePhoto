<?php

namespace App\Repository;

use App\Entity\Blogpost;
use App\Entity\Commentaire;
use App\Entity\Peinture;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Commentaire|null find($id, $lockMode = null, $lockVersion = null)
 * @method Commentaire|null findOneBy(array $criteria, array $orderBy = null)
 * @method Commentaire[]    findAll()
 * @method Commentaire[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommentaireRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Commentaire::class);
    }


    public function findCommentaires($value)
    {
        if ($value instanceof Blogpost) {
            $object = 'blogpost';

        }

        if ($value instanceof Peinture) {
            $object = 'peinture';

        }

        return $this->createQueryBuilder('c')
            ->andWhere('c.' . $object . ' = :val')
            ->andWhere('c.isPublished = true')
            ->setParameter('val', $value->getId())
            ->orderBy('c.id', 'DESC')
            ->getQuery()
            ->getResult();
    }

}

