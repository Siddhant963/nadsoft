<?php
header('Content-Type: application/json');
$basePath = dirname(__DIR__);
require_once $basePath . '/controllers/BusinessController.php';

$controller = new BusinessController();
$action = $_POST['action'] ?? $_GET['action'] ?? '';

switch ($action) {
    case 'list':
        echo json_encode($controller->index());
        break;
    
    case 'get':
        $id = intval($_GET['id'] ?? 0);
        echo json_encode($controller->show($id));
        break;
    
    case 'add':
        echo json_encode($controller->store($_POST));
        break;
    
    case 'update':
        echo json_encode($controller->update($_POST));
        break;
    
    case 'delete':
        $id = intval($_POST['id'] ?? 0);
        echo json_encode($controller->delete($id));
        break;
    
    default:
        echo json_encode(['status' => 'error', 'message' => 'Invalid action']);
}
?>
