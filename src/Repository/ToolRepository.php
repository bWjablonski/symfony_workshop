<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Tool;
use App\Infrastructure\ToolRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;

use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Tool|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tool|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tool[]    findAll()
 * @method Tool[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ToolRepository extends ServiceEntityRepository implements ToolRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tool::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Tool $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(Tool $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    public function find($id, $lockMode = null, $lockVersion = null): ?Tool
    {
        return $this->_em->find($this->_entityName, $id, $lockMode, $lockVersion);
    }
}
