CREATE TABLE `bc_entities` (
    `id`                            INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
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
    `address_cityZipCodeCountry_id` INT(11),
    INDEX(`address_cityZipCodeCountry_id`),
    FOREIGN KEY(`address_cityZipCodeCountry_id`)
      REFERENCES `bc_cityZipCodeCountry`(`id`)
        ON UPDATE CASCADE ON DELETE RESTRICT,  
    `creation_date`                 DATETIME NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
