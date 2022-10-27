CREATE TABLE `item`(
    `id` INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `best_before` VARCHAR(11),
    `barcode` INT(15),
    `bought` TINYINT(1),
    FOREIGN KEY ('barcode') REFERENCES 'product' ('barcode') ON DELETE NO ACTION ON UPDATE NO ACTION
);