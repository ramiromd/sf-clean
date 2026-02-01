<?php

declare(strict_types=1);

namespace Ramiromd\Crowfunding\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20260201000000 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create idp_users table for IdentityAccess module';
    }

    public function up(Schema $schema): void
    {
        $table = $schema->createTable('idp_users');

        // Primary key
        $table->addColumn('id', 'bigint', [
            'autoincrement' => true,
            'notnull' => true,
        ]);
        $table->setPrimaryKey(['id']);

        // Entity ID (UUID)
        $table->addColumn('entity_id', 'string', [
            'length' => 36,
            'notnull' => true,
        ]);
        $table->addUniqueIndex(['entity_id'], 'UNIQ_IDP_USERS_ENTITY_ID');

        // Nickname
        $table->addColumn('nickname', 'string', [
            'length' => 20,
            'notnull' => true,
        ]);

        // Email
        $table->addColumn('email', 'string', [
            'length' => 64,
            'notnull' => true,
        ]);
        $table->addUniqueIndex(['email'], 'UNIQ_IDP_USERS_EMAIL');

        // Password Hash
        $table->addColumn('password_hash', 'string', [
            'length' => 255,
            'notnull' => true,
        ]);

        // Creation Date
        $table->addColumn('creation_date', 'datetime', [
            'notnull' => true,
        ]);
    }

    public function down(Schema $schema): void
    {
        $schema->dropTable('idp_users');
    }
}
