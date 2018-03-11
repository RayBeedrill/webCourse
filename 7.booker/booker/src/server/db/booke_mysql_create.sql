CREATE TABLE `bk_rooms` (
	`id_room` INT NOT NULL AUTO_INCREMENT,
	`name` varchar(50), 
	PRIMARY KEY (`id_room`)
);

CREATE TABLE `bk_users` (
	`id_user` INT NOT NULL AUTO_INCREMENT,
	`name` varchar(50),
	`email` varchar(50),
	`id_role` INT NOT NULL,
	`login` varchar(50),
	`pass` varchar(50),
	PRIMARY KEY (`id_user`)
);

CREATE TABLE `bk_events` (
	`id_event` INT NOT NULL AUTO_INCREMENT,
	`id_user` INT NOT NULL,
	`id_room` INT NOT NULL,
	`desc` varchar(300),
	`dateTime_start` TIMESTAMP,
	`dateTime_end` TIMESTAMP,
	`repeat_flag` BOOLEAN,
	`id_parent` INT,
	`dateTime_created` TIMESTAMP,
	PRIMARY KEY (`id_event`)
);

CREATE TABLE `bk_roles` (
	`id_role` INT NOT NULL AUTO_INCREMENT,
	`name` varchar(50) NOT NULL,
	PRIMARY KEY (`id_role`)
);

ALTER TABLE `bk_users` ADD CONSTRAINT `bk_users_fk0` FOREIGN KEY (`id_role`) REFERENCES `bk_roles`(`id_role`);

ALTER TABLE `bk_events` ADD CONSTRAINT `bk_events_fk0` FOREIGN KEY (`id_user`) REFERENCES `bk_users`(`id_user`);

ALTER TABLE `bk_events` ADD CONSTRAINT `bk_events_fk1` FOREIGN KEY (`id_room`) REFERENCES `bk_rooms`(`id_room`);


