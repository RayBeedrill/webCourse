ALTER TABLE `bk_users` DROP FOREIGN KEY `bk_users_fk0`;

ALTER TABLE `bk_events` DROP FOREIGN KEY `bk_events_fk0`;

ALTER TABLE `bk_events` DROP FOREIGN KEY `bk_events_fk1`;

ALTER TABLE `bk_events` DROP FOREIGN KEY `bk_events_fk2`;

DROP TABLE IF EXISTS `bk_rooms`;

DROP TABLE IF EXISTS `bk_users`;

DROP TABLE IF EXISTS `bk_events`;

DROP TABLE IF EXISTS `bk_roles`;

