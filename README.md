### Project's Team Qua Mon
Name: Building a system to purchase  the following C2C Model
<!-- Phân quyền trên role seller và buyer -->
//GRANT TO seller
user: seller
password: seller

//COMANDS

GRANT ALL PRIVILEGES ON projectfinal.carts TO 'seller'@'localhost';

GRANT ALL PRIVILEGES ON projectfinal.images TO 'seller'@'localhost';

GRANT ALL PRIVILEGES ON projectfinal.messages TO 'seller'@'localhost';

GRANT SELECT, UPDATE ON projectfinal.notifications TO 'seller'@'localhost';

GRANT SELECT, UPDATE ON projectfinal.orders TO 'seller'@'localhost';

GRANT SELECT, UPDATE ON projectfinal.order_details TO 'seller'@'localhost';

GRANT ALL PRIVILEGES ON projectfinal.products TO 'seller'@'localhost';

GRANT ALL PRIVILEGES ON projectfinal.registration_products TO 'seller'@'localhost';

GRANT SELECT, INSERT ON projectfinal.reviews TO 'seller'@'localhost';

GRANT SELECT, INSERT, UPDATE ON projectfinal.signup TO 'seller'@'localhost';

GRANT SELECT, INSERT, UPDATE ON projectfinal.users TO 'seller'@'localhost';

GRANT ALL PRIVILEGES ON projectfinal.video_products TO 'seller'@'localhost';

GRANT SELECT, INSERT, DELETE ON projectfinal.whistlists TO 'seller'@'localhost';



user: seller
password: seller

//COMANDS

GRANT ALL PRIVILEGES ON projectfinal.carts TO 'seller'@'localhost';

GRANT SELECT ON projectfinal.images TO 'buyer'@'localhost';

GRANT ALL PRIVILEGES ON projectfinal.messages TO 'buyer'@'localhost';

GRANT SELECT, UPDATE ON projectfinal.notifications TO 'buyer'@'localhost';

GRANT SELECT, UPDATE ON projectfinal.orders TO 'buyer'@'localhost';

GRANT SELECT, UPDATE ON projectfinal.order_details TO 'buyer'@'localhost';

GRANT SELECT ON projectfinal.products TO 'buyer'@'localhost';

GRANT SELECT, INSERT ON projectfinal.reviews TO 'buyer'@'localhost';

GRANT SELECT, INSERT, UPDATE ON projectfinal.signup TO 'buyer'@'localhost';

GRANT SELECT, INSERT, UPDATE ON projectfinal.users TO 'buyer'@'localhost';

GRANT SELECT ON projectfinal.video_products TO 'buyer'@'localhost';

GRANT SELECT, INSERT, DELETE ON projectfinal.whistlists TO 'buyer'@'localhost';


<!-- Sau khi thiết lập các quyền như trên, bạn cần thực hiện câu lệnh FLUSH PRIVILEGES để MySQL cập nhật quyền mới -->


//TRIGGER

<!-- Tự động thêm dữ liệu cột email và number_phone từ bảng signup -> user -->

DELIMITER //

CREATE TRIGGER after_signup_insert
AFTER INSERT ON signup
FOR EACH ROW
BEGIN
    INSERT INTO users (user_id, user_name, number_phone, email)
    VALUES (NEW.user_id, NEW.username, NEW.number_phone, NEW.email);
END;

//

DELIMITER ;



