START TRANSACTION;

CREATE TABLE `comments` (
    `id`              INT(11) NOT NULL,
    `post_id`         INT(11) NOT NULL,
    `author`          VARCHAR(255) NOT NULL,
    `comment`         TEXT NOT NULL,
    `comment_date`    DATETIME NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `comments`
    ADD PRIMARY KEY(`id`),
    ADD KEY `FK_POSTS`(`post_id`);

ALTER TABLE `comments`
    ADD FOREIGN KEY(`post_id`)
        REFERENCES `posts`(`id`)
        ON UPDATE CASCADE ON DELETE CASCADE;

ALTER TABLE `comments`
    MODIFY `id` INT(11) NOT NULL AUTO_INCREMENT;
    
COMMIT;
