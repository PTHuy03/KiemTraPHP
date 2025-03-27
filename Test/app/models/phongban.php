<?php
class PhongBan
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getAll()
    {
        $stmt = $this->db->query("SELECT * FROM phongban");
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Sửa fetch_all() thành fetchAll(PDO::FETCH_ASSOC)
    }
}
