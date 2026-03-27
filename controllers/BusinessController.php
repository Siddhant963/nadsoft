<?php
$basePath = dirname(__DIR__);
require_once $basePath . '/models/Business.php';

class BusinessController {
    private $model;
    
    public function __construct() {
        $this->model = new Business();
    }
    
    public function index() {
        return ['status' => 'success', 'data' => $this->model->getAll()];
    }
    
    public function show($id) {
        $business = $this->model->getById($id);
        if ($business) {
            return ['status' => 'success', 'data' => $business];
        }
        return ['status' => 'error', 'message' => 'Business not found'];
    }
    
    public function store($data) {
        $name = trim($data['name'] ?? '');
        $address = trim($data['address'] ?? '');
        $phone = trim($data['phone'] ?? '');
        $email = trim($data['email'] ?? '');
        
        if (empty($name)) {
            return ['status' => 'error', 'message' => 'Business name is required'];
        }
        
        $result = $this->model->create($name, $address, $phone, $email);
        
        if ($result['success']) {
            return ['status' => 'success', 'message' => 'Business added successfully', 'id' => $result['id']];
        }
        
        return ['status' => 'error', 'message' => 'Failed to add business'];
    }
    
    public function update($data) {
        $id = intval($data['id'] ?? 0);
        $name = trim($data['name'] ?? '');
        $address = trim($data['address'] ?? '');
        $phone = trim($data['phone'] ?? '');
        $email = trim($data['email'] ?? '');
        
        if ($id <= 0 || empty($name)) {
            return ['status' => 'error', 'message' => 'Invalid data'];
        }
        
        $success = $this->model->update($id, $name, $address, $phone, $email);
        
        if ($success) {
            return ['status' => 'success', 'message' => 'Business updated successfully'];
        }
        
        return ['status' => 'error', 'message' => 'Failed to update business'];
    }
    
    public function delete($id) {
        if ($id <= 0) {
            return ['status' => 'error', 'message' => 'Invalid ID'];
        }
        
        $success = $this->model->delete($id);
        
        if ($success) {
            return ['status' => 'success', 'message' => 'Business deleted successfully'];
        }
        
        return ['status' => 'error', 'message' => 'Failed to delete business'];
    }
}
?>
