<?php
// header.php
if (session_status() == PHP_SESSION_NONE) session_start();

$total_items = 0;
// KIỂM TRA CHẶT CHẼ: Phải là mảng và không trống mới duyệt
if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $item) {
        // Kiểm tra tiếp xem $item có phải mảng không
        if (is_array($item) && isset($item['qty'])) {
            $total_items += $item['qty'];
        }
    }
}
?>

<link rel="stylesheet" href="assets/icons/css/all.min.css">
<link rel="stylesheet" href="css/header.css">
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
<link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&family=Montserrat:wght@300;400;600&display=swap" rel="stylesheet">

<div id="spinner" class="show w-100 vh-100 bg-white position-fixed top-50 start-50 translate-middle d-flex align-items-center justify-content-center">
    <div class="spinner-grow text-primary" role="status"></div>
</div>

<div class="container-fluid fixed-top navbar-ltj-pastel">
    

    <div class="container px-0">
        <nav class="navbar navbar-light bg-white navbar-expand-xl">
            <a href="trangchu.php" class="logo-ltj"> 
                <h1 class="mb-0">
                    <span class="gold-logo-text"><i class="fas fa-gem"></i> LTJ</span>
                </h1>
            </a>
      
            <button class="navbar-toggler py-2 px-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="fa fa-bars text-dark"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav mx-auto">
                    <a href="trangchu.php" class="nav-item nav-link active">Trang chủ</a>
                    <a href="about.php" class="nav-item nav-link">Về chúng tôi</a>
                    
                    <div class="nav-item dropdown">
    <a href="shop.php" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Sản phẩm</a> 
    <div class="dropdown-menu m-0 bg-secondary rounded-0 border-0">
        <a href="shop.php?category=1" class="dropdown-item">Nhẫn</a>
        <a href="shop.php?category=3" class="dropdown-item">Bông tai</a>
        <a href="shop.php?category=2" class="dropdown-item">Dây chuyền</a>
        <a href="shop.php?category=4" class="dropdown-item">Lắc tay</a>
    </div>
                    </div>
                    <a href="contact.php" class="nav-item nav-link">Liên hệ</a>
                </div>

                <div class="d-flex align-items-center">
                    <button class="btn-search btn border border-secondary bg-white rounded-circle me-4" data-bs-toggle="modal" data-bs-target="#searchModal">
                        <i class="fas fa-search text-primary"></i>
                    </button>

                    <a href="cart.php" class="position-relative me-4">
                        <i class="fa fa-shopping-bag fa-2x text-dark"></i>
                        <?php if ($total_items > 0): ?>
                            <span class="position-absolute bg-secondary text-dark rounded-circle d-flex align-items-center justify-content-center"
                                  style="top:-5px; left:15px; height:20px; min-width:20px; font-weight: bold; font-size: 12px;">
                                <?php echo $total_items; ?>
                            </span>
                        <?php endif; ?>
                    </a>

                    <div class="nav-item dropdown my-auto"> 
                        <a href="#" class="nav-link p-0 dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="fas fa-user fa-2x text-dark"></i>
                        </a>
                        <div class="dropdown-menu m-0 rounded-0 bg-white shadow-sm border-0 dropdown-menu-end"> 
                            <?php if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true): ?>
                                <span class="dropdown-item disabled text-dark fw-bold">
                                    Chào, <?php echo htmlspecialchars($_SESSION["fullname"] ?? 'Bạn'); ?>
                                </span>
                                <div class="dropdown-divider"></div>
                                <a href="controllers/LoginController.php?action=logout" class="dropdown-item text-danger">Đăng xuất</a> 
                            <?php else: ?>
                                <a href="login.php" class="dropdown-item">Đăng nhập</a>
                                <a href="signup.php" class="dropdown-item">Đăng ký</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</div>

<div class="modal fade" id="searchModal" tabindex="-1">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content rounded-0">
            <div class="modal-header border-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body d-flex justify-content-center align-items-center">
                <div class="input-group w-50">
                    <input type="text" class="form-control p-3 border-secondary" placeholder="Nhập từ khóa tìm kiếm...">
                    <button class="btn btn-primary p-3 px-4"><i class="fa fa-search"></i></button>
                </div>
            </div>
        </div>
    </div>
</div>