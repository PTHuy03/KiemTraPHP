<?php
require_once __DIR__ . "/../../config/database.php";

class User
{
    private $conn;
    private $table = "users";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Đăng ký người dùng
    public function register($username, $password, $fullname, $email, $role = 'user')
    {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $query = "INSERT INTO " . $this->table . " (username, password, fullname, email, role) 
                  VALUES (:username, :password, :fullname, :email, :role)";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $hashed_password);
        $stmt->bindParam(':fullname', $fullname);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':role', $role);

        return $stmt->execute();
    }

    // Đăng nhập
    public function login($email, $password)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE email = :email LIMIT 1";
        $stmt = $this->conn->prepare($query);

        // Bind giá trị email đúng cách
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Debug (có thể xóa sau khi kiểm tra)
        var_dump($user);

        // So sánh mật khẩu trực tiếp (KHÔNG KHUYẾN KHÍCH)
        if ($user && $password === $user['password']) {
            return $user; // Đăng nhập thành công
        }

        return false; // Sai email hoặc mật khẩu
    }
}
