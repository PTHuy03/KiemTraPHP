<?php
ob_start();
require_once __DIR__ . "/../models/user.php";
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


class AuthController
{
    private $userModel;

    public function __construct($db)
    {
        $this->userModel = new User($db);
    }

    // Mặc định hiển thị trang đăng nhập
    public function index()
    {
        require_once "app/views/login.php";
    }

    // Xử lý đăng nhập
    public function login()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $user = $this->userModel->login($email, $password);
            var_dump($user);
            if ($user) {
                $_SESSION['user'] = $user;

                if ($user['role'] == "admin") {
                    header("Location: /sangT5/Test/NhanVien/indexAdmin");
                } else {
                    header("Location: /sangT5/Test/NhanVien");
                }
            } else {
                echo "Sai email hoặc mật khẩu!";
            }
        }

        require_once "app/views/login.php";
    }

    // Đăng xuất
    public function logout()
    {
        session_start();
        $_SESSION = [];
        session_destroy();
        header("Location: /sangT5/Test/Auth/login"); // Chuyển hướng về trang đăng nhập
        exit();
    }
}
