<?php 
class DbConnection{
	private const USERNAME = "root";
	private const HOSTNAME ="localhost";
	private const PASSWORD ="";
	private const DB_NAME ="taskproject";
	private static ?PDO $pdo = null;
	
	private static ?DbConnection $connection = null;

	private function __construct() {} 

	private function __clone() {}  
	public static function getConnection() : DbConnection
	{
		if (self::$connection === null)
			self::$connection = new self();
		return self::$connection;		
	}

	public function connect()
	{	if (self::$pdo === null) {
            $dsn = "mysql:host=" . self::HOSTNAME . ";dbname=" . self::DB_NAME;
            

            $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, 
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,       
                PDO::ATTR_EMULATE_PREPARES   => false,                 
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4"    
            ];

            try {
                self::$pdo = new PDO($dsn, self::USERNAME, self::PASSWORD, $options);
            } catch (PDOException $e) {
                throw new PDOException("Lỗi kết nối CSDL: " . $e->getMessage(), (int)$e->getCode());
            }
        }
        return self::$pdo;
	}
}


class DbHelper
{
	private PDO $pdo;
	public function __construct(){

		try {
            $this->pdo = DbConnection::getConnection()->connect();
        } catch (PDOException $e) {
            die("Không thể khởi tạo DbHelper: " . $e->getMessage());
        }
    }
	
	
	
	private function executeStatement(string $sql, array $params)
    {
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($params); 
            return $stmt;
        } catch (PDOException $e) {
            throw new PDOException("Lỗi thực thi truy vấn SQL: " . $e->getMessage() . " - SQL: " . $sql, (int)$e->getCode());
        }
    }

    public function select(string $sql, array $params = [], bool $fetchAll = true)
    {
        $stmt = $this->executeStatement($sql, $params);
        
        if ($fetchAll) {
            return $stmt->fetchAll();
        }
        
        return $stmt->fetch();
    }

	public function execute($sql, array $params = [])
	{		
		$stmt = $this->executeStatement($sql, $params);
        return $stmt->rowCount();
	}

	public function insert(string $sql, array $params = [])
    {
        $this->execute($sql, $params);

        return (int)$this->pdo->lastInsertId();
    }
	
	public function delete(string $sql, array $params = []): int
    {

        $rowsAffected = $this->execute($sql, $params);
        
        return $rowsAffected;
    }
    public function update(string $sql, array $params = []): int
    {
    return $this->execute($sql, $params);
    }

}
?>