<?php

namespace Ramiromd\Sfclean\Test\Unit\IdentityAccess\Value;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use Ramiromd\Sfclean\IdentityAccess\Domain\Exception\InvalidPasswordHash;
use Ramiromd\Sfclean\IdentityAccess\Domain\Value\PasswordHash;

class PasswordHashTest extends TestCase
{
    #[Test]
    #[TestDox("It creates a password hash with a hashed value")]
    public function it_creates_a_password_hash_with_a_hashed_value(): void
    {
        $hashedPassword = password_hash("mypassword", PASSWORD_BCRYPT);
        $passwordHash = new PasswordHash($hashedPassword);

        $this->assertEquals($hashedPassword, $passwordHash->getValue());
    }

    #[Test]
    #[TestDox("It stores the hash value exactly as provided")]
    public function it_stores_the_hash_value_exactly_as_provided(): void
    {
        $hashedPassword = '$2y$10$abcdefghijklmnopqrstuvwxyzabcdefghijklmnopqrstuvwxyz';
        $passwordHash = new PasswordHash($hashedPassword);

        $this->assertSame($hashedPassword, $passwordHash->getValue());
    }

    #[Test]
    #[TestDox("It works with different hash algorithms")]
    #[DataProvider("provideHashAlgorithms")]
    public function it_works_with_different_hash_algorithms(string $hash): void
    {
        $passwordHash = new PasswordHash($hash);
        $this->assertEquals($hash, $passwordHash->getValue());
    }

    public static function provideHashAlgorithms(): array
    {
        return [
            "BCRYPT" => [password_hash("password1", PASSWORD_BCRYPT)],
            "ARGON2I" => [password_hash("password2", PASSWORD_ARGON2I)],
            "ARGON2ID" => [password_hash("password3", PASSWORD_ARGON2ID)],
        ];
    }

    #[Test]
    #[TestDox("It preserves the full hash including algorithm and salt")]
    public function it_preserves_the_full_hash_including_algorithm_and_salt(): void
    {
        $originalPassword = "testpass123";
        $hashedPassword = password_hash($originalPassword, PASSWORD_BCRYPT);
        $passwordHash = new PasswordHash($hashedPassword);

        $retrievedHash = $passwordHash->getValue();
        $this->assertTrue(password_verify($originalPassword, $retrievedHash));
    }

    #[Test]
    #[TestDox("It throws InvalidPasswordHash exception when empty string is provided")]
    public function it_throws_invalid_password_hash_exception_when_empty_string_is_provided(): void
    {
        $this->expectException(InvalidPasswordHash::class);
        new PasswordHash("");
    }
}
