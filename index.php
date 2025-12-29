<?php
ob_start(); 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// 1. NHÚNG CẤU HÌNH (Tính từ thư mục admin/ lùi ra thư mục gốc)
require_once __DIR__ . '/../config.php'; 

// 2. NHÚNG CÁC CONTROLLERS
require_once __DIR__ . '/controllers/AdminController.php';
require_once __DIR__ . '/controllers/ProductController.php';
require_once __DIR__ . '/controllers/CategoryController.php';

// 3. KHỞI TẠO CÁC ĐỐI TƯỢNG CONTROLLER
// Lưu ý: AdminController và ProductController của bạn tự gọi kết nối bên trong
$adminController    = new AdminController();
$productController  = new ProductController();
// CategoryController cần biến $conn truyền vào constructor
$categoryController = new CategoryController($conn);

// 4. LẤY HÀNH ĐỘNG TỪ URL
$act = $_GET['act'] ?? 'dashboard';

// 5. XỬ LÝ LOGIC (CHẠY TRƯỚC LAYOUT ĐỂ REDIRECT KHÔNG LỖI)
switch ($act) {
    // User Actions
    case 'user-store':  $adminController->store(); exit;
    case 'user-update': $adminController->update(); exit;
    case 'user-delete': $adminController->delete(); exit;

    // Product Actions
    case 'product-store':  $productController->store(); exit;
    case 'product-update': $productController->update(); exit;
    case 'product-delete': $productController->delete(); exit;

    // Category Actions
    case 'category-store':  $categoryController->create(); exit;
    case 'category-update': $categoryController->edit(); exit;
    case 'category-delete': $categoryController->delete(); exit;
}

// 6. HIỂN THỊ GIAO DIỆN
// Nhúng Header (Đảm bảo trong header.php ĐÃ XÓA session_start và require config)
require_once __DIR__ . '/views/layout/header.php';

// Hiển thị Flash Message
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    $type = $message['type'] ?? 'info';
    $content = $message['content'] ?? '';
    echo "
    <div class='container-fluid px-4 mt-3'>
        <div class='alert alert-{$type} alert-dismissible fade show shadow-sm' role='alert'>
            <i class='fas fa-info-circle me-2'></i> {$content}
            <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
        </div>
    </div>";
    unset($_SESSION['message']);
}

echo '<div class="container-fluid px-4 py-3">';

// 7. ĐIỀU HƯỚNG VIEW (HIỂN THỊ NỘI DUNG)
switch ($act) {
    case 'dashboard':
        $adminController->dashboard();
        break;

    // --- QUẢN LÝ NGƯỜI DÙNG ---
    case 'users':
        $adminController->users();
        break;
    case 'user-create':
        $adminController->createForm();
        break;
    case 'user-edit':
        $adminController->editForm();
        break;

    // --- QUẢN LÝ SẢN PHẨM ---
    case 'products':
        $productController->index();
        break;
    case 'product-create':
        $productController->create();
        break;
    case 'product-edit':
        $productController->edit();
        break;

    // --- QUẢN LÝ DANH MỤC ---
    case 'categories':
        $categoryController->index();
        break;
    case 'category-create':
        // Nếu CategoryController chưa có hàm createForm riêng
        if (file_exists(__DIR__ . '/views/category/create.php')) {
            include __DIR__ . '/views/category/create.php';
        } else {
            $categoryController->create();
        }
        break;
    case 'category-edit':
        $categoryController->edit();
        break;

    default:
        $adminController->dashboard();
        break;
}

echo '</div>'; // Đóng container-fluid

// 8. NHÚNG FOOTER
if (file_exists(__DIR__ . '/views/layout/footer.php')) {
    require_once __DIR__ . '/views/layout/footer.php';
}

ob_end_flush();