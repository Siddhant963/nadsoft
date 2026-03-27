<?php
$basePath = dirname(__DIR__);
require_once $basePath . '/models/Rating.php';

class RatingController {
    private $model;
    
    public function __construct() {
        $this->model = new Rating();
    }
    
    public function index($businessId) {
        $ratings = $this->model->getByBusinessId($businessId);
        return ['status' => 'success', 'data' => $ratings];
    }
    
    public function store($data) {
        $businessId = intval($data['business_id'] ?? 0);
        $name = trim($data['name'] ?? '');
        $email = trim($data['email'] ?? '');
        $phone = trim($data['phone'] ?? '');
        $rating = floatval($data['rating'] ?? 0);
        
        if ($businessId <= 0 || empty($name) || $rating < 1 || $rating > 5) {
            return ['status' => 'error', 'message' => 'Invalid input'];
        }
        
        if (empty($email) && empty($phone)) {
            return ['status' => 'error', 'message' => 'Email or phone required'];
        }
        
        $existing = $this->model->checkExisting($businessId, $email, $phone);
        
        if ($existing) {
            $success = $this->model->update($businessId, $name, $email, $phone, $rating);
            $message = 'Rating updated successfully';
        } else {
            $success = $this->model->create($businessId, $name, $email, $phone, $rating);
            $message = 'Rating submitted successfully';
        }
        
        if ($success) {
            $avgData = $this->model->getAverage($businessId);
            return [
                'status' => 'success',
                'message' => $message,
                'avg_rating' => round($avgData['avg_rating'], 1),
                'total_ratings' => $avgData['total_ratings'],
                'business_id' => $businessId
            ];
        }
        
        return ['status' => 'error', 'message' => 'Failed to submit rating'];
    }
}
?>
