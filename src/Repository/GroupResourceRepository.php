<?php

namespace App\Repository;

use App\Entity\GroupData;
use App\Entity\GroupResource;
use App\Entity\Resource;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<GroupResource>
 *
 * @method GroupResource|null find($id, $lockMode = null, $lockVersion = null)
 * @method GroupResource|null findOneBy(array $criteria, array $orderBy = null)
 * @method GroupResource[]    findAll()
 * @method GroupResource[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GroupResourceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GroupResource::class);
    }

    public function findResourceIdsByGroupId(int $groupId): array
    {
        $resourceModels = $this->createQueryBuilder('g')
            ->select('(g.resource)')
            ->andWhere('(g.group_data) = :id')
            ->setParameter('id', $groupId)
            ->getQuery()
            ->getScalarResult()
        ;
        $resourceIds= array();
        foreach ($resourceModels as $resourceModel) {
            $resourceIds[] = $resourceModel['1'];
        }
        return $resourceIds;
    }

    public function addResourceToGroup(int $resourceId, int $groupId): void
    {
        $groupResourceModel = new GroupResource();
        $groupResourceModel->setGroupData($this->getEntityManager()->getReference(GroupData::class, $groupId));
        $groupResourceModel->setResource($this->getEntityManager()->getReference(Resource::class, $resourceId));
        $this->commitToDatabase($groupResourceModel);
    }

    public function deleteResourceFromGroup(int $groupId, int $resourceId): void
    {
        $groupResourceModel = $this->findOneBy(array('group_data' => $groupId, 'resource' => $resourceId));
        $this->removeFromDatabase($groupResourceModel);
    }

    private function commitToDatabase(GroupResource $groupResourceModel): void
    {
        $this->getEntityManager()->persist($groupResourceModel);
        $this->getEntityManager()->flush();
    }

    private function removeFromDatabase(GroupResource $groupResourceModel): void
    {
        $this->getEntityManager()->remove($groupResourceModel);
        $this->getEntityManager()->flush();
    }
}
