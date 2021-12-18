CREATE TABLE `user`(
    `email` VARCHAR(255) NOT NULL,
    `username` VARCHAR(255) NOT NULL,
    `password` VARCHAR(255) NOT NULL,
    `name` VARCHAR(255) NULL,
    `surname` VARCHAR(255) NULL,
    `city` VARCHAR(255) NULL,
    `isAdmin` TINYINT(1) NOT NULL
);
ALTER TABLE
    `user` ADD PRIMARY KEY `user_email_primary`(`email`);
ALTER TABLE
    `user` ADD UNIQUE `user_username_unique`(`username`);

CREATE TABLE `comment`(
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `username` VARCHAR(255) NOT NULL,
    `comment` VARCHAR(255) NOT NULL,
    `stars` TINYINT UNSIGNED NOT NULL,
    `date` DATETIME NOT NULL,
    `isBanned` VARCHAR(255) NULL
);
ALTER TABLE
    `comment` ADD PRIMARY KEY `comment_id_primary`(`id`);
ALTER TABLE 
    `user` ADD FOREIGN KEY (`username`) REFERENCES `comment` (`username`);
ALTER TABLE 
    `comment` ADD FOREIGN KEY (`isBanned`) REFERENCES `user` (`username`);