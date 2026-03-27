<?php
$basePath = dirname(__DIR__);
require_once $basePath . '/config/db.php';

class Rating {
    private $conn;
    
    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }
    
    public function getByBusinessId($businessId) {
        $stmt = $this->conn->prepare("SELECT * FROM ratings WHERE business_id = ? ORDER BY created_at DESC");
        $stmt->bind_param("i", $businessId);
        $stmt->execute();
        $result = $stmt->get_result();
        $ratings = [];
        
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $ratings[] = $row;
            }
        }
        
        $stmt->close();
        return $ratings;
    }
    
    public function checkExisting($businessId, $email, $phone) {
        $stmt = $this->conn->prepare("SELECT id FROM ratings WHERE business_id = ? AND (email = ? OR phone = ?)");
        $stmt->bind_param("iss", $businessId, $email, $phone);
        $stmt->execute();
        $result = $stmt->get_result();
        $existing = $result->fetch_assoc();
        $stmt->close();
        
        return $existing;
    }
    
    public function create($businessId, $name, $email, $phone, $rating) {
        $stmt = $this->conn->prepare("INSERT INTO ratings (business_id, name, email, phone, rating) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("isssd", $businessId, $name, $email, $phone, $rating);
        $success = $stmt->execute();
        $stmt->close();
        
        return $success;
    }
    
    public function update($businessId, $name, $email, $phone, $rating) {
        $stmt = $this->conn->prepare("UPDATE ratings SET rating = ?, name = ? WHERE business_id = ? AND (email = ? OR phone = ?)");
        $stmt->bind_param("dsiss", $rating, $name, $businessId, $email, $phone);
        $success = $stmt->execute();
        $stmt->close();
        
        return $success;
    }
    
    public function getAverage($businessId) {
        $stmt = $this->conn->prepare("SELECT IFNULL(AVG(rating), 0) as avg_rating, COUNT(id) as total_ratings FROM ratings WHERE business_id = ?");
        $stmt->bind_param("i", $businessId);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_assoc();
        $stmt->close();
        
        return $data;
    }
}
?>
