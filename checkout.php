<?php
if (session_status() == PHP_SESSION_NONE) session_start();
require_once('config.php');
require_once('models/Order.php');

// 1. Kiểm tra giỏ hàng - Nếu trống thì không cho thanh toán
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    header("Location: shop.php");
    exit();
}

// 2. Lấy thông tin từ SESSION (đã lưu khi đăng nhập)
// Lưu ý: Key phải khớp với code ở LoginController của bạn
$userId    = $_SESSION['user_id'] ?? null;
$fullname  = $_SESSION['fullname'] ?? '';
$email     = $_SESSION['email'] ?? '';
$phone     = $_SESSION['phone_number'] ?? ''; // Đổi thành 'phone' nếu login bạn lưu là $_SESSION['phone']

$total_money = 0;
foreach ($_SESSION['cart'] as $item) {
    $total_money += $item['price'] * $item['qty'];
}

// 3. Xử lý khi nhấn nút đặt hàng (POST)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $orderModel = new Order($conn);
    
    // Nhận dữ liệu từ form (khách có thể sửa lại thông tin mặc định nếu muốn)
    $f_name    = $_POST['fullname'];
    $f_phone   = $_POST['phone_number'];
    $f_address = $_POST['address'];
    $f_note    = $_POST['note'];

    // Lưu đơn hàng vào Database thông qua Model
    $orderId = $orderModel->saveOrder($userId, $f_name, $f_phone, $f_address, $f_note, $total_money, $_SESSION['cart']);

    if ($orderId) {
        unset($_SESSION['cart']); // Xóa sạch giỏ hàng sau khi mua thành công
        echo "<script>alert('Đặt hàng thành công! Mã đơn của bạn là: #$orderId'); window.location.href='index.php';</script>";
        exit();
    } else {
        $error = "Có lỗi xảy ra trong quá trình lưu đơn hàng. Vui lòng thử lại!";
    }
}
?>

<!doctype html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <title>Thanh toán - LTJ Jewelry</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
  
<?php
// Giả định bạn có các file header.php và footer.php ở cùng cấp hoặc trong thư mục includes
include_once("header.php"); 
?>

    <div class="container-fluid page-header mb-5 py-5" 
         style="background: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)), url('assets/imgs/banner/img3.jpg'); background-position: center center; background-repeat: no-repeat; background-size: cover;">
        <h1 class="text-center text-white display-6">Thanh Toán</h1>
    </div>   

    <div class="container py-5 mt-5">
        <div class="row">
            <div class="col-md-7">
                <div class="card shadow-sm p-4 border-0">
                    <h4 class="mb-4 fw-bold text-uppercase">Thông tin giao hàng</h4>
                    
                    <?php if(isset($error)): ?>
                        <div class="alert alert-danger"><?= $error ?></div>
                    <?php endif; ?>
                    
                    <form action="" method="POST">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Họ tên người nhận</label>
                            <input type="text" name="fullname" class="form-control" 
                                   value="<?= htmlspecialchars($fullname) ?>" 
                                   placeholder="Nhập họ tên người nhận" required>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Số điện thoại</label>
                                <input type="text" name="phone_number" class="form-control" 
                                       value="<?= htmlspecialchars($phone) ?>" 
                                       placeholder="Số điện thoại liên lạc" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Email</label>
                                <input type="email" name="email" class="form-control" 
                                       value="<?= htmlspecialchars($email) ?>" 
                                       placeholder="Địa chỉ email" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Địa chỉ chi tiết</label>
                            <textarea name="address" class="form-control" rows="3" 
                                      placeholder="Số nhà, tên đường, phường/xã..." required></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Ghi chú</label>
                            <textarea name="note" class="form-control" rows="2" 
                                      placeholder="Ghi chú về thời gian giao hàng, chỉ dẫn đường đi..."></textarea>
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary w-100 py-3 fw-bold text-uppercase shadow">
                                <i class="fas fa-check-circle me-2"></i>Hoàn tất đặt hàng
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-md-5">
                <div class="card shadow-sm p-4 border-0 bg-light sticky-top" style="top: 100px;">
                    <h4 class="mb-4 fw-bold text-uppercase text-center">Đơn hàng của bạn</h4>
                    <div class="table-responsive">
                        <table class="table align-middle">
                            <tbody>
                                <?php foreach ($_SESSION['cart'] as $item): ?>
                                <tr>
                                    <td>
                                       <td>
    <div class="d-flex align-items-center">
        <img src="<?= htmlspecialchars($item['img']) ?>" alt="" style="width: 50px; height: 50px; object-fit: cover;" class="rounded me-3">
        <div>
            <p class="mb-0 fw-bold"><?= htmlspecialchars($item['name']) ?></p>
            <small class="text-muted">SL: x<?= $item['qty'] ?></small>
        </div>
    </div>
</td>
                                    <td class="text-end fw-bold">
                                        <?= number_format($item['price'] * $item['qty'], 0, ',', '.') ?>đ
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                            <tfoot class="border-top">
                                <tr>
                                    <td class="pt-3 fw-bold fs-5">TỔNG TIỀN:</td>
                                    <td class="pt-3 text-end text-danger fw-bold fs-4">
                                        <?= number_format($total_money, 0, ',', '.') ?>đ
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div class="p-3 bg-white border rounded mt-3">
                        <p class="mb-1 small text-muted"><i class="fas fa-truck me-2"></i>Miễn phí vận chuyển toàn quốc</p>
                        <p class="mb-0 small text-muted"><i class="fas fa-shield-alt me-2"></i>Bảo hành trang sức trọn đời</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include('footer.php'); ?>
</body>
</html>