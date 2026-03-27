<?php
$basePath = dirname(__DIR__);
require_once $basePath . '/config/db.php';

class Business {
    private $conn;
    
    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }
    
    public function getAll() {
        $query = "SELECT b.*, 
                  IFNULL(AVG(r.rating), 0) as avg_rating,
                  COUNT(r.id) as total_ratings
                  FROM businesses b
                  LEFT JOIN ratings r ON b.id = r.business_id
                  GROUP BY b.id
                  ORDER BY b.id DESC";
        
        $result = $this->conn->query($query);
        $businesses = [];
        
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $businesses[] = $row;
            }
        }
        
        return $businesses;
    }
    
    public function getById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM businesses WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $business = $result->fetch_assoc();
        $stmt->close();
        
        return $business;
    }
    
    public function create($name, $address, $phone, $email) {
        $stmt = $this->conn->prepare("INSERT INTO businesses (name, address, phone, email) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $name, $address, $phone, $email);
        $success = $stmt->execute();
        $id = $this->conn->insert_id;
        $stmt->close();
        
        return ['success' => $success, 'id' => $id];
    }
    
    public function update($id, $name, $address, $phone, $email) {
        $stmt = $this->conn->prepare("UPDATE businesses SET name = ?, address = ?, phone = ?, email = ? WHERE id = ?");
        $stmt->bind_param("ssssi", $name, $address, $phone, $email, $id);
        $success = $stmt->execute();
        $stmt->close();
        
        return $success;
    }
    
    public function delete($id) {
        $stmt = $this->conn->prepare("DELETE FROM businesses WHERE id = ?");
        $stmt->bind_param("i", $id);
        $success = $stmt->execute();
        $stmt->close();
        
        return $success;
    }
}
?>
