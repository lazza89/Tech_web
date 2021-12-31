DROP TABLE IF EXISTS `comment`;
DROP TABLE IF EXISTS `user`;

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
    `user` ADD UNIQUE `user_email_unique`(`email`);
ALTER TABLE
    `user` ADD PRIMARY KEY `user_username_primary`(`username`);
CREATE TABLE `comment`(
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `username` VARCHAR(255) NOT NULL,
    `comment` VARCHAR(400) NOT NULL,
    `stars` TINYINT UNSIGNED NOT NULL,
    `date` DATETIME NOT NULL,
    `isBanned` VARCHAR(255) NULL,
     primary key (id)
);
ALTER TABLE
    `comment` ADD CONSTRAINT `comment_username_foreign` FOREIGN KEY(`username`) REFERENCES `user`(`username`);
ALTER TABLE
    `comment` ADD CONSTRAINT `comment_isbanned_foreign` FOREIGN KEY(`isBanned`) REFERENCES `user`(`username`);


INSERT INTO
`user` (`email`,`username`, `password`, `name`, `surname`, `city`, `isAdmin`)
values
('admin@admin.com','admin', 'admin', 'genoveffo', 'paloduro', 'skskucity', 1),
('user@user.com','user', 'user', 'franco', 'battiatino', 'cuccuruccucù', 0),
('giovanni@mail.com','giovanni', 'giovanni', 'giovanni', 'giovannini', 'giovannopoli', 0),
('francesco@mail.com','francesco', 'francesco', 'francesco', 'franceschini', 'francescopoli', 0),
('giulio@mail.com','giulio', 'giulio', 'giulio', 'giulini', 'giulienopoli', 0);



INSERT INTO
`comment` (`id`, `username`, `comment`, `stars`, `date`, `isBanned`) 
values 
(0,'giovanni', 'sciao bela', 5, NOW(), NULL);



