<?php
session_start(); // Đảm bảo session hoạt động

require_once 'app/models/nhanvien.php';
require_once 'config/database.php';
require_once __DIR__ . "/app/controllers/AuthController.php"; // Sửa lại đường dẫn đúng

// Kết nối database
$database = new Database();
$conn = $database->getConnection();

// Xử lý URL
$url = $_GET['url'] ?? '';
$url = rtrim($url, '/');
$url = filter_var($url, FILTER_SANITIZE_URL);
$url = explode('/', $url);

// Route xử lý đăng nhập
if (isset($_GET['url']) && $_GET['url'] == "auth/login") {
    $auth = new AuthController($conn);
    $auth->login();
}

// Xác định controller & action
$controllerName = isset($url[0]) && $url[0] != '' ? ucfirst($url[0]) . 'Controller' : 'NhanVienController';
$action = isset($url[1]) && $url[1] != '' ? $url[1] : 'index';

$controllerFile = 'app/controllers/' . $controllerName . '.php';

if (!file_exists($controllerFile)) {
    http_response_code(404);
    die('❌ Controller không tồn tại: ' . $controllerName);
}

require_once $controllerFile;

// Kiểm tra nếu class controller tồn tại
if (!class_exists($controllerName)) {
    http_response_code(500);
    die('❌ Lỗi: Không tìm thấy class của controller ' . $controllerName);
}

// Khởi tạo controller
$reflection = new ReflectionClass($controllerName);
if ($reflection->getConstructor() && $reflection->getConstructor()->getNumberOfParameters() > 0) {
    $controller = new $controllerName($conn);
} else {
    $controller = new $controllerName();
}

// Kiểm tra action có tồn tại trong controller không
if (!method_exists($controller, $action)) {
    http_response_code(404);
    die('❌ Lỗi: Action không tồn tại trong ' . $controllerName);
}

// Nếu action yêu cầu phân quyền, kiểm tra session
if (in_array($action, ['indexAdmin', 'manage', 'deleteUser'])) { // Các action cần quyền admin
    if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
        header("Location: index.php?url=auth/login");
        exit();
    }
}

// Gọi action với tham số nếu có
call_user_func_array([$controller, $action], array_slice($url, 2));
