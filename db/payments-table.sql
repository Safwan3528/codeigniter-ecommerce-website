CREATE TABLE `payments` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`payment_gateway` VARCHAR(20) NULL DEFAULT NULL,
	`data` TEXT NULL,
	`order_no` VARCHAR(10) NULL DEFAULT NULL,
	`status` ENUM('pending','failed','success','expired') NULL DEFAULT NULL,
	`created_at` DATETIME NULL DEFAULT NULL,
	`deleted_at` DATETIME NULL DEFAULT NULL,
	`updated_at` DATETIME NULL DEFAULT NULL,
	PRIMARY KEY (`id`),
	INDEX `order_no` (`order_no`)
);
