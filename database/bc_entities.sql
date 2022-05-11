CREATE TABLE `bc_entities` (
    `id`                          INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `siren`                       VARCHAR(9),
    `numeroInternedeClassement`   VARCHAR(5),
    `name`                        VARCHAR(255) NOT NULL,
    `parent_id`                   INT(11),
    `address_id`                  INT(11),
    `creation_date`               DATETIME NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
