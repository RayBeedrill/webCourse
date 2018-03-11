ALTER TABLE `books` DROP FOREIGN KEY `books_fk0`;

ALTER TABLE `booksAuthor` DROP FOREIGN KEY `booksAuthor_fk0`;

ALTER TABLE `booksAuthor` DROP FOREIGN KEY `booksAuthor_fk1`;

ALTER TABLE `booksGenre` DROP FOREIGN KEY `booksGenre_fk0`;

ALTER TABLE `booksGenre` DROP FOREIGN KEY `booksGenre_fk1`;

ALTER TABLE `customers` DROP FOREIGN KEY `customers_fk0`;

ALTER TABLE `customers` DROP FOREIGN KEY `customers_fk1`;

ALTER TABLE `cart` DROP FOREIGN KEY `cart_fk0`;

ALTER TABLE `cart` DROP FOREIGN KEY `cart_fk1`;

ALTER TABLE `users` DROP FOREIGN KEY `users_fk0`;

ALTER TABLE `orders` DROP FOREIGN KEY `orders_fk0`;

ALTER TABLE `orders` DROP FOREIGN KEY `orders_fk1`;

ALTER TABLE `orders` DROP FOREIGN KEY `orders_fk2`;

ALTER TABLE `order_full_info` DROP FOREIGN KEY `order_full_info_fk0`;

ALTER TABLE `order_full_info` DROP FOREIGN KEY `order_full_info_fk1`;

DROP TABLE IF EXISTS `books`;

DROP TABLE IF EXISTS `discount`;

DROP TABLE IF EXISTS `authors`;

DROP TABLE IF EXISTS `genres`;

DROP TABLE IF EXISTS `booksAuthor`;

DROP TABLE IF EXISTS `booksGenre`;

DROP TABLE IF EXISTS `customers`;

DROP TABLE IF EXISTS `cart`;

DROP TABLE IF EXISTS `status`;

DROP TABLE IF EXISTS `users`;

DROP TABLE IF EXISTS `orders`;

DROP TABLE IF EXISTS `payment`;

DROP TABLE IF EXISTS `order_full_info`;

DROP TABLE IF EXISTS `roles`;

