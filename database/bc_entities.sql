CREATE TABLE `bc_entities` (
    `id`                          INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `siren`                       VARCHAR(9),
    `numeroInternedeClassement`   VARCHAR(5),
    `name`                        VARCHAR(255) NOT NULL,
    `parent_id`                   INT(11),
    `address_line1`               VARCHAR(255),
    `address_line2`               VARCHAR(255),
    `address_line3`               VARCHAR(255),
    `address_zipCode`             VARCHAR(255),
    `address_city`                VARCHAR(255),
    `address_country`             VARCHAR(255),
    `address_pliNonDistribuable`  BOOLEAN,
    `creation_date`               DATETIME NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
