<?php

namespace Ramiromd\Sfclean\IdentityAccess\Infrastructure\Repository;
use Ramiromd\Sfclean\IdentityAccess\Domain\Entity\User;
use Ramiromd\Sfclean\IdentityAccess\Domain\Repository\UserRepositoryInterface;

class UserRepository extends DoctrineRepository implements UserRepositoryInterface
{
    public function save(object $entity): void
    {
        echo "Saving object ...\n";
    }
}