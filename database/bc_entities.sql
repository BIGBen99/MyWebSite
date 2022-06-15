CREATE TABLE `bc_entities` (
    `code`                          INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
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
    `zipCode`                       VARCHAR(5),
    `city`                          VARCHAR(32),
    `country_id`                    INT(11),
    INDEX(`country_id`),
    FOREIGN KEY(`country_id`)
      REFERENCES `bc_country`(`id`)
        ON UPDATE CASCADE ON DELETE RESTRICT,  
    `address_pliNonDistribuable`    BOOLEAN,
    `creation_date`                 DATETIME NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
