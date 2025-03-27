<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Đăng Nhập</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>

<body>
    <?php include __DIR__ . '../layouts/header.php'; ?>
    <div class="container">
        <div class="login-container" style="max-width: 400px; margin: 100px auto; padding: 30px; background: white; border-radius: 10px; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);">
            <h2 class="text-center">Đăng Nhập</h2>
            <form method="POST" action="index.php?url=auth/login">
                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Mật khẩu:</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Đăng Nhập</button>
            </form>

        </div>
    </div>
    <?php include __DIR__ . '../layouts/footer.php'; ?>
</body>

</html>