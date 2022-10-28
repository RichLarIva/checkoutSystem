CREATE TABLE orders(
    order_id INT(11) AUTO_INCREMENT PRIMARY KEY,
    order_date DATETIME NOT NULL DEFAULT current_timestamp(),
    order_total DOUBLE(11,2) NOT NULL,
    pay_type TINYINT(1) default '0'
)