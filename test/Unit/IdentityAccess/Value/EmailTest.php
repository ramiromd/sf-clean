<?php

namespace Ramiromd\Sfclean\Test\Unit\IdentityAccess\Value;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use Ramiromd\Sfclean\IdentityAccess\Domain\Exception\InvalidEmail;
use Ramiromd\Sfclean\IdentityAccess\Domain\Value\Email;

class EmailTest extends TestCase
{
    #[Test]
    #[TestDox("It creates an email with a valid email address")]
    public function it_creates_an_email_with_a_valid_email_address(): void
    {
        $emailAddress = "user@example.com";
        $email = new Email($emailAddress);

        $this->assertEquals($emailAddress, $email->getValue());
    }

    #[Test]
    #[TestDox("It creates an email with different valid formats")]
    #[DataProvider("provideValidEmails")]
    public function it_creates_an_email_with_different_valid_formats(string $emailAddress): void
    {
        $email = new Email($emailAddress);
        $this->assertEquals($emailAddress, $email->getValue());
    }

    public static function provideValidEmails(): array
    {
        return [
            "simple format" => ["test@test.com"],
            "dot in local part" => ["user.name@example.co.uk"],
            "plus sign" => ["info+tag@domain.org"],
            "localhost domain" => ["simple@localhost.localdomain"],
        ];
    }

    #[Test]
    #[TestDox("It throws InvalidEmail exception when email is empty")]
    public function it_throws_invalid_email_exception_when_email_is_empty(): void
    {
        $this->expectException(InvalidEmail::class);
        new Email("");
    }

    #[Test]
    #[TestDox("It throws InvalidEmail exception when email has no @ symbol")]
    public function it_throws_invalid_email_exception_when_email_has_no_at_symbol(): void
    {
        $this->expectException(InvalidEmail::class);
        new Email("invalidemail.com");
    }

    #[Test]
    #[TestDox("It throws InvalidEmail exception when email format is malformed")]
    #[DataProvider("provideMalformedEmails")]
    public function it_throws_invalid_email_exception_when_email_format_is_malformed(string $invalidEmail): void
    {
        $this->expectException(InvalidEmail::class);
        new Email($invalidEmail);
    }

    public static function provideMalformedEmails(): array
    {
        return [
            "no domain" => ["user@"],
            "no local part" => ["@example.com"],
            "space in local part" => ["user name@example.com"],
            "dot before domain" => ["user@.com"],
            "double at symbol" => ["user@@example.com"],
            "dot at end of domain" => ["user@example."],
        ];
    }
}
