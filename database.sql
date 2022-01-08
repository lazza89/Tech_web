DROP TABLE IF EXISTS `comment`;
DROP TABLE IF EXISTS `user`;

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
    `comment` VARCHAR(400) NOT NULL,
    `stars` TINYINT UNSIGNED NOT NULL,
    `date` DATETIME NOT NULL,

    PRIMARY KEY (`id`)
);
ALTER TABLE
    `comment` ADD CONSTRAINT `comment_userid_foreign` FOREIGN KEY(`userId`) REFERENCES `user`(`id`);


INSERT INTO
`user` (`id`, `email`,`username`, `password`, `name`, `surname`, `city`, `isAdmin`)
values
(NULL, 'admin@admin.com','admin', 'admin', 'genoveffo', 'paloduro', 'skskucity', 1),
(NULL, 'user@user.com','user', 'user', 'franco', 'battiatino', 'cuccuruccuc', 0),
(NULL, 'giovanni@mail.com','giovanni', 'giovanni', 'giovanni', 'giovannini', 'giovannopoli', 0),
(NULL, 'francesco@mail.com','francesco', 'francesco', 'francesco', 'franceschini', 'francescopoli', 0),
(NULL, 'giulio@mail.com','giulio', 'giulio', 'giulio', 'giulini', 'giulienopoli', 0);

INSERT INTO
`comment` (`id`, `userId`, `comment`, `stars`, `date`) 
values 
(NULL, 2, 'Bellssimo impianto! costa 800 mila euro uno skipass però ne vale la pena!', 5, NOW()),
(NULL, 3, '800 mila euro per uno skipass? neanche a cortina costa così tanto!', 2, NOW()),
(NULL, 4, 'Che schifo!, le piste sono battuta male e gli impianti di risalita sono pieni di barboni! orrore!', 1, NOW()),
(NULL, 5, 'Fanc*lo sto skifo di pise, nn ci o mai scato pero dalle recenzioni dicono che fa skifo quindi fa skifo!', 1, NOW());




