-- Apretaste 
-- SQL Deploy for Sandbox

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

DELIMITER $$
--
-- Functions
--
CREATE FUNCTION `levenshtein`(`s1` VARCHAR(255), `s2` VARCHAR(255)) RETURNS int(11)
    DETERMINISTIC
BEGIN
    DECLARE s1_len, s2_len, i, j, c, c_temp, cost INT;
    DECLARE s1_char CHAR;
    -- max strlen=255
    DECLARE cv0, cv1 VARBINARY(256);
    SET s1_len = CHAR_LENGTH(s1), s2_len = CHAR_LENGTH(s2), cv1 = 0x00, j = 1, i = 1, c = 0;
    IF s1 = s2 THEN
      RETURN 0;
    ELSEIF s1_len = 0 THEN
      RETURN s2_len;
    ELSEIF s2_len = 0 THEN
      RETURN s1_len;
    ELSE
      WHILE j <= s2_len DO
        SET cv1 = CONCAT(cv1, UNHEX(HEX(j))), j = j + 1;
      END WHILE;
      WHILE i <= s1_len DO
        SET s1_char = SUBSTRING(s1, i, 1), c = i, cv0 = UNHEX(HEX(i)), j = 1;
        WHILE j <= s2_len DO
          SET c = c + 1;
          IF s1_char = SUBSTRING(s2, j, 1) THEN 
            SET cost = 0; ELSE SET cost = 1;
          END IF;
          SET c_temp = CONV(HEX(SUBSTRING(cv1, j, 1)), 16, 10) + cost;
          IF c > c_temp THEN SET c = c_temp; END IF;
            SET c_temp = CONV(HEX(SUBSTRING(cv1, j+1, 1)), 16, 10) + 1;
            IF c > c_temp THEN 
              SET c = c_temp; 
            END IF;
            SET cv0 = CONCAT(cv0, UNHEX(HEX(c))), j = j + 1;
        END WHILE;
        SET cv1 = cv0, i = i + 1;
      END WHILE;
    END IF;
    RETURN c;
END$$

CREATE FUNCTION `SPLIT_STR`(
  x VARCHAR(255),
  delim VARCHAR(12),
  pos INT
) RETURNS varchar(255) CHARSET latin1
RETURN REPLACE(SUBSTRING(SUBSTRING_INDEX(x, delim, pos),
       LENGTH(SUBSTRING_INDEX(x, delim, pos -1)) + 1),
       delim, '')$$

DELIMITER ;

CREATE TABLE IF NOT EXISTS `ads` (
`id` int(11) NOT NULL,
  `time_inserted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `impresions` int(11) NOT NULL DEFAULT '0',
  `clicks` int(11) NOT NULL DEFAULT '0',
  `owner` char(100) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` varchar(5000) NOT NULL,
  `expiration_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `paid_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `coverage_area` enum('PINAR_DEL_RIO','LA_HABANA','ARTEMISA','MAYABEQUE','MATANZAS','VILLA_CLARA','CIENFUEGOS','SANTI_SPIRITUS','CIEGO_DE_AVILA','CAMAGUEY','LAS_TUNAS','HOLGUIN','GRANMA','SANTIAGO_DE_CUBA','GUANTANAMO','ISLA_DE_LA_JUVENTUD','CUBA','WEST','EAST','CENTER') DEFAULT 'CUBA'
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;


CREATE TABLE IF NOT EXISTS `delivery_checked` (
`id` int(11) NOT NULL,
  `email` char(100) NOT NULL,
  `status` int(3) NOT NULL COMMENT 'Status returned by the email validator',
  `inserted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=27339 DEFAULT CHARSET=latin1 COMMENT='To store all emails checked by the email validator service';


CREATE TABLE IF NOT EXISTS `delivery_dropped` (
`id` int(11) NOT NULL,
  `email` char(100) NOT NULL,
  `sender` varchar(50) NOT NULL,
  `reason` varchar(15) NOT NULL,
  `code` varchar(5) NOT NULL,
  `description` varchar(1000) DEFAULT NULL,
  `inserted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=10245 DEFAULT CHARSET=latin1 COMMENT='Save dropped emails in Mandrill';

CREATE TABLE IF NOT EXISTS `delivery_sent` (
`id` int(11) NOT NULL,
  `mailbox` char(100) NOT NULL,
  `user` char(100) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `images` tinyint(1) NOT NULL DEFAULT '0',
  `attachments` tinyint(1) NOT NULL DEFAULT '0',
  `inserted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `domain` varchar(30) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=193369 DEFAULT CHARSET=latin1 COMMENT='List of emails successfully sent';

CREATE TABLE IF NOT EXISTS `inventory` (
  `code` varchar(20) NOT NULL,
  `price` float NOT NULL,
  `name` varchar(250) NOT NULL,
  `seller` char(100) NOT NULL,
  `insertion_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `service` varchar(50) NOT NULL COMMENT 'Service wich payment function will be executed when the payment is finalized',
  `active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `invitations` (
`invitation_id` int(11) NOT NULL,
  `invitation_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `email_inviter` char(100) NOT NULL,
  `email_invited` char(100) NOT NULL,
  `used` tinyint(1) NOT NULL,
  `used_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=21143 DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `jumper` (
  `email` varchar(50) NOT NULL,
  `sent_count` int(11) NOT NULL DEFAULT '0',
  `received_count` int(11) NOT NULL DEFAULT '0',
  `blocked_domains` varchar(1000) NOT NULL COMMENT 'Comma separated list of the domains that are blocked for that email',
  `status` enum('Inactive','SendOnly','ReceiveOnly','SendReceive') NOT NULL DEFAULT 'Inactive',
  `last_usage` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `person` (
  `email` char(100) NOT NULL,
  `username` varchar(15) NOT NULL,
  `insertion_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `first_name` varchar(50) DEFAULT NULL,
  `middle_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `mother_name` varchar(50) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `gender` enum('M','F') DEFAULT NULL,
  `phone` varchar(10) DEFAULT NULL,
  `cellphone` varchar(10) DEFAULT NULL,
  `eyes` enum('NEGRO','CARMELITA','VERDE','AZUL','AVELLANA','OTRO') DEFAULT NULL,
  `skin` enum('NEGRO','BLANCO','MESTIZO','OTRO') DEFAULT NULL,
  `body_type` enum('DELGADO','MEDIO','EXTRA','ATLETICO') DEFAULT NULL,
  `hair` enum('TRIGUENO','CASTANO','RUBIO','NEGRO','ROJO','BLANCO','OTRO') DEFAULT NULL,
  `province` enum('PINAR_DEL_RIO','LA_HABANA','ARTEMISA','MAYABEQUE','MATANZAS','VILLA_CLARA','CIENFUEGOS','SANCTI_SPIRITUS','CIEGO_DE_AVILA','CAMAGUEY','LAS_TUNAS','HOLGUIN','GRANMA','SANTIAGO_DE_CUBA','GUANTANAMO','ISLA_DE_LA_JUVENTUD') DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `highest_school_level` enum('PRIMARIO','SECUNDARIO','TECNICO','UNIVERSITARIO','POSTGRADUADO','DOCTORADO','OTRO') DEFAULT NULL,
  `occupation` varchar(50) DEFAULT NULL,
  `marital_status` enum('SOLTERO','SALIENDO','COMPROMETIDO','CASADO') DEFAULT NULL,
  `interests` varchar(1000) NOT NULL COMMENT 'Comma separated list of interests',
  `about_me` varchar(1000) DEFAULT NULL,
  `credit` float NOT NULL DEFAULT '0',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `last_update_date` datetime DEFAULT NULL,
  `updated_by_user` tinyint(1) NOT NULL DEFAULT '0',
  `picture` tinyint(1) NOT NULL DEFAULT '0',
  `cupido` tinyint(1) NOT NULL DEFAULT '1',
  `sexual_orientation` enum('BI','HETERO','HOMO') NOT NULL DEFAULT 'HETERO',
  `religion` enum('ATEISMO','SECULARISMO','AGNOSTICISMO','ISLAM','JUDAISTA','ABAKUA','SANTERO','YORUBA','BUDISMO','CATOLICISMO','OTRA','CRISTIANISMO') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `raffle` (
`raffle_id` int(11) NOT NULL,
  `item_desc` varchar(1000) NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `winner_1` varchar(50) NOT NULL,
  `winner_2` varchar(50) NOT NULL,
  `winner_3` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `service` (
  `name` varchar(50) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `usage_text` text NOT NULL,
  `creator_email` char(100) NOT NULL,
  `insertion_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `category` enum('negocios','ocio','academico','social','comunicaciones','informativo','adulto','otros') NOT NULL,
  `listed` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 if the service will be listed on the list of services',
  `ads` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'service should show ads or not'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `ticket` (
`ticket_id` int(11) NOT NULL,
  `creation_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `raffle_id` int(11) DEFAULT NULL COMMENT 'NULL when the ticket belong to the current Raffle or ID of the Raffle where it was used',
  `email` char(100) NOT NULL,
  `paid` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6292 DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `transfer` (
`id` int(11) NOT NULL,
  `sender` char(100) NOT NULL,
  `receiver` char(100) NOT NULL,
  `amount` float NOT NULL,
  `transfer_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `confirmation_hash` varchar(32) NOT NULL,
  `transfered` tinyint(1) NOT NULL DEFAULT '0',
  `inventory_code` varchar(20) DEFAULT NULL COMMENT 'Code from the inventory table, if it was a purchase'
) ENGINE=InnoDB AUTO_INCREMENT=468 DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `utilization` (
`usage_id` int(11) NOT NULL,
  `service` varchar(50) NOT NULL,
  `subservice` varchar(50) DEFAULT NULL,
  `query` varchar(1000) DEFAULT NULL,
  `requestor` char(100) NOT NULL,
  `request_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `response_time` time NOT NULL DEFAULT '00:00:00',
  `domain` varchar(30) NOT NULL,
  `ad_top` int(11) DEFAULT NULL,
  `ad_botton` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=218574 DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `_bitcoin_accounts` (
  `email` char(100) NOT NULL,
  `private_key` varchar(50) DEFAULT NULL,
  `public_key` varchar(50) DEFAULT NULL,
  `active` bit(1) NOT NULL DEFAULT b'1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `_cupido_ignores` (
  `email1` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `email2` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `ignore_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `_cupido_likes` (
  `email1` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `email2` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `like_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `_note` (
`id` int(11) NOT NULL,
  `from_user` char(100) DEFAULT NULL,
  `to_user` char(100) DEFAULT NULL,
  `text` varchar(255) DEFAULT NULL,
  `send_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=4017 DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `_pizarra_notes` (
`id` int(11) NOT NULL,
  `email` char(100) NOT NULL,
  `text` varchar(140) NOT NULL,
  `likes` int(5) NOT NULL DEFAULT '0',
  `inserted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=6948 DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `_pizarra_users` (
  `email` varchar(50) NOT NULL,
  `reports` int(3) DEFAULT '0' COMMENT 'times the user had been reported',
  `penalized_until` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'If the user had been reported X times, will be penalized til this date'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE IF NOT EXISTS `_search_ignored_words` (
  `word` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `_search_variations` (
  `word` varchar(30) NOT NULL,
  `variation` varchar(30) NOT NULL,
  `variation_type` enum('SYNONYM','TYPO') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `_search_words` (
  `word` varchar(30) NOT NULL,
  `count` int(11) NOT NULL DEFAULT '0' COMMENT 'Number of times that word was used, or a typo of that word',
  `last_usage` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Useful to remove non-used words automatically'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `_tienda_categories` (
  `code` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `_tienda_post` (
`id` int(11) NOT NULL,
  `contact_name` varchar(50) NOT NULL,
  `contact_email_1` varchar(50) DEFAULT NULL,
  `contact_email_2` varchar(50) DEFAULT NULL,
  `contact_email_3` varchar(50) DEFAULT NULL,
  `contact_phone` varchar(20) DEFAULT NULL,
  `contact_cellphone` varchar(20) DEFAULT NULL,
  `location_city` varchar(50) DEFAULT NULL,
  `location_province` enum('pinar_del_rio','artemisa','la_habana','mayabeque','matanzas','cienfuegos','villa_clara','sancti_spiritus','ciego_de_avila','camaguey','las_tunas','granma','holguin','santiago_de_cuba','guantanamo','isla_de_la_juventud') DEFAULT NULL,
  `ad_title` varchar(250) NOT NULL,
  `ad_body` varchar(1000) NOT NULL,
  `category` varchar(20) NOT NULL,
  `taxonony_id` int(11) DEFAULT NULL,
  `number_of_pictures` int(2) DEFAULT NULL COMMENT '0 if there are no pictures for the post',
  `price` float NOT NULL,
  `currency` enum('CUC','CUP') NOT NULL,
  `date_time_posted` timestamp NULL DEFAULT NULL COMMENT 'Time the post was made on the source. Null if it is internal',
  `date_time_inserted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Time the post was inserted into this database',
  `featured` tinyint(1) NOT NULL DEFAULT '0',
  `source` varchar(20) NOT NULL,
  `source_url` varchar(250) DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=790333 DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `__sms_messages` (
  `id` varchar(255) DEFAULT NULL,
  `sent_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `email` char(100) DEFAULT NULL,
  `cellphone` varchar(255) DEFAULT NULL,
  `message` varchar(255) DEFAULT NULL,
  `discount` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `ads` ADD PRIMARY KEY (`id`);
ALTER TABLE `delivery_checked` ADD PRIMARY KEY (`id`);
ALTER TABLE `delivery_dropped` ADD PRIMARY KEY (`id`);
ALTER TABLE `delivery_sent` ADD PRIMARY KEY (`id`);
ALTER TABLE `inventory` ADD PRIMARY KEY (`code`), ADD UNIQUE KEY `code` (`code`), ADD KEY `code_2` (`code`);
ALTER TABLE `invitations` ADD PRIMARY KEY (`invitation_id`);
ALTER TABLE `jumper` ADD PRIMARY KEY (`email`), ADD UNIQUE KEY `email` (`email`);
ALTER TABLE `person` ADD PRIMARY KEY (`email`), ADD UNIQUE KEY `username` (`username`), ADD KEY `username_2` (`username`);
ALTER TABLE `raffle` ADD PRIMARY KEY (`raffle_id`);
ALTER TABLE `service` ADD PRIMARY KEY (`name`);
ALTER TABLE `ticket` ADD PRIMARY KEY (`ticket_id`);
ALTER TABLE `transfer` ADD PRIMARY KEY (`id`);
ALTER TABLE `utilization` ADD PRIMARY KEY (`usage_id`);
ALTER TABLE `_bitcoin_accounts` ADD UNIQUE KEY `email` (`email`);
ALTER TABLE `_cupido_ignores` ADD PRIMARY KEY (`email1`,`email2`);
ALTER TABLE `_cupido_likes` ADD PRIMARY KEY (`email1`,`email2`);
ALTER TABLE `_note` ADD PRIMARY KEY (`id`);
ALTER TABLE `_pizarra_notes` ADD PRIMARY KEY (`id`);
ALTER TABLE `_pizarra_users` ADD PRIMARY KEY (`email`), ADD UNIQUE KEY `email` (`email`);
ALTER TABLE `_search_ignored_words` ADD PRIMARY KEY (`word`);
ALTER TABLE `_search_variations` ADD PRIMARY KEY (`word`,`variation`);
ALTER TABLE `_search_words` ADD PRIMARY KEY (`word`);
ALTER TABLE `_tienda_categories` ADD PRIMARY KEY (`code`), ADD UNIQUE KEY `code` (`code`);
ALTER TABLE `_tienda_post` ADD PRIMARY KEY (`id`), ADD FULLTEXT KEY `ad_title` (`ad_title`,`ad_body`);
ALTER TABLE `ads` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1;
ALTER TABLE `delivery_checked`MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1;
ALTER TABLE `delivery_dropped` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1;
ALTER TABLE `delivery_sent` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1;
ALTER TABLE `invitations` MODIFY `invitation_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1;
ALTER TABLE `raffle` MODIFY `raffle_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1;
ALTER TABLE `ticket` MODIFY `ticket_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1;
ALTER TABLE `transfer` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1;
ALTER TABLE `utilization` MODIFY `usage_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1;
ALTER TABLE `_note` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1;
ALTER TABLE `_pizarra_notes` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1;
ALTER TABLE `_tienda_post` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1;

-- Sample data
INSERT INTO `person` (email, username, first_name, last_name) VALUES ('html@apretaste.com','html', 'Hyper','Text');
INSERT INTO jumper (email) VALUES ('apretaste@localhost.com');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
