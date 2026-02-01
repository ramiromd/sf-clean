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

class CreateUser {

    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function __invoke(CreateUserRequest $request)
    {
        
        var_dump($this->userRepository);
        $userEntity = new User(
            new EntityId($request->getEntityId()),
            new Nickname($request->getNickname()),
            new Email($request->getEmail()),
            new PasswordHash($request->getPassword()), // todo: hash password
            new CreationDate(new DateTimeImmutable($request->getCreationDate()))
        );

        var_dump($userEntity);


        throw new \Exception('Not implemented');
    }
}