<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<title>Trang quản trị</title>
	<link rel="stylesheet" href="css/adminCSS.css">
</head>
<?php
include "../database/connectDB.php";
include "../database/library.php";
?>

<body>
	<header id="header-admin">
		<a href="index.php">
			<img src="../images/logo.jpg" alt="logo">
		</a>
		<h1 class="heading-title-page">Chào mừng đến với AIO</h1>

		<div class="header-right">
			<img id="admin-img" src="../images/admin.png" alt="admin-img">
			<div id="admin-name" class="admin-name">
				<?php
				session_start();
				// Kiểm tra xem đã đăng nhập chưa
				require_once('../database/library.php');
				check_login();
				// Hiển thị câu chào mừng
				echo $_SESSION['username'] . '<i class="fa-solid fa-chevron-down icon-right-name"></i>';
				?>
			</div>
			<a id="logout-link" class="logout-admin hidden" href="logout.php">
				<p>logout</p>
				<i style="margin-left: 5px;" class="fa-solid fa-right-from-bracket"></i>
			</a>
		</div>

	</header>

	<main id="main-page">
		<section id="slider">
			<ul class="navbar-nav">
				<li class="nav-item">
					<a href="index.php">
						<i class="fa-solid fa-house"></i>
						Trang chủ
					</a>
				</li>
				<li class="nav-item">
					<a href="#" class="dropdown-toggle">
						<i class="fa-brands fa-windows"></i>
						Quản lý sản phẩm <i class="fa-solid fa-chevron-down icon-right-name"></i>
					</a>
					<ul class="dropdown-menu">
						<li class="dropdown-menu-item"><a href="categoryAD/index.php">Thêm loại sản phẩm mới</a></li>
						<li class="dropdown-menu-item"><a href="categoryAD/category-list.php">Danh loại sách sản phẩm</a></li>
						<li class="dropdown-menu-item"><a href="productAD/index.php">Thêm sản phẩm mới</a></li>
						<li class="dropdown-menu-item"><a href="productAD/product-list.php">Danh sách sản phẩm</a></li>
					</ul>
				</li>

				<li class="nav-item">
					<a href="#">
						<i class="fa-solid fa-truck"></i>
						Quản lý đơn hàng
					</a>
				</li>
				<li class="nav-item">
					<a href="#" class="dropdown-toggle">
						<i class="fa-solid fa-users"></i>
						Quản lý người dùng
					</a>
				</li>
				<li class="nav-item">
					<a href="#">
						<i class="fa-solid fa-comments"></i>
						Quản lý lượt bình luận
					</a>
				</li>
				<li class="nav-item">
					<a href="#">
						<i class="fa-solid fa-gear"></i>
						Cài đặt trang web
					</a>
				</li>
			</ul>
		</section>

		<div id="content-page">
			<div class="content-title">
				<h1 style="font-size: 30px;">Trang chủ</h1>
			</div>

			<article class="content-top-admin">
				<table class="table-amdin">
					<tr>
						<th style=" align-items: center">
							<img style="width: 80px; height: 100px;" src="../images/admin.png" alt="">

							<p>Người dùng:
								<?php
								$query = "SELECT COUNT(*) as total FROM users";
								$result = mysqli_query($conn, $query);

								// Kiểm tra kết quả truy vấn
								if ($result) {
									// Lấy số lượng tài khoản
									$row = mysqli_fetch_assoc($result);
									$totalAccounts = $row['total'];

									// Hiển thị số lượng tài khoản trên trang web
									echo $totalAccounts;
								} else {
									echo "Error: " . mysqli_error($conn);
								}
								?>
							</p>
						</th>
						<th style=" align-items: center">
							<img style="width: 100px; height: 100px;" src="../images/product-admin.jpg" alt="">
							<p>Sản phẩm:</p>
						</th>
					</tr>

					<tr>
						<th style=" align-items: center; background-color: #CC99FF;">
							<img style="width: 120px; height: 100px;" src="../images/comment-admin.jpg" alt="">
							<p>Bình luận:</p>
						</th>
						<th style="align-items: center; background-color: #FF9999;">
							<img style="width: 150px; height: 100px;" src="../images/order.jpg" alt="">
							<p>Đơn đặt hàng: </p>
						</th>
					</tr>
				</table>
				<section class="content-page-right">
					<h1>Sản phẩm bán chạy</h1>
					<form class="hot-product-admin">
						<div class="left-hot">
							<p>Hình ảnh</p>

							<?php

							?>
						</div>
						<div class="mid-hot">
							<p>Giá sản phẩm</p>

							<?php

							?>
						</div>
						
						<div class="right-hot">
							<p>Lượt mua</p>

							<?php

							?>
						</div>
					</form>
				</section>
			</article>

			<article>
				<section class="information-page">
					<div>
						<label for="growth-rate">Tốc độ tăng trưởng</label>
						<h2>80% <span> +1.60%</span></h2>
						<input type="range" id="growth-rate" name="growth-rate" min="0" max="100" value="80">
						<div id="growth-rate-value"></div>
					</div>
					<div>
						<label for="response-rate">Tỉ lệ phản hồi</label>
						<h2>100%</h2>
						<input type="range" id="response-rate" name="response-rate" min="0" max="100" value="100">
						<div id="response-rate-value"></div>
					</div>
					<div>
						<label for="revenue">Doanh thu</label>
						<h2>15.000.000 VNĐ<span> +3%</span></h2>
						<input type="range" id="revenue" name="revenue" min="0" max="100" value="3">
						<div id="revenue-value"></div>
					</div>
				</section>
			</article>
		</div>
	</main>
</body>
<script src="js/admin.js"></script>

</html>