<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Đăng ký - Trang sức LTJ</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="style.css">
    
    
</head>

<?php
// Giả định bạn có các file header.php và footer.php ở cùng cấp hoặc trong thư mục includes
include_once("header.php"); 
?>

<div class="container-fluid page-header mb-5 py-5" 
     style="background: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)), url('assets/imgs/banner/img3.jpg'); background-position: center center; background-repeat: no-repeat; background-size: cover;">
    
</div>        
<h1 class="mb-5 text-center text-dark">Liên Hệ Với Chúng Tôi</h1>
        
        <?php if (!empty($message_status)): ?>
            <div class="alert alert-success text-center" role="alert">
                <?php echo htmlspecialchars($message_status); ?>
            </div>
        <?php endif; ?>
        
        <div class="row g-5">
            
            <div class="col-xl-7 col-lg-7">
                <h3 class="mb-4 text-dark">Gửi Tin Nhắn Cho Chúng Tôi</h3>
                <form action="includes/contact_handler.inc.php" method="POST"> 
                    <div class="row g-3">
                        <div class="col-lg-6">
                            <input type="text" class="w-100 py-3 px-4 border rounded-pill" name="name" placeholder="Tên của bạn" required>
                        </div>
                        <div class="col-lg-6">
                            <input type="email" class="w-100 py-3 px-4 border rounded-pill" name="email" placeholder="Email của bạn" required>
                        </div>
                        <div class="col-lg-12">
                            <input type="text" class="w-100 py-3 px-4 border rounded-pill" name="subject" placeholder="Chủ đề">
                        </div>
                        <div class="col-12">
                            <textarea class="w-100 py-3 px-4 border rounded-pill" name="message" rows="6" cols="10" placeholder="Nội dung tin nhắn" required></textarea>
                        </div>
                        <div class="col-12">
                            <button class="btn btn-ltj-gold border-0 rounded-pill py-3 px-5 text-dark" type="submit" name="submit_contact">
                                Gửi tin nhắn
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            
            <div class="col-xl-5 col-lg-5">
                <h3 class="mb-4 text-dark">Thông Tin Chi Tiết</h3>
                <div class="bg-light p-4 rounded mb-4">
                    <div class="d-flex align-items-center mb-4">
                        <i class="fa fa-map-marker-alt fa-2x text-ltj-gold me-4"></i>
                        <div>
                            <h5 class="mb-2 text-dark">Địa chỉ</h5>
                            <p class="mb-0 text-dark">123 Bà Nà, Đà Nẵng, Việt Nam</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-center mb-4">
                        <i class="fa fa-envelope-open fa-2x text-ltj-gold me-4"></i>
                        <div>
                            <h5 class="mb-2 text-dark">Email</h5>
                            <p class="mb-0 text-dark">LTJewelty@gmail.com</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-center mb-4">
                        <i class="fa fa-phone-alt fa-2x text-ltj-gold me-4"></i>
                        <div>
                            <h5 class="mb-2 text-dark">Điện thoại</h5>
                            <p class="mb-0 text-dark">+0779406607</p>
                        </div>
                    </div>
                </div>

                <div class="rounded overflow-hidden">
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15335.539869279581!2d108.20455589999999!3d16.07185505!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3142197779953d3d%3A0x6b772c726d11598!2zQmEgTsOgLCBI4bqjaSBDaMOidSwgxJBhIE7hurVuZywgVmll1yBOYW0!5e0!3m2!1svi!2s!4v1701100000000!5m2!1svi!2s" 
                        width="100%" 
                        height="350" 
                        style="border:0;" 
                        allowfullscreen="" 
                        loading="lazy" 
                        referrerpolicy="no-referrer-when-downgrade"
                    ></iframe>
                </div>
            </div>
            
        </div>
    </div>
</div>
<?php
include_once("footer.php");
?>