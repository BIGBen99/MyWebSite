CREATE TABLE `bc_country` (
    `id`                          INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `name`                        VARCHAR(255),
    `creation_date`               DATETIME NOT NULL,
    UNIQUE UnicityConstraint (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
