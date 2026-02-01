<?php

namespace Ramiromd\Sfclean\Test\Unit\Shared\Value;

use DateTimeImmutable;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\TestCase;
use Ramiromd\Sfclean\Shared\Value\CreationDate;

class CreationDateTest extends TestCase
{
    #[Test]
    #[TestDox("It creates a creation date with a provided value")]
    public function it_creates_a_creation_date_with_a_provided_value(): void
    {
        $date = new DateTimeImmutable("2025-01-15 10:30:00");
        $creationDate = new CreationDate($date);

        $this->assertEquals($date, $creationDate->getValue());
    }

    #[Test]
    #[TestDox("It auto-generates current date when no value is provided")]
    public function it_auto_generates_current_date_when_no_value_is_provided(): void
    {
        $beforeCreation = new DateTimeImmutable();
        $creationDate = new CreationDate(null);
        $afterCreation = new DateTimeImmutable();

        $value = $creationDate->getValue();

        $this->assertGreaterThanOrEqual($beforeCreation, $value);
        $this->assertLessThanOrEqual($afterCreation, $value);
    }

    #[Test]
    #[TestDox("It generates a DateTimeImmutable instance")]
    public function it_generates_a_datetime_immutable_instance(): void
    {
        $creationDate = new CreationDate(null);
        $this->assertInstanceOf(DateTimeImmutable::class, $creationDate->getValue());
    }

    #[Test]
    #[TestDox("It preserves timezone information")]
    public function it_preserves_timezone_information(): void
    {
        $date = new DateTimeImmutable("2025-01-15 10:30:00", new \DateTimeZone("UTC"));
        $creationDate = new CreationDate($date);

        $this->assertEquals($date->getTimezone(), $creationDate->getValue()->getTimezone());
    }

    #[Test]
    #[TestDox("It maintains DateTimeImmutable immutability contract")]
    public function it_maintains_datetime_immutable_immutability_contract(): void
    {
        $originalDate = new DateTimeImmutable("2025-01-15 10:30:00");
        $creationDate = new CreationDate($originalDate);

        $modifiedDate = $creationDate->getValue()->modify("+1 day");

        // Original should not be affected
        $this->assertEquals($originalDate, $creationDate->getValue());
        $this->assertNotEquals($modifiedDate, $creationDate->getValue());
    }
}
