CREATE TABLE `bc_entities` (
    `id`                            INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `code`                          VARCHAR(255),
    `siren`                         VARCHAR(9),
    `numeroInternedeClassement`     VARCHAR(5),
    `name`                          VARCHAR(255) NOT NULL,
    `parent_id`                     INT(11),
    INDEX(`parent_id`),
    FOREIGN KEY(`parent_id`)
      REFERENCES `bc_entities`(`id`)
        ON UPDATE CASCADE ON DELETE SET NULL,
    `address_line1`                 VARCHAR(255),
    `address_line2`                 VARCHAR(255),
    `address_line3`                 VARCHAR(255),
    `address_zipCode`               VARCHAR(5),
    `address_city`                  VARCHAR(32),
    `address_country_id`            INT(11),
    INDEX(`address_country_id`),
    FOREIGN KEY(`address_country_id`)
      REFERENCES `bc_country`(`id`)
        ON UPDATE CASCADE ON DELETE RESTRICT,  
    `address_pliNonDistribuable`    BOOLEAN,
    `creation_date`                 DATETIME NOT NULL,
    UNIQUE UnicityConstraint (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
