<?php
require_once __DIR__ . "/../models/NhanVien.php";
require_once __DIR__ . "/../models/PhongBan.php";

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

class NhanVienController
{
    private $model;
    private $db; // Thêm biến kết nối database

    public function __construct($conn)
    {
        $this->db = $conn; // Lưu kết nối database
        $this->model = new NhanVien($this->db);
    }

    public function index()
    {
        $limit = 5;
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $page = max($page, 1);
        $offset = ($page - 1) * $limit;

        $nhanviens = $this->model->getAll($limit, $offset);
        $total = $this->model->countAll();
        $totalPages = ceil($total / $limit);

        require_once __DIR__ . "/../views/listNhanVien.php";
    }

    public function indexAdmin()
    {
        if (!isset($_SESSION['user'])) {
            header("Location: /sangT5/Test/auth/login");
            exit();
        }

        if ($_SESSION['user']['role'] !== "admin") {
            echo "Bạn không có quyền truy cập!";
            exit();
        }

        $limit = 5;
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $page = max($page, 1);
        $offset = ($page - 1) * $limit;

        $nhanviens = $this->model->getAll($limit, $offset);
        $total = $this->model->countAll();
        $totalPages = ceil($total / $limit);

        require_once __DIR__ . "/../views/nhanvien/list.php";
    }

    public function create()
    {
        $phongBanModel = new PhongBan($this->db);
        $phongBans = $phongBanModel->getAll(); // Lấy danh sách phòng ban

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'Ma_NV' => $_POST['Ma_NV'],
                'Ten_NV' => $_POST['Ten_NV'],
                'Phai' => $_POST['Phai'],
                'Noi_Sinh' => $_POST['Noi_Sinh'],
                'Luong' => $_POST['Luong'],
                'Ma_Phong' => $_POST['Ma_Phong'],
            ];

            if ($this->model->create($data)) {
                header("Location: /sangT5/Test/NhanVien/indexAdmin");
                exit();
            }
        }

        require_once __DIR__ . "/../views/nhanvien/create.php";
    }

    public function edit()
    {
        $id = $_GET['id'];
        $nhanvien = $this->model->getById($id);

        if (!$nhanvien) {
            echo "Nhân viên không tồn tại!";
            exit();
        }

        $phongBanModel = new PhongBan($this->db); // Thêm danh sách phòng ban vào form sửa
        $phongBans = $phongBanModel->getAll();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'Ten_NV' => $_POST['Ten_NV'],
                'Phai' => $_POST['Phai'],
                'Noi_Sinh' => $_POST['Noi_Sinh'],
                'Luong' => $_POST['Luong'],
                'Ma_Phong' => $_POST['Ma_Phong'],
            ];

            if ($this->model->update($id, $data)) {
                header("Location: /sangT5/Test/NhanVien/indexAdmin");
                exit();
            }
        }

        require_once __DIR__ . "/../views/nhanvien/edit.php";
    }

    public function delete()
    {
        $id = $_GET['id'];

        if ($this->model->delete($id)) {
            header("Location: /sangT5/Test/NhanVien/indexAdmin");
            exit();
        } else {
            echo "Lỗi khi xóa nhân viên!";
        }
    }
}
