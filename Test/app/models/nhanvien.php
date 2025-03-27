<?php
require_once __DIR__ . "/../../config/database.php";

class NhanVien
{
    private $conn;
    private $table = "nhanvien";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Lấy danh sách nhân viên có phân trang và thông tin phòng ban
    public function getAll($limit, $offset)
    {
        $query = "SELECT nhanvien.Ma_NV, nhanvien.Ten_NV, nhanvien.Phai, nhanvien.Noi_Sinh, 
                         nhanvien.Luong, phongban.Ten_Phong
                  FROM " . $this->table . "
                  JOIN phongban ON nhanvien.Ma_Phong = phongban.Ma_Phong
                  LIMIT :limit OFFSET :offset";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Đếm tổng số nhân viên
    public function countAll()
    {
        $query = "SELECT COUNT(*) as total FROM " . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }

    public function create($data)
    {
        $query = "INSERT INTO nhanvien (Ma_NV, Ten_NV, Phai, Noi_Sinh, Luong, Ma_Phong) 
              VALUES (:Ma_NV, :Ten_NV, :Phai, :Noi_Sinh, :Luong, :Ma_Phong)";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute($data);
    }

    public function getById($id)
    {
        $query = "SELECT * FROM nhanvien WHERE Ma_NV = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, $data)
    {
        $query = "UPDATE nhanvien 
              SET Ten_NV = :Ten_NV, Phai = :Phai, Noi_Sinh = :Noi_Sinh, Luong = :Luong, Ma_Phong = :Ma_Phong 
              WHERE Ma_NV = :id";
        $stmt = $this->conn->prepare($query);
        $data['id'] = $id;
        return $stmt->execute($data);
    }

    public function delete($id)
    {
        $query = "DELETE FROM nhanvien WHERE Ma_NV = :id LIMIT 1"; // Giới hạn chỉ xóa 1 dòng
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_STR); // Định dạng là chuỗi
        return $stmt->execute();
    }
}
