<?php

namespace App\Repository;

use App\DTO\UserDTO;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<User>
 *
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    public function findAllUsers(): array
    {
        $userModels = $this->findAll();
        $userDTOs = [];
        foreach ($userModels as $userModel) {
            if ($userModel->getActive()) {
                $userDTO = $this->convertModelToDTO($userModel);
                array_push($userDTOs, $userDTO);
            }
        }
        return $userDTOs;
    }

    public function findUserById(int $userId): UserDTO
    {
        $userModel = $this->find($userId);
        return $this->convertModelToDTO($userModel);

    }

    public function findUsersByPositionId(int $positionId): array | null
    {
        $userModels = $this->findBy(array('position' => $positionId));

        if ($userModels){
            $userDTOs = array();
            foreach ($userModels as $userModel){
                if($userModel->getActive())
                array_push($userDTOs, $this->convertModelToDTO($userModel));
            }
            return $userDTOs;
        } else {
            return null;
        }
    }

    public function findPositionIdByUserId(int $userId)
    {
        return $this->createQueryBuilder('u')
            ->select('(u.position)')
            ->andWhere('u.id = :id')
            ->setParameter('id', $userId)
            ->getQuery()
            ->getSingleScalarResult();
    }

    private function convertModelToDTO(User $userModel) : UserDTO
    {
        $userDTO = new UserDTO();
        $userDTO->setId($userModel->getId());
        $userDTO->setName($userModel->getFirstName() . ' '. $userModel->getLastName());
        $userDTO->setEmail($userModel->getEmail());
        $userDTO->setPronouns($userModel->getPronoun()->getPronouns());
        $userDTO->setImage($userModel->getImage());
        $userDTO->setPosition($userModel->getPosition()->getName());
        $userDTO->setTimeAtKipsu($userModel->getStartDate());
        $userDTO->setSlackLink($userModel->getSlackMemberid());
        $userDTO->setIsLead($userModel->getPosition()->isIsLead());
        return $userDTO;
    }
}
