<?php
class Database {
    private $host = 'localhost';
    private $username = 'root';
    private $password = 'Siddhant@0867';
    private $database = 'business_rating_system';
    private $conn;
    
    public function getConnection() {
        if ($this->conn === null) {
            $this->conn = new mysqli($this->host, $this->username, $this->password, $this->database);
            
            if ($this->conn->connect_error) {
                die(json_encode(['status' => 'error', 'message' => 'Connection failed: ' . $this->conn->connect_error]));
            }
            
            $this->conn->set_charset('utf8mb4');
        }
        
        return $this->conn;
    }
}
?>
