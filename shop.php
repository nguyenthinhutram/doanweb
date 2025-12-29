<?php
// shop.php
if (session_status() == PHP_SESSION_NONE) session_start();

require_once('config.php'); 
require_once('admin/models/Product.php'); 

global $conn;
$productModel = new Product($conn);

// 1. LẤY THAM SỐ TỪ URL
$category_id = isset($_GET['category']) ? (int)$_GET['category'] : null;
$search      = isset($_GET['search']) ? trim($_GET['search']) : '';
$sort        = isset($_GET['sort']) ? $_GET['sort'] : 'newest';

// 2. LẤY DỮ LIỆU
$categories = $productModel->getAllCategories();
$products   = $productModel->getAllProducts($category_id, $search, $sort);

// Tên danh mục hiện tại
$current_category_name = "Tất Cả Sản Phẩm";
if ($category_id) {
    foreach ($categories as $cat) {
        if ($cat['id'] == $category_id) {
            $current_category_name = $cat['name'];
            break;
        }
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Cửa hàng - Trang sức LTJ</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
    <link rel="stylesheet" href="style.css">
    <style>
        .product-item:hover { transform: translateY(-5px); transition: 0.3s; }
        .badge-discount { position: absolute; top: 10px; left: 10px; background-color: #dc3545; color: white; padding: 5px 10px; border-radius: 5px; font-weight: bold; z-index: 10; }
    </style>
</head>
<body>

<?php include('header.php'); ?> 
    
<div class="container-fluid page-header mb-5 py-5" style="background-color: #f7f7f7;">
    <div class="container text-center">
        <h1 class="display-6 fw-bold"><?php echo $current_category_name; ?></h1>
    </div>
</div>

<div class="container-fluid py-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-3">
                <div class="row g-4">
                    <div class="col-12">
                        <h4 class="mb-3 border-bottom pb-2">Tìm kiếm</h4>
                        <form action="shop.php" method="GET" class="d-flex mb-4">
                            <?php if($category_id): ?>
                                <input type="hidden" name="category" value="<?php echo $category_id; ?>">
                            <?php endif; ?>
                            <input type="hidden" name="sort" value="<?php echo $sort; ?>">
                            <input type="text" name="search" class="form-control me-2" placeholder="Nhập tên..." value="<?php echo htmlspecialchars($search); ?>">
                            <button type="submit" class="btn btn-dark"><i class="fa fa-search"></i></button>
                        </form>
                    </div>
                    <div class="col-12">
                        <h4 class="mb-3 border-bottom pb-2">Danh Mục</h4>
                        <div class="list-group mb-4">
                            <a href="shop.php?search=<?php echo urlencode($search); ?>&sort=<?php echo $sort; ?>" class="list-group-item list-group-item-action <?php echo !$category_id ? 'active' : ''; ?>">Tất Cả</a>
                            <?php foreach ($categories as $cat): ?>
                                <a href="shop.php?category=<?php echo $cat['id']; ?>&search=<?php echo urlencode($search); ?>&sort=<?php echo $sort; ?>" class="list-group-item list-group-item-action <?php echo $category_id == $cat['id'] ? 'active' : ''; ?>">
                                    <?php echo htmlspecialchars($cat['name']); ?>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-9">
                <div class="row g-4">
                    <?php if (!empty($products)): ?>
                        <?php foreach ($products as $product): ?>
                            <div class="col-md-6 col-lg-4">
                                <a href="shop-detail.php?id=<?php echo $product['id']; ?>" class="text-decoration-none text-dark">
                                    <div class="product-item h-100 border rounded overflow-hidden d-flex flex-column bg-white shadow-sm position-relative">
                                        
                                        <?php if (isset($product['discount_price']) && $product['discount_price'] > 0): ?>
                                            <div class="badge-discount">-<?php echo $product['discount_price']; ?>%</div>
                                        <?php endif; ?>

                                        <div class="product-img overflow-hidden">
                                            <img src="<?php echo htmlspecialchars($product['main_image']); ?>" 
                                                 class="img-fluid w-100" 
                                                 style="height: 280px; object-fit: cover;"
                                                 alt="<?php echo htmlspecialchars($product['name']); ?>">
                                        </div>
                                        
                                        <div class="p-4 d-flex flex-column flex-grow-1 text-center align-items-center">
                                            <h5 class="fw-bold mb-2"><?php echo htmlspecialchars($product['name']); ?></h5>
                                            <p class="text-muted small flex-grow-1 mb-3">
                                                <?php echo htmlspecialchars($product['short_description']); ?>
                                            </p>
                                            
                                            <div class="mt-auto">
                                                <?php if (isset($product['discount_price']) && $product['discount_price'] > 0): ?>
                                                    <?php 
                                                        $discounted_price = $product['price'] * (1 - ($product['discount_price'] / 100)); 
                                                    ?>
                                                    <p class="text-muted small text-decoration-line-through mb-0">
                                                        <?php echo number_format($product['price'], 0, ',', '.'); ?> đ
                                                    </p>
                                                    <p class="fs-5 fw-bold text-danger mb-0">
                                                        <?php echo number_format($discounted_price, 0, ',', '.'); ?> đ
                                                    </p>
                                                <?php else: ?>
                                                    <p class="fs-5 fw-bold text-dark mb-0">
                                                        <?php echo number_format($product['price'], 0, ',', '.'); ?> đ
                                                    </p>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="col-12 text-center py-5">
                            <h3 class="text-muted">Không tìm thấy sản phẩm nào.</h3>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>
</body>
</html>