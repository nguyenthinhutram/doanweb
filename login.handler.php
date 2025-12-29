
<?php
if (isset($_POST["login"])) {
    // Bắt đầu session ở đầu script handler
    if (session_status() == PHP_SESSION_NONE) session_start();

    // 1. Kiểm tra nếu đã đăng nhập thì chuyển hướng (Dùng cho trường hợp không gọi AJAX)
    if (isset($_SESSION["id"]) && isset($_SESSION["useremail"])) {
        // Trả về mã lỗi cho AJAX nếu đã đăng nhập
        echo "alreadyloggedin"; 
        exit();
    }

    // 2. Nhúng các file (THAY ĐỔI ĐƯỜNG DẪN NẾU CẦN)
    include_once("server/connection/connect.s.php"); 
    include_once("server/models/loginmodel.s.php"); 
    include_once("server/controllers/logincontr.s.php"); 

    // 3. Lấy dữ liệu
    $useremail = $_POST["useremail"]; 
    $password = $_POST["password"];

    $login = new LoginController($useremail, $password);
    
    // Thực hiện đăng nhập. Nếu thành công, SESSION đã được set trong Model.
    // Nếu lỗi, Model/Controller đã echo mã lỗi và exit()
    $login->loginUser();

    // 4. Nếu đến được đây, đăng nhập thành công. Kiểm tra quyền và trả về mã.
    if (isset($_SESSION["role_id"])) {
        if ($_SESSION["role_id"] == 3) { // Khách hàng
            echo 2; 
            exit();
        } else { // Admin/Staff (role_id 1 hoặc 2)
            echo 1; 
            exit();
        }
    } else {
        echo "unknownerror";
        exit();
    }
}
// Nếu truy cập trực tiếp file này mà không qua form POST
else {
    header("location: login.php?error=notallowed");
    exit();
}