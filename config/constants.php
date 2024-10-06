<?php
    session_start();

    define('SITEURL', 'http://localhost/order-food/');
    define('LOCALHOST', 'localhost');
    define('DB_USERNAME','root');
    define('DB_PASSWORD','');
    define('DB_NAME','food-order');

    // Kết nối đến cơ sở dữ liệu
    $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error($conn));
    
    // Chọn cơ sở dữ liệu
    $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error($conn));
?>
