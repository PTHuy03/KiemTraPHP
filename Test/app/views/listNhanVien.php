<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh Sách Nhân Viên</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="public/css/style.css">
</head>

<body>
    <?php include __DIR__ . '../layouts/header.php'; ?>

    <div class="container mt-4">
        <h2 class="text-center mb-4">Danh Sách Nhân Viên</h2>
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Mã Nhân Viên</th>
                        <th>Tên Nhân Viên</th>
                        <th>Giới Tính</th>
                        <th>Nơi Sinh</th>
                        <th>Tên Phòng</th>
                        <th>Lương</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($nhanviens as $nv): ?>
                        <tr>
                            <td><?= $nv['Ma_NV'] ?></td>
                            <td><?= $nv['Ten_NV'] ?></td>
                            <td class="text-center">
                                <img src="public/images/<?= $nv['Phai'] == 'NU' ? 'woman.jpg' : 'man.jpg' ?>" width="40" class="rounded-circle">
                            </td>
                            <td><?= $nv['Noi_Sinh'] ?></td>
                            <td><?= $nv['Ten_Phong'] ?></td>
                            <td><?= number_format($nv['Luong']) ?> VND</td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Phân trang -->
        <?php if (!empty($totalPages) && $totalPages > 1): ?>
            <nav aria-label="Page navigation">
                <ul class="pagination justify-content-center">
                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                        <li class="page-item <?= (isset($_GET['page']) && $_GET['page'] == $i) ? 'active' : '' ?>">
                            <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                        </li>
                    <?php endfor; ?>
                </ul>
            </nav>
        <?php endif; ?>

    </div>

    <?php include __DIR__ . '../layouts/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>