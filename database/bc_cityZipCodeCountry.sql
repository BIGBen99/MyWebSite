CREATE TABLE `bc_cityZipCodeCountry` (
    `id`                          INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `city`                        VARCHAR(255),
    `zipCode`                     VARCHAR(5),
    `country`                     VARCHAR(255),
    `creation_date`               DATETIME NOT NULL,
    UNIQUE UnicityConstraint (`city`, `zipCode`, `country`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
