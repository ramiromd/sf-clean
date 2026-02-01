<?php

namespace Ramiromd\Sfclean\IdentityAccess\Infrastructure;
use Ramiromd\Sfclean\IdentityAccess\Domain\Entity\User;
use Ramiromd\Sfclean\IdentityAccess\Domain\Repository\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    public function save(User $user): void
    {
        // Implementation to save the user entity to the database or any storage.
    }   
}