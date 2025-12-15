<?php 
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
            $this->conn = new PDO("mysql:host=$this->hostname;dbname=$this->dbname;charset=utf8", 
                                  $this->username, 
                                  $this->password);
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

class DBHelper {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function createTable($sql) {
        try {
            $this->db->exec($sql);
            echo "Tạo bảng thành công!<br>";
        } catch (PDOException $e) {
            echo "Lỗi khi tạo bảng: " . $e->getMessage();
        }
    }

    public function getDataFromTable($sql) {
        try {
            $stmt = $this->db->query($sql);
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            echo "Lỗi khi lấy dữ liệu: " . $e->getMessage();
            return [];
        }
    }
}

// --------------------------
// CHẠY CHƯƠNG TRÌNH
// --------------------------
$conn = new DBConnection("localhost", "root", "", "test");

if ($conn->chkConnection()) {
    echo "✅ Kết nối cơ sở dữ liệu thành công.<br>";

    $dbHelper = new DBHelper($conn->getConn());

    // Tạo bảng nếu chưa có
    $sql = "CREATE TABLE IF NOT EXISTS users (
        id INT(10) AUTO_INCREMENT PRIMARY KEY,
        name NVARCHAR(30) NOT NULL,
        date_created TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    $dbHelper->createTable($sql);

    // Truy vấn dữ liệu
    $data = $dbHelper->getDataFromTable("SELECT * FROM users");
    foreach ($data as $row) {
        echo "Tên: " . $row->name . "<br>";
    }
} else {
    echo "❌ Kết nối thất bại.";
}
?>
