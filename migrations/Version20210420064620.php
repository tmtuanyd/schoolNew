<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210420064620 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE "group_grp_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE "user_use_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE "group" (grp_id INT NOT NULL, app_created_by_id INT DEFAULT NULL, app_updated_by_id INT DEFAULT NULL, grp_roles TEXT DEFAULT NULL, grp_name VARCHAR(255) DEFAULT NULL, grp_code VARCHAR(255) DEFAULT NULL, app_created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, app_updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(grp_id))');
        $this->addSql('CREATE INDEX IDX_6DC044C52A47BE2A ON "group" (app_created_by_id)');
        $this->addSql('CREATE INDEX IDX_6DC044C513108672 ON "group" (app_updated_by_id)');
        $this->addSql('COMMENT ON COLUMN "group".grp_roles IS \'(DC2Type:array)\'');
        $this->addSql('CREATE TABLE user_group (grp_id INT NOT NULL, use_id INT NOT NULL, PRIMARY KEY(grp_id, use_id))');
        $this->addSql('CREATE INDEX IDX_8F02BF9DD51E9150 ON user_group (grp_id)');
        $this->addSql('CREATE INDEX IDX_8F02BF9DC1A7BCDD ON user_group (use_id)');
        $this->addSql('CREATE TABLE "user" (use_id INT NOT NULL, app_created_by_id INT DEFAULT NULL, app_updated_by_id INT DEFAULT NULL, use_email VARCHAR(180) NOT NULL, use_role JSON NOT NULL, use_password VARCHAR(255) NOT NULL, app_created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, app_updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, app_deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(use_id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D6497B04564E ON "user" (use_email)');
        $this->addSql('CREATE INDEX IDX_8D93D6492A47BE2A ON "user" (app_created_by_id)');
        $this->addSql('CREATE INDEX IDX_8D93D64913108672 ON "user" (app_updated_by_id)');
        $this->addSql('ALTER TABLE "group" ADD CONSTRAINT FK_6DC044C52A47BE2A FOREIGN KEY (app_created_by_id) REFERENCES "user" (use_id) ON DELETE SET NULL NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "group" ADD CONSTRAINT FK_6DC044C513108672 FOREIGN KEY (app_updated_by_id) REFERENCES "user" (use_id) ON DELETE SET NULL NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_group ADD CONSTRAINT FK_8F02BF9DD51E9150 FOREIGN KEY (grp_id) REFERENCES "group" (grp_id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_group ADD CONSTRAINT FK_8F02BF9DC1A7BCDD FOREIGN KEY (use_id) REFERENCES "user" (use_id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "user" ADD CONSTRAINT FK_8D93D6492A47BE2A FOREIGN KEY (app_created_by_id) REFERENCES "user" (use_id) ON DELETE SET NULL NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "user" ADD CONSTRAINT FK_8D93D64913108672 FOREIGN KEY (app_updated_by_id) REFERENCES "user" (use_id) ON DELETE SET NULL NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE user_group DROP CONSTRAINT FK_8F02BF9DD51E9150');
        $this->addSql('ALTER TABLE "group" DROP CONSTRAINT FK_6DC044C52A47BE2A');
        $this->addSql('ALTER TABLE "group" DROP CONSTRAINT FK_6DC044C513108672');
        $this->addSql('ALTER TABLE user_group DROP CONSTRAINT FK_8F02BF9DC1A7BCDD');
        $this->addSql('ALTER TABLE "user" DROP CONSTRAINT FK_8D93D6492A47BE2A');
        $this->addSql('ALTER TABLE "user" DROP CONSTRAINT FK_8D93D64913108672');
        $this->addSql('DROP SEQUENCE "group_grp_id_seq" CASCADE');
        $this->addSql('DROP SEQUENCE "user_use_id_seq" CASCADE');
        $this->addSql('DROP TABLE "group"');
        $this->addSql('DROP TABLE user_group');
        $this->addSql('DROP TABLE "user"');
    }
}
