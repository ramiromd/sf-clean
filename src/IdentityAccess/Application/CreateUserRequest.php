<?php

namespace Ramiromd\Sfclean\IdentityAccess\Application;

class CreateUserRequest {

    private string $entityId;
    private string $email;
    private string $nickname;

    private string $password;

    private string $creationDate;

    public function __construct(string $entityId, string $nickname, string $email, string $password, string $creationDate)
    {
        $this->entityId = $entityId;
        $this->email = $email;
        $this->nickname = $nickname;
        $this->password = $password;
        $this->creationDate = $creationDate;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getNickname(): string
    {
        return $this->nickname;
    }

    public function setNickname(string $nickname): void
    {
        $this->nickname = $nickname;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function getCreationDate(): string
    {
        return $this->creationDate;
    }

    public function setCreationDate(string $creationDate): void
    {
        $this->creationDate = $creationDate;
    }

    public function getEntityId(): string
    {
        return $this->entityId;
    }

    public function setEntityId(string $entityId): void
    {
        $this->entityId = $entityId;
    }
}