<?php

namespace Ramiromd\Sfclean\IdentityAccess\Infrastructure;

use Ramiromd\Sfclean\IdentityAccess\Domain\Entity\User;
use Ramiromd\Sfclean\IdentityAccess\Domain\Service\PasswordHasher;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class SymfonyPasswordHasher implements PasswordHasher
{

    private UserPasswordHasherInterface $passwordHasher;
    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function hash(User $user, string $plainPassword): string
    {
        return $this->passwordHasher->hashPassword(
            new SecurityUserAdapter($user), 
            $plainPassword
        );
    }
}