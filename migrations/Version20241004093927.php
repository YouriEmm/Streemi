<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;


final class Version20241004093927 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create initial db schema';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, label VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE comment (id INT AUTO_INCREMENT NOT NULL, contributor_id INT NOT NULL, media_id INT NOT NULL, parrent_comment_id INT DEFAULT NULL, content LONGTEXT NOT NULL, status VARCHAR(255) NOT NULL, INDEX IDX_9474526C7A19A357 (contributor_id), INDEX IDX_9474526CEA9FDD75 (media_id), INDEX IDX_9474526C87AE8BA9 (parrent_comment_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE episode (id INT AUTO_INCREMENT NOT NULL, season_id INT NOT NULL, title VARCHAR(255) NOT NULL, duration TIME NOT NULL COMMENT \'(DC2Type:time_immutable)\', release_date_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_DDAA1CDA4EC001D1 (season_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE language (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, code VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE media (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, short_description LONGTEXT NOT NULL, long_description LONGTEXT NOT NULL, realease_date_at DATETIME NOT NULL, cover_image VARCHAR(255) NOT NULL, staff JSON NOT NULL, casting JSON NOT NULL, media_type VARCHAR(255) NOT NULL, discr VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE movie (id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE playlist (id INT AUTO_INCREMENT NOT NULL, creator_id INT NOT NULL, name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL, INDEX IDX_D782112D61220EA6 (creator_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE playlist_media (id INT AUTO_INCREMENT NOT NULL, playlist_id INT NOT NULL, media_id INT NOT NULL, INDEX IDX_C930B84F6BBD148 (playlist_id), INDEX IDX_C930B84FEA9FDD75 (media_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE playlist_subscription (id INT AUTO_INCREMENT NOT NULL, creator_id INT NOT NULL, subscriber_id INT NOT NULL, playlist_id INT NOT NULL, subscribed_at DATETIME NOT NULL, INDEX IDX_832940C61220EA6 (creator_id), INDEX IDX_832940C7808B1AD (subscriber_id), INDEX IDX_832940C6BBD148 (playlist_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE season (id INT AUTO_INCREMENT NOT NULL, serie_id INT NOT NULL, season_number INT NOT NULL, INDEX IDX_F0E45BA9D94388BD (serie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE serie (id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE subscription (id INT AUTO_INCREMENT NOT NULL, subscriber_id INT DEFAULT NULL, name VARCHAR(100) NOT NULL, price INT NOT NULL, duration_in_months INT NOT NULL, INDEX IDX_A3C664D37808B1AD (subscriber_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE subscription_history (id INT AUTO_INCREMENT NOT NULL, subscriber_id INT NOT NULL, subscription_id INT NOT NULL, start_date_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', end_date_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_54AF90D07808B1AD (subscriber_id), INDEX IDX_54AF90D09A1887DC (subscription_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(100) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, account_status VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE watch_history (id INT AUTO_INCREMENT NOT NULL, media_id INT NOT NULL, watcher_id INT NOT NULL, last_watched_at DATETIME NOT NULL, number_of_views INT NOT NULL, INDEX IDX_DE44EFD8EA9FDD75 (media_id), INDEX IDX_DE44EFD8C300AB5D (watcher_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C7A19A357 FOREIGN KEY (contributor_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CEA9FDD75 FOREIGN KEY (media_id) REFERENCES media (id)');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C87AE8BA9 FOREIGN KEY (parrent_comment_id) REFERENCES comment (id)');
        $this->addSql('ALTER TABLE episode ADD CONSTRAINT FK_DDAA1CDA4EC001D1 FOREIGN KEY (season_id) REFERENCES season (id)');
        $this->addSql('ALTER TABLE movie ADD CONSTRAINT FK_1D5EF26FBF396750 FOREIGN KEY (id) REFERENCES media (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE playlist ADD CONSTRAINT FK_D782112D61220EA6 FOREIGN KEY (creator_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE playlist_media ADD CONSTRAINT FK_C930B84F6BBD148 FOREIGN KEY (playlist_id) REFERENCES playlist (id)');
        $this->addSql('ALTER TABLE playlist_media ADD CONSTRAINT FK_C930B84FEA9FDD75 FOREIGN KEY (media_id) REFERENCES media (id)');
        $this->addSql('ALTER TABLE playlist_subscription ADD CONSTRAINT FK_832940C61220EA6 FOREIGN KEY (creator_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE playlist_subscription ADD CONSTRAINT FK_832940C7808B1AD FOREIGN KEY (subscriber_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE playlist_subscription ADD CONSTRAINT FK_832940C6BBD148 FOREIGN KEY (playlist_id) REFERENCES playlist (id)');
        $this->addSql('ALTER TABLE season ADD CONSTRAINT FK_F0E45BA9D94388BD FOREIGN KEY (serie_id) REFERENCES serie (id)');
        $this->addSql('ALTER TABLE serie ADD CONSTRAINT FK_AA3A9334BF396750 FOREIGN KEY (id) REFERENCES media (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE subscription ADD CONSTRAINT FK_A3C664D37808B1AD FOREIGN KEY (subscriber_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE subscription_history ADD CONSTRAINT FK_54AF90D07808B1AD FOREIGN KEY (subscriber_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE subscription_history ADD CONSTRAINT FK_54AF90D09A1887DC FOREIGN KEY (subscription_id) REFERENCES subscription (id)');
        $this->addSql('ALTER TABLE watch_history ADD CONSTRAINT FK_DE44EFD8EA9FDD75 FOREIGN KEY (media_id) REFERENCES media (id)');
        $this->addSql('ALTER TABLE watch_history ADD CONSTRAINT FK_DE44EFD8C300AB5D FOREIGN KEY (watcher_id) REFERENCES `user` (id)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526C7A19A357');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526CEA9FDD75');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526C87AE8BA9');
        $this->addSql('ALTER TABLE episode DROP FOREIGN KEY FK_DDAA1CDA4EC001D1');
        $this->addSql('ALTER TABLE movie DROP FOREIGN KEY FK_1D5EF26FBF396750');
        $this->addSql('ALTER TABLE playlist DROP FOREIGN KEY FK_D782112D61220EA6');
        $this->addSql('ALTER TABLE playlist_media DROP FOREIGN KEY FK_C930B84F6BBD148');
        $this->addSql('ALTER TABLE playlist_media DROP FOREIGN KEY FK_C930B84FEA9FDD75');
        $this->addSql('ALTER TABLE playlist_subscription DROP FOREIGN KEY FK_832940C61220EA6');
        $this->addSql('ALTER TABLE playlist_subscription DROP FOREIGN KEY FK_832940C7808B1AD');
        $this->addSql('ALTER TABLE playlist_subscription DROP FOREIGN KEY FK_832940C6BBD148');
        $this->addSql('ALTER TABLE season DROP FOREIGN KEY FK_F0E45BA9D94388BD');
        $this->addSql('ALTER TABLE serie DROP FOREIGN KEY FK_AA3A9334BF396750');
        $this->addSql('ALTER TABLE subscription DROP FOREIGN KEY FK_A3C664D37808B1AD');
        $this->addSql('ALTER TABLE subscription_history DROP FOREIGN KEY FK_54AF90D07808B1AD');
        $this->addSql('ALTER TABLE subscription_history DROP FOREIGN KEY FK_54AF90D09A1887DC');
        $this->addSql('ALTER TABLE watch_history DROP FOREIGN KEY FK_DE44EFD8EA9FDD75');
        $this->addSql('ALTER TABLE watch_history DROP FOREIGN KEY FK_DE44EFD8C300AB5D');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE comment');
        $this->addSql('DROP TABLE episode');
        $this->addSql('DROP TABLE language');
        $this->addSql('DROP TABLE media');
        $this->addSql('DROP TABLE movie');
        $this->addSql('DROP TABLE playlist');
        $this->addSql('DROP TABLE playlist_media');
        $this->addSql('DROP TABLE playlist_subscription');
        $this->addSql('DROP TABLE season');
        $this->addSql('DROP TABLE serie');
        $this->addSql('DROP TABLE subscription');
        $this->addSql('DROP TABLE subscription_history');
        $this->addSql('DROP TABLE `user`');
        $this->addSql('DROP TABLE watch_history');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
