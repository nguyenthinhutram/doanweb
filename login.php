<?php
if (session_status() == PHP_SESSION_NONE) session_start();
$message = $_SESSION['message'] ?? null;
unset($_SESSION['message']);
$old_useremail = $_SESSION['old_useremail'] ?? '';
unset($_SESSION['old_useremail']);
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Đăng nhập - Trang sức LTJ</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
    <link rel="stylesheet" href="style.css">
    <style>
        body.login-page {
            background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('assets/imgs/banner/bg3.jpg');
            background-size: cover;
            background-position: center;
            min-height: 100vh;
            display: flex;
            align-items: center;
        }
        .auth-card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.2);
            border: none;
            overflow: hidden;
        }
        .auth-header {
            background: #333;
            color: #F0E68C;
            padding: 30px;
            text-align: center;
        }
        .form-control:focus {
            border-color: #F0E68C;
            box-shadow: 0 0 0 0.25 row rgba(240, 230, 140, 0.25);
        }
        .btn-ltj {
            background: #333;
            color: #F0E68C;
            border: 1px solid #333;
            font-weight: bold;
            transition: 0.3s;
        }
        .btn-ltj:hover {
            background: #F0E68C;
            color: #333;
            border-color: #F0E68C;
        }
    </style>
</head>

<body class="login-page">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5 col-lg-4">
            <div class="card auth-card">
                <div class="auth-header">
                    <h3 class="mb-0 text-uppercase" style="letter-spacing: 2px;">Đăng Nhập</h3>
                    <small class="text-white-50">Chào mừng bạn quay lại với LTJ</small>
                </div>
                
                <div class="card-body p-4">
                    <?php if ($message): ?>
                        <div class="alert alert-<?= $message['type'] ?> alert-dismissible fade show" role="alert">
                            <?= $message['content'] ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>
<form action="controllers/LoginController.php" method="POST">
    <input type="hidden" name="action" value="login"> 

    <div class="mb-3">
        <label class="form-label small fw-bold">Email</label>
        <input type="text" name="useremail" class="form-control py-2" value="<?= htmlspecialchars($old_useremail) ?>" required placeholder="Nhập tài khoản...">
    </div>
 
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Mật khẩu</label>
                            <input type="password" name="password" class="form-control py-2" required placeholder="********">
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="remember">
                                <label class="form-check-label small" for="remember">Ghi nhớ</label>
                            </div>
                            <a href="#" class="text-muted small text-decoration-none">Quên mật khẩu?</a>
                        </div>
                        <button type="submit" class="btn btn-ltj w-100 py-2 text-uppercase">Đăng nhập ngay</button>
                    </form>
                    <div class="text-center mt-4 small">
                        Bạn mới đến LTJ? <a href="signup.php" class="text-dark fw-bold text-decoration-none" style="border-bottom: 2px solid #F0E68C;">Đăng ký tài khoản</a>
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