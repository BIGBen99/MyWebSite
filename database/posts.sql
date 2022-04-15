START TRANSACTION;

CREATE TABLE `posts` (
    `id`            INT(11) NOT NULL,
    `title`         VARCHAR(255) NOT NULL,
    `content`       TEXT NOT NULL,
    `creation_date` DATETIME NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `posts`
    ADD PRIMARY KEY(`id`);

ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

COMMIT;
