<?php

namespace Ramiromd\Sfclean\IdentityAccess\Application;

use DateTimeImmutable;
use Ramiromd\Sfclean\IdentityAccess\Domain\Entity\User;
use Ramiromd\Sfclean\IdentityAccess\Domain\Value\Nickname;
use Ramiromd\Sfclean\IdentityAccess\Domain\Value\Email;
use Ramiromd\Sfclean\IdentityAccess\Domain\Value\PasswordHash;
use Ramiromd\Sfclean\Shared\Value\EntityId;
use Ramiromd\Sfclean\Shared\Value\CreationDate;
use Ramiromd\Sfclean\IdentityAccess\Domain\Repository\UserRepositoryInterface;
use Ramiromd\Sfclean\IdentityAccess\Domain\Service\PasswordHasher;
class CreateUser {

    private UserRepositoryInterface $userRepository;
    private PasswordHasher $passwordHasher;

    public function __construct(UserRepositoryInterface $userRepository, PasswordHasher $passwordHasher)
    {
        $this->userRepository = $userRepository;
        $this->passwordHasher = $passwordHasher;
    }

    public function __invoke(CreateUserRequest $request)
    {
        $userEntity = new User(
            new EntityId($request->getEntityId()),
            new Nickname($request->getNickname()),
            new Email($request->getEmail()),
            new PasswordHash($request->getPassword()),
            new CreationDate(new DateTimeImmutable($request->getCreationDate()))
        );

        $passwordHash = $this->passwordHasher->hash($userEntity, $request->getPassword());
        echo "Password hash: " . $passwordHash . "\n";
        $userEntity->setPasswordHash(new PasswordHash($passwordHash));

        $this->userRepository->save($userEntity);
    }
}