CREATE TABLE `comments` (
    `id`              INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `post_id`         INT(11) NOT NULL,
    INDEX (`post_id`),
    FOREIGN KEY(`post_id`)
    	REFERENCES `posts`(`id`)
        ON UPDATE CASCADE ON DELETE CASCADE,
    `author`          VARCHAR(255) NOT NULL,
    `comment`         TEXT NOT NULL,
    `comment_date`    DATETIME NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
