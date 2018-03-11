CREATE TABLE `books` (
	`id_book` int NOT NULL AUTO_INCREMENT,
	`title` varchar(100) NOT NULL,
	`price` FLOAT NOT NULL,
	`shortDesc` TEXT NOT NULL,
	`description` TEXT NOT NULL,
	`id_discount` int NOT NULL,
	PRIMARY KEY (`id_book`)
);

CREATE TABLE `discount` (
	`id_discount` int NOT NULL AUTO_INCREMENT,
	`amount` int NOT NULL,
	PRIMARY KEY (`id_discount`)
);

CREATE TABLE `authors` (
	`id_author` int NOT NULL AUTO_INCREMENT,
	`name` varchar(100) NOT NULL,
	PRIMARY KEY (`id_author`)
);

CREATE TABLE `genres` (
	`id_genre` int NOT NULL AUTO_INCREMENT,
	`name` varchar(100) NOT NULL,
	PRIMARY KEY (`id_genre`)
);

CREATE TABLE `booksAuthor` (
	`id` int NOT NULL AUTO_INCREMENT,
	`id_book` int NOT NULL,
	`id_author` int NOT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE `booksGenre` (
	`id` int NOT NULL AUTO_INCREMENT,
	`id_book` int NOT NULL,
	`id_genre` int NOT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE `customers` (
	`id_user` int NOT NULL,
	`name` varchar(100) NOT NULL,
	`secondName` varchar(100) NOT NULL,
	`phone` varchar(100) NOT NULL,
	`email` varchar(100) NOT NULL,
	`id_discount` int NOT NULL,
	PRIMARY KEY (`id_user`)
);

CREATE TABLE `cart` (
	`id_cart` int NOT NULL AUTO_INCREMENT,
	`id_user` int NOT NULL,
	`id_book` int NOT NULL,
	`count` int NOT NULL,
	PRIMARY KEY (`id_cart`)
);

CREATE TABLE `status` (
	`id_status` int NOT NULL AUTO_INCREMENT,
	`name` varchar(100) NOT NULL,
	PRIMARY KEY (`id_status`)
);

CREATE TABLE `users` (
	`id_user` int NOT NULL AUTO_INCREMENT,
	`id_role` int NOT NULL,
	`login` varchar(30) NOT NULL,
	`password` varchar(32) NOT NULL,
	`userHash` varchar(32) NOT NULL,
	`status` int NOT NULL,
	PRIMARY KEY (`id_user`)
);

CREATE TABLE `orders` (
	`id_order` int NOT NULL AUTO_INCREMENT,
	`id_user` int NOT NULL,
	`id_status` int NOT NULL,
	`id_payment` int NOT NULL,
	`data` DATETIME NOT NULL,
	PRIMARY KEY (`id_order`)
);

CREATE TABLE `payment` (
	`id_payment` int NOT NULL AUTO_INCREMENT,
	`name` varchar(100) NOT NULL,
	PRIMARY KEY (`id_payment`)
);

CREATE TABLE `order_full_info` (
	`id_order` int NOT NULL,
	`id_book` int NOT NULL,
	`quantity` int NOT NULL,
	`discount` int NOT NULL,
	PRIMARY KEY (`id_order`)
);

CREATE TABLE `roles` (
	`id_role` int NOT NULL AUTO_INCREMENT,
	`name` varchar(100) NOT NULL,
	PRIMARY KEY (`id_role`)
);

ALTER TABLE `books` ADD CONSTRAINT `books_fk0` FOREIGN KEY (`id_discount`) REFERENCES `discount`(`id_discount`);

ALTER TABLE `booksAuthor` ADD CONSTRAINT `booksAuthor_fk0` FOREIGN KEY (`id_book`) REFERENCES `books`(`id_book`);

ALTER TABLE `booksAuthor` ADD CONSTRAINT `booksAuthor_fk1` FOREIGN KEY (`id_author`) REFERENCES `authors`(`id_author`);

ALTER TABLE `booksGenre` ADD CONSTRAINT `booksGenre_fk0` FOREIGN KEY (`id_book`) REFERENCES `books`(`id_book`);

ALTER TABLE `booksGenre` ADD CONSTRAINT `booksGenre_fk1` FOREIGN KEY (`id_genre`) REFERENCES `genres`(`id_genre`);

ALTER TABLE `customers` ADD CONSTRAINT `customers_fk0` FOREIGN KEY (`id_user`) REFERENCES `users`(`id_user`);

ALTER TABLE `customers` ADD CONSTRAINT `customers_fk1` FOREIGN KEY (`id_discount`) REFERENCES `discount`(`id_discount`);

ALTER TABLE `cart` ADD CONSTRAINT `cart_fk0` FOREIGN KEY (`id_user`) REFERENCES `customers`(`id_user`);

ALTER TABLE `cart` ADD CONSTRAINT `cart_fk1` FOREIGN KEY (`id_book`) REFERENCES `books`(`id_book`);

ALTER TABLE `users` ADD CONSTRAINT `users_fk0` FOREIGN KEY (`id_role`) REFERENCES `roles`(`id_role`);

ALTER TABLE `orders` ADD CONSTRAINT `orders_fk0` FOREIGN KEY (`id_user`) REFERENCES `customers`(`id_user`);

ALTER TABLE `orders` ADD CONSTRAINT `orders_fk1` FOREIGN KEY (`id_status`) REFERENCES `status`(`id_status`);

ALTER TABLE `orders` ADD CONSTRAINT `orders_fk2` FOREIGN KEY (`id_payment`) REFERENCES `payment`(`id_payment`);

ALTER TABLE `order_full_info` ADD CONSTRAINT `order_full_info_fk0` FOREIGN KEY (`id_order`) REFERENCES `orders`(`id_order`);

ALTER TABLE `order_full_info` ADD CONSTRAINT `order_full_info_fk1` FOREIGN KEY (`id_book`) REFERENCES `books`(`id_book`);
