<?php

namespace Ramiromd\Sfclean\IdentityAccess\Infrastructure\Repository;
use Doctrine\ORM\EntityManagerInterface;


abstract class DoctrineRepository
{
    protected EntityManagerInterface $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function save(Object $entity): void
    {
        $this->entityManager->persist($entity);
        $this->entityManager->flush();
    }
}