<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220922122337 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C4B89032C FOREIGN KEY (post_id) REFERENCES posts (id)');
        $this->addSql('CREATE INDEX IDX_9474526C4B89032C ON comment (post_id)');
        $this->addSql('ALTER TABLE posts CHANGE id id VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE tag ADD topic VARCHAR(30) NOT NULL, DROP catégories, CHANGE id id VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE tag_posts CHANGE tag_id tag_id VARCHAR(255) NOT NULL, CHANGE posts_id posts_id VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526C4B89032C');
        $this->addSql('DROP INDEX IDX_9474526C4B89032C ON comment');
        $this->addSql('ALTER TABLE posts CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE tag ADD catégories VARCHAR(30) DEFAULT NULL, DROP topic, CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE tag_posts CHANGE tag_id tag_id INT NOT NULL, CHANGE posts_id posts_id INT NOT NULL');
    }
}
