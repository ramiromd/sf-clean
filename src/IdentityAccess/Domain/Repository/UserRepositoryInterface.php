<?php

namespace Ramiromd\Sfclean\IdentityAccess\Domain\Repository;

use Ramiromd\Sfclean\IdentityAccess\Domain\Entity\User;

interface UserRepositoryInterface
{
    public function save(User $user): void;

}