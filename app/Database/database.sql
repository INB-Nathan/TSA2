CREATE TABLE `TSA2`.`User` (
        `id` INT NOT NULL AUTO_INCREMENT,
        `first_name` VARCHAR(255) NOT NULL,
        `last_name` VARCHAR(255) NOT NULL,
        `email` VARCHAR(255) NOT NULL,
        `password_hash` VARCHAR(255) NOT NULL,
        PRIMARY KEY (`id`)
    )