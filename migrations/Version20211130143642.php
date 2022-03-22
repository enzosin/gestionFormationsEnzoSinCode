<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211130143642 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE inscription ADD employe_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE inscription ADD CONSTRAINT FK_5E90F6D61B65292 FOREIGN KEY (employe_id) REFERENCES employe (id)');
        $this->addSql('CREATE INDEX IDX_5E90F6D61B65292 ON inscription (employe_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE inscription DROP FOREIGN KEY FK_5E90F6D61B65292');
        $this->addSql('DROP INDEX IDX_5E90F6D61B65292 ON inscription');
        $this->addSql('ALTER TABLE inscription DROP employe_id');
    }
}
