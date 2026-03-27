<?php
header('Content-Type: application/json');
$basePath = dirname(__DIR__);
require_once $basePath . '/controllers/RatingController.php';

$controller = new RatingController();
$action = $_POST['action'] ?? $_GET['action'] ?? '';

switch ($action) {
    case 'list':
        $businessId = intval($_GET['business_id'] ?? 0);
        echo json_encode($controller->index($businessId));
        break;
    
    case 'submit':
        echo json_encode($controller->store($_POST));
        break;
    
    default:
        echo json_encode(['status' => 'error', 'message' => 'Invalid action']);
}
?>
