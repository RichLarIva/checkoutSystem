CREATE TABLE order_item(
    order_item_id INT(11) AUTO_INCREMENT PRIMARY KEY,
    order_id INT(11) NOT NULL,
    item_id INT(11) NOT NULL,
    item_name VARCHAR(255) NOT NULL,
    item_qty INT(20) NOT NULL,
    item_price DOUBLE(11,2) NOT NULL,
    ADD FOREIGN KEY (`order_id`) REFERENCES `orders`(`order_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
    ADD FOREIGN KEY (`item_name`) REFERENCES `product`(`product_name`) ON DELETE RESTRICT ON UPDATE RESTRICT
)