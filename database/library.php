<?php
    function checkLogin($conn, $username, $password) {
    // Kiểm tra xem email đã tồn tại trong cơ sở dữ liệu chưa
    $user_check_query = "SELECT * FROM user WHERE user='$username' LIMIT 1";
    $result = mysqli_query($conn, $user_check_query);
    $user = mysqli_fetch_assoc($result);

    if ($username && $password($username['username'], $password['password'])) { // Nếu tài khoản và mật khẩu đúng
        if ($user['role'] == 0) { // Kiểm tra role của user
            header("Location: admin/index.php"); // Chuyển hướng trang
            exit();
        } else {
            echo "Bạn không đủ quyền truy cập"; // Hiển thị thông báo lỗi
        }
    } else {
        echo "Tài khoản hoặc mật khẩu không đúng";
    }
    // Đóng kết nối
    mysqli_close($conn);
    }
    
    //kiểm tra xem đã đăng nhập chưa
    function check_login() {
        if (session_status() == PHP_SESSION_NONE) {
          session_start();
        }
        if(!isset($_SESSION['username'])) {
          header('Location: ../index.php');
          exit();
        }
      }
      
    
?>
