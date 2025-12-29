<?php
// shop-detail.php
session_start();

require_once('config.php'); 
require_once('admin/models/Product.php'); 

global $conn;
$productModel = new Product($conn);

$product_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$product = $productModel->getProductById($product_id);

if (!$product) {
    header('Location: shop.php'); 
    exit;
}

// --- THIẾT LẬP CÁC BIẾN DỮ LIỆU ---
$id = $product['id'];
$name = $product['name'];
$description = $product['content'];
$short_desc = $product['short_description'];
$image_url = $product['main_image'];
$category_name = $product['category_name'];
$category_id = $product['category_id']; 
$stock_quantity = $product['stock_quantity'];

// --- LOGIC TÍNH GIÁ GIẢM ---
$original_price = (float)$product['price'];
$discount_percent = isset($product['discount_price']) ? (float)$product['discount_price'] : 0;

if ($discount_percent > 0 && $discount_percent < 100) {
    $final_price = $original_price * (1 - ($discount_percent / 100));
} else {
    $final_price = $original_price;
}

// Thông số mặc định (bạn có thể thay bằng dữ liệu từ DB nếu có cột tương ứng)
$material = "Vàng 18K/24K"; 
$stone = "Kim Cương Thiên Nhiên"; 
$weight = "3.5g";
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title><?php echo htmlspecialchars($name); ?> - Trang sức LTJ</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <style>
        .product-detail-gallery .main-image-container {
            background: #fff;
            border: 1px solid #f1f1f1;
        }
        .thumbnail-item {
            transition: all 0.3s ease;
            border: 1px solid #ddd;
        }
        .thumbnail-item.active {
            border: 2px solid #D4AF37 !important; /* Màu vàng Gold */
        }
        .text-primary { color: #D4AF37 !important; }
        .btn-primary { background-color: #D4AF37; border-color: #D4AF37; }
        .btn-primary:hover { background-color: #b8962d; border-color: #b8962d; }
    </style>
</head>
<body>
<?php include('header.php'); ?>
   
<div class="container-fluid page-header mb-5 py-5" style="background-color: #f7f7f7;">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="index.php">Trang chủ</a></li>
                <li class="breadcrumb-item"><a href="shop.php">Cửa hàng</a></li>
                <li class="breadcrumb-item active"><?php echo htmlspecialchars($name); ?></li>
            </ol>
        </nav>
    </div>
</div>
<div class="container py-5">
    <div class="row g-4"> <div class="col-lg-6">
            <div class="product-detail-gallery position-relative">
                <div class="main-image-container overflow-hidden rounded mb-4" style="height: 600px;">
                    <img id="main-product-image"
                         src="<?php echo htmlspecialchars($image_url); ?>"
                         class="img-fluid w-100 h-100"
                         style="object-fit: contain; transition: transform 0.4s ease;"
                         alt="<?php echo htmlspecialchars($name); ?>">
                </div>

                <div class="thumbnails-row d-flex justify-content-start gap-3 flex-wrap">
                    <div class="thumbnail-item active border border-2 border-primary rounded overflow-hidden" style="width: 110px; height: 110px; cursor: pointer;">
                        <img src="<?php echo htmlspecialchars($image_url); ?>" class="img-fluid w-100 h-100" style="object-fit: cover;" alt="Ảnh chính">
                    </div>

                    <?php if (!empty($product['image1'])): ?>
                        <div class="thumbnail-item border rounded overflow-hidden" style="width: 110px; height: 110px; cursor: pointer;">
                            <img src="<?php echo htmlspecialchars($product['image1']); ?>" class="img-fluid w-100 h-100" style="object-fit: cover;" alt="Góc phụ 1">
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($product['image2'])): ?>
                        <div class="thumbnail-item border rounded overflow-hidden" style="width: 110px; height: 110px; cursor: pointer;">
                            <img src="<?php echo htmlspecialchars($product['image2']); ?>" class="img-fluid w-100 h-100" style="object-fit: cover;" alt="Góc phụ 2">
                        </div>
                    <?php endif; ?>
                </div>
            </div>
             </div> <div class="col-lg-6">
            <h4 class="fw-bold mb-3"><?php echo htmlspecialchars($name); ?></h4>
            <p class="badge bg-secondary mb-3"><?php echo htmlspecialchars($category_name); ?></p>
            
            <div class="mb-3">
                <?php if ($discount_percent > 0): ?>
                    <span class="text-muted text-decoration-line-through fs-5 me-2">
                        <?php echo number_format($original_price, 0, ',', '.'); ?> VNĐ
                    </span>
                    <h4 class="fw-bold text-danger d-inline">
                        <?php echo number_format($final_price, 0, ',', '.'); ?> VNĐ
                    </h4>
                    <span class="badge bg-danger ms-2">-<?php echo $discount_percent; ?>%</span>
                <?php else: ?>
                    <h4 class="fw-bold text-primary">
                        <?php echo number_format($original_price, 0, ',', '.'); ?> VNĐ
                    </h4>
                <?php endif; ?>
            </div>
                <p class="mb-4 text-muted"><?php echo htmlspecialchars($short_desc); ?></p>
                
                <form method="POST" action="controllers/add_to_cart.php">
                    <input type="hidden" name="product_id" value="<?php echo $id; ?>">
                    
                    <div class="d-flex align-items-center mb-4">
                        <div class="input-group quantity me-3" style="width: 130px;">
                            <button type="button" class="btn btn-sm btn-minus rounded-circle bg-light border" onclick="var input = this.parentNode.querySelector('input'); if(input.value > 1) input.value--;">
                                <i class="fa fa-minus"></i>
                            </button>
                            <input type="number" name="quantity" class="form-control form-control-sm text-center border-0 bg-transparent" value="1" min="1">
                            <button type="button" class="btn btn-sm btn-plus rounded-circle bg-light border" onclick="var input = this.parentNode.querySelector('input'); input.value++;">
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>
                        
                        <button type="submit" class="btn border border-secondary rounded-pill px-4 py-2 text-primary shadow-sm" <?php echo $stock_quantity <= 0 ? 'disabled' : ''; ?>>
                            <i class="fa fa-shopping-bag me-2"></i> <?php echo $stock_quantity <= 0 ? 'Hết hàng' : 'Thêm vào Giỏ hàng'; ?>
                        </button>
                    </div>
                </form>

                <div class="tab-class my-5">
                    <ul class="nav nav-pills d-flex mb-3 border-bottom">
                        <li class="nav-item">
                            <a class="d-flex py-2 mx-2 active text-dark fw-bold" data-bs-toggle="pill" href="#tab-1">
                                Mô Tả Chi Tiết
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="d-flex py-2 mx-2 text-dark fw-bold" data-bs-toggle="pill" href="#tab-2">
                                Thông Số Kỹ Thuật
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div id="tab-1" class="tab-pane fade show p-0 active">
                            <div class="py-3">
                                <?php echo nl2br(htmlspecialchars($description)); ?>
                            </div>
                        </div>
                        <div id="tab-2" class="tab-pane fade p-0">
                            <div class="py-3">
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <th class="bg-light" style="width: 30%;">Đá Chính</th>
                                            <td><?php echo htmlspecialchars($stone); ?></td>
                                        </tr>
                                        <tr>
                                            <th class="bg-light">Chất liệu</th>
                                            <td><?php echo htmlspecialchars($material); ?></td>
                                        </tr>
                                        <tr>
                                            <th class="bg-light">Trọng lượng</th>
                                            <td><?php echo htmlspecialchars($weight); ?></td>
                                        </tr>
                                        <tr>
                                            <th class="bg-light">Mã Sản Phẩm</th>
                                            <td>LTJ-<?php echo $id; ?></td>
                                        </tr>
                                        <tr>
                                            <th class="bg-light">Tình trạng</th>
                                            <td><?php echo $stock_quantity > 0 ? 'Còn hàng ('.$stock_quantity.')' : '<span class="text-danger">Hết hàng</span>'; ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    document.querySelectorAll('.thumbnail-item').forEach(item => {
        item.addEventListener('click', function() {
            // Đổi ảnh chính
            const newSrc = this.querySelector('img').src;
            document.getElementById('main-product-image').src = newSrc;

            // Highlight thumbnail đang chọn
            document.querySelectorAll('.thumbnail-item').forEach(t => {
                t.classList.remove('active');
            });
            this.classList.add('active');
        });
    });
</script>
</body>
</html>