<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Sửa Nhân Viên</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/public/css/style.css">
</head>

<body>
    <?php include __DIR__ . '/../layouts/header.php'; ?>

    <div class="container mt-4 mb-3">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-lg p-4">
                    <h2 class="text-center mb-4">Sửa Nhân Viên</h2>

                    <form action="/sangT5/Test/NhanVien/edit?id=<?= htmlspecialchars($nhanvien['Ma_NV']) ?>" method="POST">
                        <div class="mb-3">
                            <label class="form-label">Tên NV:</label>
                            <input type="text" class="form-control" name="Ten_NV" value="<?= htmlspecialchars($nhanvien['Ten_NV']) ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Giới Tính:</label>
                            <select class="form-select" name="Phai">
                                <option value="NAM" <?= $nhanvien['Phai'] == 'NAM' ? 'selected' : '' ?>>Nam</option>
                                <option value="NU" <?= $nhanvien['Phai'] == 'NU' ? 'selected' : '' ?>>Nữ</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Nơi Sinh:</label>
                            <input type="text" class="form-control" name="Noi_Sinh" value="<?= htmlspecialchars($nhanvien['Noi_Sinh']) ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Lương:</label>
                            <input type="number" class="form-control" name="Luong" value="<?= htmlspecialchars($nhanvien['Luong']) ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Mã Phòng:</label>
                            <select class="form-select" name="Ma_Phong">
                                <?php foreach ($phongBans as $phong) : ?>
                                    <option value="<?= htmlspecialchars($phong['Ma_Phong']) ?>" <?= $nhanvien['Ma_Phong'] == $phong['Ma_Phong'] ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($phong['Ten_Phong']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="/sangT5/Test/NhanVien/indexAdmin" class="btn btn-secondary">Quay Lại</a>
                            <button type="submit" class="btn btn-primary">Lưu</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <?php include __DIR__ . '/../layouts/footer.php'; ?>
</body>

</html>