<?php
/*
 * -----------------------------------------------------------------
 * LỚP KẾT NỐI CƠ SỞ DỮ LIỆU (Giữ nguyên từ file của bạn)
 * -----------------------------------------------------------------
 */
class DBConnection {
    private $username;
    private $hostname;
    private $password;
    private $dbname;
    private $conn;

    public function __construct($h, $u, $p, $db) {
        $this->hostname = $h;
        $this->username = $u;
        $this->password = $p;
        $this->dbname = $db;
    }

    public function chkConnection(): bool {
        try {
            // Thêm charset=utf8 để đảm bảo hỗ trợ tiếng Việt
            $this->conn = new PDO(
                "mysql:host=$this->hostname;dbname=$this->dbname;charset=utf8",
                $this->username,
                $this->password
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return true;
        } catch (PDOException $e) {
            echo "Lỗi kết nối: " . $e->getMessage();
            return false;
        }
    }

    public function getConn() {
        return $this->conn;
    }
}

/*
 * -----------------------------------------------------------------
 * LỚP HỖ TRỢ CƠ SỞ DỮ LIỆU (Mở rộng với INSERT, UPDATE, DELETE)
 * -----------------------------------------------------------------
 */
class DBHelper {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    /**
     * Thực thi một câu lệnh SQL không cần tham số (ví dụ: CREATE TABLE, TRUNCATE)
     */
    public function executeQuery($sql) {
        try {
            $this->db->exec($sql);
            echo "Thực thi câu lệnh thành công: " . $sql . "<br>";
            return true;
        } catch (PDOException $e) {
            echo "Lỗi khi thực thi: " . $e->getMessage() . "<br>";
            return false;
        }
    }

    /**
     * Lấy dữ liệu (SELECT) sử dụng prepared statements
     * @param string $sql Câu lệnh SQL (ví dụ: "SELECT * FROM users WHERE id = ?")
     * @param array $params Mảng các tham số (ví dụ: [1])
     * @return array Mảng các đối tượng kết quả
     */
    public function getData($sql, $params = []) {
        try {
            $stmt = $this->db->prepare($sql);
            $stmt->execute($params);
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            echo "Lỗi khi lấy dữ liệu: " . $e->getMessage() . "<br>";
            return [];
        }
    }

    /**
     * Chèn dữ liệu (INSERT) sử dụng prepared statements
     * @param string $sql Câu lệnh SQL (ví dụ: "INSERT INTO users (name, email) VALUES (?, ?)")
     * @param array $params Mảng các tham số (ví dụ: ['John', 'john@example.com'])
     * @return string|false Trả về ID của bản ghi mới chèn, hoặc false nếu lỗi
     */
    public function insertData($sql, $params = []) {
        try {
            $stmt = $this->db->prepare($sql);
            $stmt->execute($params);
            return $this->db->lastInsertId(); // Trả về ID
        } catch (PDOException $e) {
            echo "Lỗi khi chèn dữ liệu: " . $e->getMessage() . "<br>";
            return false;
        }
    }

    /**
     * Cập nhật dữ liệu (UPDATE) sử dụng prepared statements
     * @param string $sql Câu lệnh SQL (ví dụ: "UPDATE users SET name = ? WHERE id = ?")
     * @param array $params Mảng các tham số (ví dụ: ['John Doe', 1])
     * @return int|false Trả về số hàng bị ảnh hưởng, hoặc false nếu lỗi
     */
    public function updateData($sql, $params = []) {
        try {
            $stmt = $this->db->prepare($sql);
            $stmt->execute($params);
            return $stmt->rowCount(); // Trả về số hàng bị ảnh hưởng
        } catch (PDOException $e) {
            echo "Lỗi khi cập nhật dữ liệu: " . $e->getMessage() . "<br>";
            return false;
        }
    }

    /**
     * Xóa dữ liệu (DELETE) sử dụng prepared statements
     * @param string $sql Câu lệnh SQL (ví dụ: "DELETE FROM users WHERE id = ?")
     * @param array $params Mảng các tham số (ví dụ: [1])
     * @return int|false Trả về số hàng bị ảnh hưởng, hoặc false nếu lỗi
     */
    public function deleteData($sql, $params = []) {
        try {
            $stmt = $this->db->prepare($sql);
            $stmt->execute($params);
            return $stmt->rowCount(); // Trả về số hàng bị ảnh hưởng
        } catch (PDOException $e) {
            echo "Lỗi khi xóa dữ liệu: " . $e->getMessage() . "<br>";
            return false;
        }
    }
}

// --------------------------
// CHẠY CHƯƠNG TRÌNH
// --------------------------

// 1. KẾT NỐI
// (Hãy chắc chắn bạn đã tạo CSDL tên 'test_crud' trong MySQL)
$conn = new DBConnection("localhost", "root", "", "test_crud");

if ($conn->chkConnection()) {
    echo "✅ Kết nối cơ sở dữ liệu 'test_crud' thành công.<br><hr>";

    $dbHelper = new DBHelper($conn->getConn());

    // 2. TẠO BẢNG (Nếu chưa có)
    $sqlCreateTable = "CREATE TABLE IF NOT EXISTS products (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        description TEXT,
        price DECIMAL(10, 2) NOT NULL,
        date_created TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    $dbHelper->executeQuery($sqlCreateTable);

    // (Tùy chọn) Xóa hết dữ liệu cũ để chạy lại ví dụ
    // $dbHelper->executeQuery("TRUNCATE TABLE products");
    // echo "Đã xóa dữ liệu cũ.<br>";

    echo "<hr><h3>1. BẮT ĐẦU CHÈN (INSERT)</h3>";

    // 3. CHÈN (INSERT) DỮ LIỆU
    $sqlInsert = "INSERT INTO products (name, description, price) VALUES (?, ?, ?)";
    
    // Sản phẩm 1
    $params1 = ["Laptop ABC", "Laptop cấu hình mạnh, 16GB RAM", 1200.50];
    $newId1 = $dbHelper->insertData($sqlInsert, $params1);
    if ($newId1) {
        echo "Đã chèn sản phẩm mới thành công, ID: $newId1 <br>";
    }

    // Sản phẩm 2
    $params2 = ["Bàn phím cơ XYZ", "Bàn phím gõ êm, có LED RGB", 99.99];
    $newId2 = $dbHelper->insertData($sqlInsert, $params2);
    if ($newId2) {
        echo "Đã chèn sản phẩm mới thành công, ID: $newId2 <br>";
    }

    echo "<hr><h3>2. ĐỌC (SELECT) TOÀN BỘ DỮ LIỆU</h3>";

    // 4. ĐỌC (SELECT) DỮ LIỆU
    $allProducts = $dbHelper->getData("SELECT * FROM products");
    echo "Hiện có " . count($allProducts) . " sản phẩm:<br>";
    foreach ($allProducts as $product) {
        echo " - ID: $product->id, Tên: $product->name, Giá: $product->price <br>";
    }

    echo "<hr><h3>3. CẬP NHẬT (UPDATE) DỮ LIỆU</h3>";

    // 5. CẬP NHẬT (UPDATE) GIÁ SẢN PHẨM (Laptop)
    $sqlUpdate = "UPDATE products SET price = ? WHERE id = ?";
    $paramsUpdate = [1150.75, $newId1]; // Giảm giá Laptop (ID 1)
    
    $affectedRowsUpdate = $dbHelper->updateData($sqlUpdate, $paramsUpdate);
    echo "Đã cập nhật $affectedRowsUpdate hàng (cập nhật giá Laptop).<br>";

    // Đọc lại thông tin Laptop để kiểm tra
    $updatedLaptop = $dbHelper->getData("SELECT * FROM products WHERE id = ?", [$newId1]);
    if (!empty($updatedLaptop)) {
        echo "Giá mới của Laptop: " . $updatedLaptop[0]->price . "<br>";
    }

    echo "<hr><h3>4. XÓA (DELETE) DỮ LIỆU</h3>";

    // 6. XÓA (DELETE) SẢN PHẨM (Bàn phím)
    $sqlDelete = "DELETE FROM products WHERE id = ?";
    $paramsDelete = [$newId2]; // Xóa Bàn phím (ID 2)
    
    $affectedRowsDelete = $dbHelper->deleteData($sqlDelete, $paramsDelete);
    echo "Đã xóa $affectedRowsDelete hàng (xóa Bàn phím).<br>";


    echo "<hr><h3>5. ĐỌC (SELECT) DỮ LIỆU CUỐI CÙNG</h3>";

    // 7. ĐỌC LẠI TOÀN BỘ DỮ LIỆU
    $finalProducts = $dbHelper->getData("SELECT * FROM products");
    echo "Hiện có " . count($finalProducts) . " sản phẩm:<br>";
    foreach ($finalProducts as $product) {
        echo " - ID: $product->id, Tên: $product->name, Giá: $product->price <br>";
    }

} else {
    echo "❌ Kết nối thất bại. Vui lòng kiểm tra thông tin kết nối và đảm bảo CSDL 'test_crud' đã tồn tại.";
}
?>