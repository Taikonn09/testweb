<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/signup.css">
    <title>Signup</title>
</head>

<body>
    <div class="container">
        <form class="form-signup" method="POST">
            <h1 class="form-signup-heading">Đăng ký</h1>
            <div class="form-group">
                <label for="fullname" class="sr-only">Tên đăng nhập</label>
                <input type="text" id="fullname" class="form-control" placeholder="Tên đăng nhập" name="username" required autofocus>
            </div>
            <div class="form-group">
                <label for="email" class="sr-only">Email</label>
                <input type="email" id="email" class="form-control" placeholder="Email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password" class="sr-only">Mật khẩu</label>
                <input type="password" id="password" class="form-control" placeholder="Mật khẩu" name="password" required>
            </div>
            <div class="form-group">
                <label for="password-confirm" class="sr-only">Xác nhận mật khẩu</label>
                <input type="password" id="password-confirm" class="form-control" placeholder="Xác nhận mật khẩu" required>
            </div>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Đăng ký</button>
            <p class="login-link">Đã có tài khoản? <a href="index.php">Đăng nhập</a></p>
        </form>
    </div>
<?php
    include "database/connectDB.php";
?>

<?php

// Kiểm tra xem đã submit form hay chưa
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lấy dữ liệu từ form đăng ký
    $username = $_POST['username'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    // Kiểm tra xem tên đăng nhập đã tồn tại trong cơ sở dữ liệu chưa
    $sql_check_user = "SELECT * FROM user WHERE email = '$email'";
    $result_check_user = mysqli_query($conn, $sql_check_user);

    if (mysqli_num_rows($result_check_user) > 0) {
        // Nếu tên đăng nhập đã tồn tại, hiển thị thông báo lỗi
        echo "Email đã tồn tại";
    } else {
        // Nếu tên đăng nhập chưa tồn tại, thêm thông tin người dùng vào cơ sở dữ liệu
        $sql_add_user = "INSERT INTO user (username, password, email, role) VALUES ('$username', '$password', '$email', '1')";
        $result_add_user = mysqli_query($conn, $sql_add_user);

        if ($result_add_user) {
            // Nếu thêm thông tin người dùng thành công, hiển thị thông báo đăng ký thành công
            echo '<script>alert("Đăng ký thành công"); window.location.href = "index.php";</script>';
        } else {
            // Nếu thêm thông tin người dùng thất bại, hiển thị thông báo lỗi
            echo "Đăng ký thất bại";
        }
    }
}
// Đóng kết nối
mysqli_close($conn);
?>

</body>

</html>