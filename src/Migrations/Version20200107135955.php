<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200107135955 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE contient (id INT AUTO_INCREMENT NOT NULL, id_article INT DEFAULT NULL, id_commande INT DEFAULT NULL, nombre_article INT NOT NULL, prix_article NUMERIC(23, 4) NOT NULL, prix_article_tva NUMERIC(23, 4) NOT NULL, INDEX IDX_DC302E56DCA7A716 (id_article), INDEX IDX_DC302E563E314AE8 (id_commande), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE contient ADD CONSTRAINT FK_DC302E56DCA7A716 FOREIGN KEY (id_article) REFERENCES article (id_article)');
        $this->addSql('ALTER TABLE contient ADD CONSTRAINT FK_DC302E563E314AE8 FOREIGN KEY (id_commande) REFERENCES commande (id_commande)');
        $this->addSql('ALTER TABLE user RENAME INDEX id_client TO IDX_8D93D649E173B1B8');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE contient');
        $this->addSql('ALTER TABLE user RENAME INDEX idx_8d93d649e173b1b8 TO id_client');
    }
}
