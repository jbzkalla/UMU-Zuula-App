<?php
if(!defined('DB_SERVER')){
    require_once("../initialize.php");
}
class DBConnection{

    private $host = DB_SERVER;
    private $username = DB_USERNAME;
    private $password = DB_PASSWORD;
    private $database = DB_NAME;
    
    public $conn;
    public $pdo;
    
    public function __construct(){
        // Legacy mysqli connection for backwards compatibility
        if (!isset($this->conn)) {
            $this->conn = new mysqli($this->host, $this->username, $this->password, $this->database);
            if (!$this->conn) {
                echo 'Cannot connect to database server with mysqli';
                exit;
            }            
        }    

        // Secure PDO connection for new Phase 2/3/4 implementations
        if (!isset($this->pdo)) {
            $dsn = "mysql:host={$this->host};dbname={$this->database};charset=utf8mb4";
            $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ];
            try {
                $this->pdo = new PDO($dsn, $this->username, $this->password, $options);
            } catch (\PDOException $e) {
                throw new \PDOException($e->getMessage(), (int)$e->getCode());
            }
        }
    }
    public function __destruct(){
        if($this->conn) $this->conn->close();
    }
}
?>