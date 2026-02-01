<?php

namespace Ramiromd\Sfclean\IdentityAccess\Domain\Entity;

use Ramiromd\Sfclean\IdentityAccess\Domain\Value\Email;
use Ramiromd\Sfclean\IdentityAccess\Domain\Value\Nickname;
use Ramiromd\Sfclean\IdentityAccess\Domain\Value\PasswordHash;
use Ramiromd\Sfclean\Shared\Value\CreationDate;
use Ramiromd\Sfclean\Shared\Value\EntityId;

class User
{
    private EntityId $id;

    private Nickname $nickname;

    private Email $email;

    private PasswordHash $passwordHash;

    private CreationDate $creationDate;

    function __construct(EntityId $id, Nickname $nickname, Email $email, PasswordHash $passwordHash, CreationDate $creationDate)
    {
        $this->id = $id;
        $this->nickname = $nickname;
        $this->email = $email;
        $this->passwordHash = $passwordHash;
        $this->creationDate = $creationDate;
    }

    public function getId(): EntityId
    {
        return $this->id;
    }

    public function getNickname(): Nickname
    {
        return $this->nickname;
    }

    public function getEmail(): Email
    {
        return $this->email;
    }

    public function getPasswordHash(): PasswordHash
    {
        return $this->passwordHash;
    }

    public function getCreationDate(): CreationDate
    {
        return $this->creationDate;
    }
}