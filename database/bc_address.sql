CREATE TABLE `bc_address` (
    `id`                          INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `line1`                       VARCHAR(255),
    `line2`                       VARCHAR(255),
    `line3`                       VARCHAR(255),
    'cityZipCodeCountry_id'       INT(11),
    `creation_date`               DATETIME NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
