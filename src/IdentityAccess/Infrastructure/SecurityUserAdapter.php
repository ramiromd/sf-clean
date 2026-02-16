<?php

namespace Ramiromd\Sfclean\IdentityAccess\Infrastructure;

use Ramiromd\Sfclean\IdentityAccess\Domain\Entity\User;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

class SecurityUserAdapter implements PasswordAuthenticatedUserInterface
{
    private User $user;
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function getPassword(): string
    {
        return $this->user->getPasswordHash()->getValue();
    }

}