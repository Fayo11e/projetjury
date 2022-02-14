<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220202090352 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE user');
        $this->addSql('ALTER TABLE article DROP article');
        $this->addSql('ALTER TABLE category DROP FOREIGN KEY FK_64C19C1EAB5DEB');
        $this->addSql('DROP INDEX IDX_64C19C1EAB5DEB ON category');
        $this->addSql('ALTER TABLE category DROP many_to_one_id, DROP article_path');
        $this->addSql('ALTER TABLE commentary DROP FOREIGN KEY FK_1CAC12CA3256915B');
        $this->addSql('DROP INDEX UNIQ_1CAC12CA3256915B ON commentary');
        $this->addSql('ALTER TABLE commentary DROP relation_id, DROP field');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, firstname VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', email VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, password VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, nickname VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE article ADD article LONGTEXT NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE category ADD many_to_one_id INT DEFAULT NULL, ADD article_path VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE name name VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE category ADD CONSTRAINT FK_64C19C1EAB5DEB FOREIGN KEY (many_to_one_id) REFERENCES article (id)');
        $this->addSql('CREATE INDEX IDX_64C19C1EAB5DEB ON category (many_to_one_id)');
        $this->addSql('ALTER TABLE commentary ADD relation_id INT NOT NULL, ADD field VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE commentary ADD CONSTRAINT FK_1CAC12CA3256915B FOREIGN KEY (relation_id) REFERENCES article (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1CAC12CA3256915B ON commentary (relation_id)');
    }
}
