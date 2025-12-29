<?php
if (session_status() == PHP_SESSION_NONE) session_start();
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Trang sức LTJ</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
<link href="https://fonts.googleapis.cóm/css2?family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    <!-- Google Fonts -->

    <!-- Icons -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Local CSS from your uploaded file -->
    <link rel="stylesheet" href="style.css">

    
</head>
<?php
// Tùy thuộc vào vị trí, nếu footer.php nằm trong thư mục includes/
require_once('header.php'); 

?>
       
    <!-- HERO BANNER -->
    <div class="container-fluid py-5 mb-5 hero-header">
        <div class="container py-5">
            <div class="row g-5 align-items-center">
                <div class="col-lg-7">
                    <div class="position-relative">
                       
                       
                    </div>
                </div>

               
            </div>
        </div>
    </div>

    <!-- CATEGORY -->
    <div class="container-fluid fruite py-5" style="background: #fff;">
    <div class="container">
        <div class="text-center mb-5">
            <h1 class="display-4 text-uppercase" style="font-family: 'Playfair Display', serif;">Sản phẩm nổi bật</h1>
            <div class="section-divider"></div> </div>

        <div class="row g-4">
            <?php
            // 1. Kết nối CSDL (Thay đổi thông số nếu cần)
            $conn = new mysqli("localhost", "root", "", "trangsuc", 3307);

            if ($conn->connect_error) {
                die("Kết nối thất bại: " . $conn->connect_error);
            }

            // 2. Truy vấn lấy 4 sản phẩm mới nhất hoặc đang hoạt động
            $sql = "SELECT * FROM product WHERE isDeleted = 0 AND status = 1 ORDER BY created_at DESC LIMIT 4";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    // Xử lý đường dẫn ảnh (loại bỏ ../ nếu có để phù hợp với trang chủ)
                    $image_path = str_replace('../', '', $row['main_image']);
                    ?>
                    <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                        <div class="product-item shadow-sm h-100 d-flex flex-column"> <div class="product-img">
                                <img src="<?php echo $image_path; ?>" class="img-fluid" alt="<?php echo $row['name']; ?>">
                            </div>
        
                            <div class="p-4 d-flex flex-column flex-grow-1"> <h4 class="product-name"><?php echo $row['name']; ?></h4>
            
                                <div class="mt-auto text-center"> 
                                    <p class="text-dark fs-5 fw-bold mb-3">
                                        <?php echo number_format($row['price'], 0, ',', '.'); ?> VNĐ
                                    </p>
                                    <a href="shop-detail.php?id=<?php echo $row['id']; ?>" class="btn btn-add-to-cart w-100">
                                        Xem chi tiết
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo "<p class='text-center'>Hiện chưa có sản phẩm nào nổi bật.</p>";
            }
            $conn->close();
            ?>
        </div>
    </div>
</div>

    <!-- BANNER OFFER -->
    <div class="container-fluid banner py-5 my-5" style="background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('assets/imgs/banner-jewelry.jpg'); background-size: cover; background-position: center;">
    <div class="container text-center py-5">
        <h1 class="display-3 text-white mb-4" style="font-family: 'Playfair Display', serif;">BỘ SƯU TẬP TUYỆT TÁC</h1>
        <p class="text-ltj-gold fs-4 fw-light mb-5" style="letter-spacing: 3px;">Ưu đãi độc quyền lên đến 40% trong tháng này</p>
        <a href="shop.php" class="btn btn-primary px-5 py-3">
            Khám phá ngay <i class="fas fa-chevron-right ms-2" style="font-size: 0.8rem;"></i>
        </a>
    </div>
    </div>

    <!-- FEATURES -->
    <div class="container-fluid py-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-3 col-sm-6">
                <div class="value-box h-100 shadow-sm border-0">
                    <div class="value-icon">
                        <i class="fa fa-gem"></i>
                    </div>
                    <h4>Tuyệt Tác Trang Sức</h4>
                    <p>Mỗi thiết kế là một câu chuyện riêng, được chế tác tỉ mỉ bởi nghệ nhân lành nghề.</p>
                </div>
            </div>

            <div class="col-lg-3 col-sm-6">
                <div class="value-box h-100 shadow-sm border-0">
                    <div class="value-icon">
                        <i class="fa fa-shuttle-van"></i>
                    </div>
                    <h4>Giao Hàng Bảo Mật</h4>
                    <p>Miễn phí vận chuyển và bảo hiểm 100% giá trị sản phẩm tận tay bạn.</p>
                </div>
            </div>

            <div class="col-lg-3 col-sm-6">
                <div class="value-box h-100 shadow-sm border-0">
                    <div class="value-icon">
                        <i class="fa fa-fingerprint"></i>
                    </div>
                    <h4>Chứng Nhận GIA</h4>
                    <p>Cam kết chất lượng kim cương và đá quý với giấy chứng nhận quốc tế uy tín.</p>
                </div>
            </div>

            <div class="col-lg-3 col-sm-6">
                <div class="value-box h-100 shadow-sm border-0">
                    <div class="value-icon">
                        <i class="fa fa-award"></i>
                    </div>
                    <h4>Bảo Hành Trọn Đời</h4>
                    <p>Dịch vụ làm sạch và bảo dưỡng miễn phí định kỳ cho mọi sản phẩm.</p>
                </div>
            </div>
        </div>
    </div>
</div>


    <!-- Back to Top -->
    <a href="#" class="btn btn-primary rounded-circle back-to-top">
        <i class="fa fa-arrow-up"></i>
    </a>

    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        $(window).on('load', function () {
            $("#spinner").removeClass("show");
        });
    </script>
<?php

require_once('footer.php'); 

?>
</body>

</html>
