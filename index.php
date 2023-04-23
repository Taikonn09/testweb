<?php
    include "database/connectDB.php";
    // include "database/library.php";
?>
<?php
// Kiểm tra nếu có dữ liệu submit đi
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Kết nối cơ sở dữ liệu
    $conn = mysqli_connect('localhost', 'root', '', 'website_demo');

    // Kiểm tra kết nối
    if (!$conn) {
        die("Kết nối thất bại: " . mysqli_connect_error());
    }

    // Thực hiện truy vấn kiểm tra tài khoản
    $sql = "SELECT * FROM user WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $sql);

    // Kiểm tra kết quả truy vấn
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        // Kiểm tra user_role của tài khoản
        if ($row['role'] == 0) {
            // Tài khoản có quyền truy cập, thực hiện đăng nhập
            session_start();
            $_SESSION['username'] = $username;
            $_SESSION['role'] = $row['role'];
            header("Location: admin/index.php");
            exit();
        } else {
            // Tài khoản không có quyền truy cập
            echo "Tài khoản không có quyền truy cập";
        }
    } else {
        // Tài khoản đăng nhập sai
        echo "Sai tài khoản hoặc mật khẩu";
    }

    // Đóng kết nối
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/index.css">
    <title>Login</title>
</head>

<body>
    <form method="POST">
        <h2>Login</h2>
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username"><br>
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password"><br>
        <p>Chưa có tài khoản? <a href="signup.php">Đăng ký</a></p>
        <button type="submit">Login</button>
    </form>
</body>

</html>