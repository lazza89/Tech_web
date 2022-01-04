CREATE TABLE `user`(
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `email` VARCHAR(255) NOT NULL,
    `username` VARCHAR(255) NOT NULL,
    `password` VARCHAR(255) NOT NULL,
    `name` VARCHAR(255) NULL,
    `surname` VARCHAR(255) NULL,
    `city` VARCHAR(255) NULL,
    `isAdmin` TINYINT UNSIGNED NOT NULL,

    PRIMARY KEY (`id`),
    UNIQUE KEY (`username`)
);

CREATE TABLE `comment`(
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `userId` INT UNSIGNED NOT NULL,
    `username` VARCHAR(255) NOT NULL,
    `comment` VARCHAR(400) NOT NULL,
    `stars` TINYINT UNSIGNED NOT NULL,
    `date` DATETIME NOT NULL,

    PRIMARY KEY (`id`)
);
ALTER TABLE
    `comment` ADD CONSTRAINT `comment_userid_foreign` FOREIGN KEY(`userId`) REFERENCES `user`(`id`);





