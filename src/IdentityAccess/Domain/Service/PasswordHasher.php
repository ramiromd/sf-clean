<?php

namespace Ramiromd\Sfclean\IdentityAccess\Domain\Service;
use Ramiromd\Sfclean\IdentityAccess\Domain\Entity\User;
interface PasswordHasher {
    public function hash(User $user, string $plainPassword): string;
}