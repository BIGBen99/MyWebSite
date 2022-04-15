CREATE TABLE `posts` (
    `id`            INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `title`         VARCHAR(255) NOT NULL,
    `content`       TEXT NOT NULL,
    `creation_date` DATETIME NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
