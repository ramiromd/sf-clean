<?php

namespace Ramiromd\Sfclean\Test\Unit\Shared\Value;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use Ramiromd\Sfclean\Shared\Exception\InvalidEntityId;
use Ramiromd\Sfclean\Shared\Value\EntityId;
use Ramsey\Uuid\Uuid;

class EntityIdTest extends TestCase
{
    #[Test]
    #[TestDox("It creates an entity ID with a valid UUID")]
    public function it_creates_an_entity_id_with_a_valid_uuid(): void
    {
        $uuid = Uuid::uuid4()->toString();
        $entityId = new EntityId($uuid);

        $this->assertEquals($uuid, $entityId->getValue());
    }

    #[Test]
    #[TestDox("It auto-generates a UUID when no value is provided")]
    public function it_auto_generates_a_uuid_when_no_value_is_provided(): void
    {
        $entityId = new EntityId(null);

        $this->assertTrue(Uuid::isValid($entityId->getValue()));
    }

    #[Test]
    #[TestDox("It generates different UUIDs for different instances")]
    public function it_generates_different_uuids_for_different_instances(): void
    {
        $entityId1 = new EntityId(null);
        $entityId2 = new EntityId(null);

        $this->assertNotEquals($entityId1->getValue(), $entityId2->getValue());
    }

    #[Test]
    #[TestDox("It accepts all valid UUID versions")]
    #[DataProvider("provideValidUuidVersions")]
    public function it_accepts_all_valid_uuid_versions(string $uuid): void
    {
        $entityId = new EntityId($uuid);
        $this->assertEquals($uuid, $entityId->getValue());
    }

    public static function provideValidUuidVersions(): array
    {
        return [
            "UUID v1" => [Uuid::uuid1()->toString()],
            "UUID v4" => [Uuid::uuid4()->toString()],
            "UUID v6" => [Uuid::uuid6()->toString()],
        ];
    }

    #[Test]
    #[TestDox("It throws InvalidEntityId exception with malformed UUID")]
    #[DataProvider("provideMalformedUuids")]
    public function it_throws_invalid_entity_id_exception_with_malformed_uuid(string $invalidUuid): void
    {
        $this->expectException(InvalidEntityId::class);
        new EntityId($invalidUuid);
    }

    public static function provideMalformedUuids(): array
    {
        return [
            "not a valid UUID" => ["not-a-valid-uuid"],
            "too short" => ["12345678-1234-1234-1234-12345678901"],
            "too long" => ["12345678-1234-1234-1234-1234567890123"],
            "invalid characters" => ["xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx"],
            "no hyphens" => ["12345678123412341234123456789012"],
        ];
    }

    #[Test]
    #[TestDox("It can be created with explicit UUID multiple times")]
    public function it_can_be_created_with_explicit_uuid_multiple_times(): void
    {
        $uuid = Uuid::uuid4()->toString();
        
        $entityId1 = new EntityId($uuid);
        $entityId2 = new EntityId($uuid);

        $this->assertEquals($entityId1->getValue(), $entityId2->getValue());
    }
}
