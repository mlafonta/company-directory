<?php

namespace App\Repository;

use App\Entity\Pronoun;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Pronoun>
 *
 * @method Pronoun|null find($id, $lockMode = null, $lockVersion = null)
 * @method Pronoun|null findOneBy(array $criteria, array $orderBy = null)
 * @method Pronoun[]    findAll()
 * @method Pronoun[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PronounRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Pronoun::class);
    }

    private function commitToDatabase(Pronoun $pronounModel): void
    {
        $this->getEntityManager()->persist($pronounModel);
        $this->getEntityManager()->flush();
    }
}
