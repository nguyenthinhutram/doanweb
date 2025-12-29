<?php
// cart.php
if (session_status() == PHP_SESSION_NONE) session_start();

$total_money = 0;
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Giỏ hàng - Trang sức LTJ</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
    <link rel="stylesheet" href="style.css">
    <style>
        /* Tùy chỉnh thêm để tăng độ sang trọng */
        .table thead th {
            border: none;
            text-transform: uppercase;
            font-size: 0.9rem;
            letter-spacing: 1px;
        }
        .cart-item-name {
            font-weight: 600;
            color: #333;
            text-decoration: none;
        }
        .cart-item-name:hover { color: #F0E68C; }
        .btn-update { border: 1px solid #ddd; background: #fff; }
        .btn-update:hover { background: #f8f9fa; }
    </style>
</head>
<body>

<?php include('header.php'); ?>

<div class="container-fluid page-header mb-5 py-5" 
     style="background: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)), url('assets/imgs/banner/bg3.jpg'); background-position: center center; background-repeat: no-repeat; background-size: cover;">
    
</div>
<div class="container-fluid py-5">
    <div class="container py-5">
        <div class="table-responsive">
            <form action="controllers/CartController.php?action=update" method="POST">
                <table class="table text-center align-middle border-bottom">
                    <thead class="bg-light text-muted">
                        <tr>
                            <th scope="col">Sản phẩm</th>
                            <th scope="col" class="text-start">Tên</th>
                            <th scope="col">Giá</th>
                            <th scope="col" style="width: 150px;">Số lượng</th>
                            <th scope="col">Thành tiền</th>
                            <th scope="col">Xóa</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])): ?>
                            <?php foreach ($_SESSION['cart'] as $id => $item): 
                                $name  = $item['name'] ?? 'Sản phẩm';
                                $price = (float)($item['price'] ?? 0);
                                $qty   = (int)($item['qty'] ?? 1);
                                $img   = $item['img'] ?? '';
                                $subtotal = $price * $qty;
                                $total_money += $subtotal;
                            ?>
                                <tr>
                                    <td>
                                        <img src="<?php echo htmlspecialchars($img); ?>" class="img-fluid rounded shadow-sm" style="width: 70px; height: 70px; object-fit: cover;" alt="">
                                    </td>
                                    <td class="text-start">
                                        <a href="shop-detail.php?id=<?php echo $id; ?>" class="cart-item-name"><?php echo htmlspecialchars($name); ?></a>
                                    </td>
                                    <td><?php echo number_format($price, 0, ',', '.'); ?>đ</td>
                                    <td>
                                        <input type="number" name="qty[<?php echo $id; ?>]" class="form-control mx-auto text-center shadow-sm" value="<?php echo $qty; ?>" min="1">
                                    </td>
                                    <td class="text-primary fw-bold"><?php echo number_format($subtotal, 0, ',', '.'); ?>đ</td>
                                    <td>
                                        <a href="controllers/CartController.php?action=delete&id=<?php echo $id; ?>" class="btn btn-sm text-danger" >
                                            <i class="fa fa-trash-alt"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="py-5 text-center">
                                    <div class="mb-4"><i class="fas fa-shopping-bag fa-4x text-light"></i></div>
                                    <p class="h5 text-muted">Giỏ hàng đang trống!</p>
                                    <a href="shop.php" class="btn btn-primary px-5 py-2 mt-3 rounded-pill">MUA SẮM NGAY</a>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>

                <?php if (!empty($_SESSION['cart'])): ?>
                    <div class="row g-4 justify-content-end mt-4">
                        <div class="col-12 col-md-5 col-lg-4">
                            <div class="bg-light rounded p-4 shadow-sm">
                                <div class="row g-2 mb-4">
                                    <div class="col-6">
                                        <a href="shop.php" class="btn btn-outline-dark w-100 py-2" style="font-size: 0.9rem;">
                                            <i class="fas fa-plus me-1"></i> Chọn thêm sản phẩm khác
                                        </a>
                                    </div>
                                    <div class="col-6">
                                        <button type="submit" class="btn btn-update w-100 py-2" style="font-size: 0.9rem;">
                                            <i class="fas fa-sync-alt me-1"></i> Cập nhật
                                        </button>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between mb-3">
                                    <span class="text-muted">Tạm tính:</span>
                                    <span><?php echo number_format($total_money, 0, ',', '.'); ?> VNĐ</span>
                                </div>
                                <div class="border-top pt-3">
                                    <div class="d-flex justify-content-between mb-4">
                                        <h5 class="mb-0">Tổng cộng:</h5>
                                        <h5 class="text-primary"><?php echo number_format($total_money, 0, ',', '.'); ?> VNĐ</h5>
                                    </div>
                                    <a href="checkout.php" class="btn btn-primary w-100 py-3 text-uppercase fw-bold shadow">Tiến hành thanh toán</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </form>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>
</body>
</html>