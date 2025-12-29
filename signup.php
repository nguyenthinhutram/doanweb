<?php
if (session_status() == PHP_SESSION_NONE) session_start();
$errors = $_SESSION['errors'] ?? [];
$formData = $_SESSION['form_data'] ?? [];
$message = $_SESSION['message'] ?? null; // Lấy thông báo nếu có
unset($_SESSION['errors'], $_SESSION['form_data'], $_SESSION['message']);

function getVal($key) { global $formData; return htmlspecialchars($formData[$key] ?? ''); }
function errClass($key) { global $errors; return !empty($errors[$key]) ? 'is-invalid' : ''; }
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Đăng ký - Trang sức LTJ</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
    <link rel="stylesheet" href="style.css">
    <style>
        body.signup-page {
            background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('assets/imgs/banner/bg3.jpg');
            background-size: cover;
            background-position: center;
            min-height: 100vh;
            display: flex;
            align-items: center;
            padding: 40px 0;
        }
        .auth-card {
            background: rgba(255, 255, 255, 0.98);
            border-radius: 15px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.3);
            border: none;
            overflow: hidden;
        }
        .auth-header {
            background: #333;
            color: #F0E68C;
            padding: 25px;
            text-align: center;
        }
        .form-control:focus {
            border-color: #F0E68C;
            box-shadow: 0 0 0 0.25rem rgba(240, 230, 140, 0.25);
        }
        .btn-ltj {
    background: #1a1a1a; /* Đen sâu hơn */
    color: #c5a059;      /* Vàng đồng sang trọng */
    font-weight: 600;
    font-family: 'Montserrat', sans-serif; /* Font hiện đại */
    border: 1px solid #c5a059;
    padding: 12px 28px;
    text-transform: uppercase;
    letter-spacing: 2px; /* Khoảng cách chữ là chìa khóa của sự sang trọng */
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    border-radius: 0;    /* Góc vuông tạo cảm giác mạnh mẽ, cao cấp */
    position: relative;
    display: inline-block;
}

.btn-ltj:hover {
    background: #c5a059;
    color: #1a1a1a;
    border-color: #c5a059;
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15); /* Đổ bóng nhẹ khi di chuột */
    transform: translateY(-3px); /* Hiệu ứng nhấc nút nhẹ */
}
        .invalid-feedback { font-size: 0.75rem; }
    </style>
</head>
<body class="signup-page">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card auth-card shadow-lg">
                <div class="auth-header">
                    <h3 class="mb-0 text-uppercase" style="letter-spacing: 2px;">Đăng Ký Thành Viên</h3>
                    <small class="text-white-50">Gia nhập cộng đồng trang sức LTJ</small>
                </div>
                <div class="card-body p-4">
                    <?php if ($message): ?>
                        <div class="alert alert-<?= $message['type'] ?> alert-dismissible fade show" role="alert">
                            <?= $message['content'] ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>

                    <form action="controllers/SignupController.php" method="POST">
                        <input type="hidden" name="action" value="signup">

                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label class="small fw-bold">Họ và Tên</label>
                                <input type="text" name="fullname" class="form-control <?= errClass('fullname') ?> py-2" value="<?= getVal('fullname') ?>" placeholder="Nguyễn Văn A">
                                <div class="invalid-feedback"><?= $errors['fullname'] ?? '' ?></div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="small fw-bold">Email</label>
                                <input type="email" name="email" class="form-control <?= errClass('email') ?> py-2" value="<?= getVal('email') ?>" placeholder="vi-du@gmail.com">
                                <div class="invalid-feedback"><?= $errors['email'] ?? '' ?></div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="small fw-bold">Số điện thoại</label>
                                <input type="text" name="phoneNumber" class="form-control <?= errClass('phoneNumber') ?> py-2" value="<?= getVal('phoneNumber') ?>" placeholder="090...">
                                <div class="invalid-feedback"><?= $errors['phoneNumber'] ?? '' ?></div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="small fw-bold">Mật khẩu</label>
                                <input type="password" name="password" class="form-control <?= errClass('password') ?> py-2" placeholder="********">
                                <div class="invalid-feedback"><?= $errors['password'] ?? '' ?></div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <label class="small fw-bold">Xác nhận</label>
                                <input type="password" name="confirmPassword" class="form-control <?= errClass('confirmPassword') ?> py-2" placeholder="********">
                                <div class="invalid-feedback"><?= $errors['confirmPassword'] ?? '' ?></div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-ltj w-100 py-2 text-uppercase">Tạo tài khoản ngay</button>
                    </form>
                    
                    <div class="text-center mt-4 small">
                        Đã có tài khoản? <a href="login.php" class="text-dark fw-bold text-decoration-none" style="border-bottom: 2px solid #F0E68C;">Đăng nhập tại đây</a>
                    </div>
                </div>
            </div>
            <div class="text-center mt-3">
                <a href="trangchu.php" class="text-white-50 small text-decoration-none"><i class="fas fa-arrow-left"></i> Quay lại trang chủ</a>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>