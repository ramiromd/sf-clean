<?php

namespace Ramiromd\Sfclean\Test\Unit\IdentityAccess\Value;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use Ramiromd\Sfclean\IdentityAccess\Domain\Exception\TooLargeNickname;
use Ramiromd\Sfclean\IdentityAccess\Domain\Exception\TooShortNickname;
use Ramiromd\Sfclean\IdentityAccess\Domain\Value\Nickname;

class NicknameTest extends TestCase
{
    #[Test]
    #[TestDox("It creates a nickname with valid length")]
    public function it_creates_a_nickname_with_valid_length(): void
    {
        $nicknameValue = "john";
        $nickname = new Nickname($nicknameValue);

        $this->assertEquals($nicknameValue, $nickname->getValue());
    }

    #[Test]
    #[TestDox("It creates multiple valid nicknames")]
    #[DataProvider("provideValidNicknames")]
    public function it_creates_multiple_valid_nicknames(string $nicknameValue): void
    {
        $nickname = new Nickname($nicknameValue);
        $this->assertEquals($nicknameValue, $nickname->getValue());
    }

    public static function provideValidNicknames(): array
    {
        return [
            "four characters" => ["john"],
            "mixed alphanumeric" => ["alice1234"],
            "five characters" => ["admin"],
            "max length" => ["testusername"],
            "four character variant" => ["user"],
            "mixed alphanumeric variant" => ["myaccount123"],
        ];
    }

    #[Test]
    #[TestDox("It throws TooShortNickname exception with short nicknames")]
    #[DataProvider("provideShortNicknames")]
    public function it_throws_too_short_nickname_exception_when_nickname_is_too_short(string $shortNickname): void
    {
        $this->expectException(TooShortNickname::class);
        new Nickname($shortNickname);
    }

    public static function provideShortNicknames(): array
    {
        return [
            "empty string" => [""],
            "single character" => ["a"],
            "two characters" => ["ab"],
            "three characters" => ["abc"],
        ];
    }

    #[Test]
    #[TestDox("It throws TooLargeNickname exception with long nicknames")]
    #[DataProvider("provideLargeNicknames")]
    public function it_throws_too_large_nickname_exception_when_nickname_is_too_long(string $largeNickname): void
    {
        $this->expectException(TooLargeNickname::class);
        new Nickname($largeNickname);
    }

    public static function provideLargeNicknames(): array
    {
        return [
            "thirteen characters" => ["abcdefghijklm"],
            "fourteen characters" => ["testusername1"],
            "very long string" => ["thisistoolongfornickname"],
        ];
    }
}
