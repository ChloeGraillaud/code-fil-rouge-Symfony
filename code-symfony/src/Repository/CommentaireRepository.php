<?php

namespace App\Repository;

use App\Entity\Commentaire;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Commentaire>
 */
class CommentaireRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Commentaire::class);
    }

    public function findValidatedComments(): array
{
    return $this->createQueryBuilder('c')
        ->andWhere('c.statut = :val')
        ->setParameter('val', 1)
        ->orderBy('c.commentaireDate', 'DESC')
        ->getQuery()
        ->getResult();
}
}