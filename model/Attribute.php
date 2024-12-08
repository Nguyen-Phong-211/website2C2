<?php
include_once('ConnectDatabase.php');

class AttributeModel extends ConnectDatabase
{
    private $conn;
    public function __construct()
    {
        parent::__construct();
        $this->conn = $this->getConnection();
    }

    public function getAllAttribute()
    {
        $query = "SELECT * FROM Attribute";
        $result = $this->conn->query($query);

        if ($result === false) {
            die("Query failed: " . $this->conn->error);
        }

        return $result;
    }
    public function getAttributesGroupedByCategoryAttribute($category_id, $category_item_id)
{
    // Lọc thuộc tính cần loại bỏ cho từng loại category_item_id
    $excludeAttributesMap = [
        1  => [76, 79, 80, 81, 87, 88, 89], // Xe đạp
        2  => [76,80, 81, 88, 89, 87, 90], // Xe máy điện
        3  => [76,78, 86,81], // Xe gắn máy (Xe số)
        4  => [76,78, 86,81], // Xe gắn máy (Xe tay ga)
        5  => [76, 79, 87,81], // Xe 3 gác
        6  => [76,77, 79,81, 87], // Xe công trường
        7  => [79, 80, 81, 87, 88], // Xe 4 bánh (Xăng dầu)
        8  => [79, 80, 81, 87], // Phụ tùng xe
        44 => [79, 80, 81, 87], // Xe điện 4 bánh
        9  => [96, 97, 99, 101], // Điện thoại thông minh
        10 => [98, 103], // Camera
        11 => [97, 98, 103], // Laptop
        12 => [98, 101, 96, 97, 99, 102], // Máy photo
        13 => [98, 101, 96, 97, 99, 102], // Máy in
        14 => [96, 101, 99, 102, 103], // Màn hình
        15 => [97, 96, 101, 98, 99, 102], // Loa
        16 => [99, 103], // Máy ảnh
        19 => [97, 96, 101, 98, 99, 102, 101], // Tai nghe
        20 => [101, 96, 97, 98, 99, 102], // Chuột
        45 => [96, 101, 103, 102], // Tivi
        21 => [110, 112, 113], // Bếp ga (bếp đôi)
        22 => [110, 112, 113], // Bếp ga (bếp đơn)
        23 => [110, 113], // Bếp hồng ngoại
        24 => [110, 113], // Lò vi sóng
        25 => [110, 113], // Máy xay thịt
        26 => [110, 113], // Máy xay sinh tố
        27 => [110, 113], // Tủ lạnh
        28 => [110, 113], // Máy hút bụi
        29 => [110, 113], // Nồi chiên không dầu
        31 => [110, 113],  // Máy lọc nước
        33 => [124, 123,127], // Dụng cụ viết
        34 => [124, 123,127], // Thiết bị lưu trữ và tài liệu
        35 => [124, 123], // Đồ dùng phục vụ họp và thuyết trình
        40=>[150,146,149]
    ];

    // Lấy thuộc tính cần loại bỏ cho category_item_id
    $excludeAttributes = isset($excludeAttributesMap[$category_item_id]) ? $excludeAttributesMap[$category_item_id] : [];

    // Nếu không có thuộc tính cần loại bỏ, bỏ qua phần loại bỏ trong truy vấn
    if (empty($excludeAttributes)) {
        $excludeAttributesList = ''; // Không loại bỏ thuộc tính nào
    } else {
        $excludeAttributesList = implode(',', $excludeAttributes);
    }

    $sql = "
        SELECT 
            ca.category_attribute_id,
            ca.category_attribute_name,
            a.attribute_id,
            a.attribute_name
        FROM 
            category_attributes AS ca
        LEFT JOIN 
            attributes AS a ON ca.category_attribute_id = a.category_attribute_id
        JOIN categories c ON c.category_id = ca.category_id
        JOIN category_items ci ON ci.category_id = c.category_id
        WHERE 
            ca.category_id = ? 
            AND ci.category_item_id = ?
            " . (empty($excludeAttributesList) ? "" : "AND a.category_attribute_id NOT IN ($excludeAttributesList)") . "
    ";

    $stmt = $this->conn->prepare($sql);
    if (!$stmt) {
        die("SQL Error: " . $this->conn->error);
    }

    $stmt->bind_param("ii", $category_id, $category_item_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $data = [];
    while ($row = $result->fetch_assoc()) {
        if (!isset($row['category_attribute_id']) || empty($row['category_attribute_name'])) {
            continue;
        }

        $category_attribute_id = $row['category_attribute_id'];

        if (!isset($data[$category_attribute_id])) {
            $data[$category_attribute_id] = [
                'category_attribute_name' => $row['category_attribute_name'],
                'attributes' => []
            ];
        }

        if (!empty($row['attribute_id'])) {
            $data[$category_attribute_id]['attributes'][] = [
                'attribute_id' => $row['attribute_id'],
                'attribute_name' => $row['attribute_name']
            ];
        }
    }

    return $data;
}

}