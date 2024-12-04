<?php 
    include_once('ConnectDatabase.php');

    class OrderDetail extends ConnectDatabase{
        private $conn;

        public function __construct(){
            parent::__construct();
            $this->conn = $this->getConnection();
        }
        //get all order detail
        public function getAllOrderDetailByUserId($userId){
            $stmt = $this->conn->prepare("
            SELECT DISTINCT 
                o.order_id, 
                o.user_id, 
                o.create_at AS o_create_at, 
                o.update_at AS o_update_at,
                o.status, 
                od.*, 
                p.product_name, 
                i.image_name,
                rl.*
            FROM orders AS o
            JOIN order_details AS od ON o.order_id = od.order_id
            JOIN products AS p ON od.product_id = p.product_id
            JOIN (
                SELECT 
                    product_id, 
                    MIN(image_id) AS first_image_id
                FROM images
                GROUP BY product_id
            ) AS img ON p.product_id = img.product_id
            JOIN images AS i ON img.first_image_id = i.image_id
            JOIN users AS u ON o.user_id = ?
            JOIN roles AS rl ON rl.role_id = u.role_id
            WHERE o.status IN (0, 1, 2, 3) AND u.role_id = 2
            ");
            $stmt->bind_param("i", $userId);
    
            $stmt->execute();
            $result = $stmt->get_result();
            return $result->fetch_all(MYSQLI_ASSOC);
        }
        //count order detail by user id
        public function countOrderDetailByUserId($userId)
        {
            $stmt = $this->conn->prepare("
                SELECT COUNT(*) AS total_orders 
                FROM orders AS o 
                JOIN order_details AS od ON o.order_id = od.order_id 
                JOIN users AS u ON u.user_id = o.user_id
                WHERE o.user_id = ?
            ");
            $stmt->bind_param("i", $userId);
            
            if ($stmt->execute()) {
                $result = $stmt->get_result();
                $row = $result->fetch_assoc();
                return $row['total_orders'];
            } else {
                return 0; 
            }
        }
        public function getAllOrderDetailByRoleSeller($userId) {
            $stmt = $this->conn->prepare("
                SELECT 
                    o.order_id, 
                    o.user_id, 
                    o.create_at AS o_create_at, 
                    o.update_at AS o_update_at,
                    o.order_status, 
                    od.*, 
                    p.product_name, 
                    i.image_name,
                    rl.*,
                    u.role_seller_id
                FROM orders AS o
                JOIN order_details AS od ON o.order_id = od.order_id
                JOIN products AS p ON od.product_id = p.product_id
                JOIN (
                    SELECT 
                        product_id, 
                        MIN(image_id) AS first_image_id
                    FROM images
                    GROUP BY product_id
                ) AS img ON p.product_id = img.product_id
                JOIN images AS i ON img.first_image_id = i.image_id
                JOIN users AS u ON o.user_id = ?
                JOIN roles AS rl ON rl.role_id = u.role_seller_id
                WHERE u.role_seller_id = 1
            ");
            $stmt->bind_param("i", $userId);
        
            $stmt->execute();
            $result = $stmt->get_result();
            return $result->fetch_all(MYSQLI_ASSOC);
        }        
    }
?>