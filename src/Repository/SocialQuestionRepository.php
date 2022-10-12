<?php

namespace App\Repository;

use App\Entity\SocialQuestion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<SocialQuestion>
 *
 * @method SocialQuestion|null find($id, $lockMode = null, $lockVersion = null)
 * @method SocialQuestion|null findOneBy(array $criteria, array $orderBy = null)
 * @method SocialQuestion[]    findAll()
 * @method SocialQuestion[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SocialQuestionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SocialQuestion::class);
    }

}
