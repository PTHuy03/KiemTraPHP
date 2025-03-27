<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý sản phẩm</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="/sangT5/Test/NhanVien">Trang chủ</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a class="nav-link" href="/sangT5/Test/NhanVien">Nhân viên</a></li>
                    <li class="nav-item"><a class="nav-link" href="/sangT5/Test/NhanVien/indexAdmin">Quản lý nhân viên</a></li>
                </ul>
                <ul class="navbar-nav">
                    <?php if (isset($_SESSION['user'])) : ?>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Xin chào, <?php echo $_SESSION['user']['fullname']; ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link btn btn-danger text-white" href="/sangT5/Test/Auth/logout">Đăng xuất</a>
                        </li>
                    <?php else : ?>
                        <li class="nav-item">
                            <a class="nav-link btn btn-primary text-white" href="/sangT5/Test/Auth">Đăng nhập</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>