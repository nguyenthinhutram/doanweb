<?php
define('DB_SERVER', 'localhost'); 
define('DB_USERNAME', 'root');   
define('DB_PASSWORD', ''); 
define('DB_NAME', 'trangsuc'); 
define('DB_PORT', 3307); 

$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME, DB_PORT);
if($conn->connect_error){
 die("LỖI: Không thể kết nối CSDL. " . $conn->connect_error);
}

$conn->set_charset("utf8mb4");
