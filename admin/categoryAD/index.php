<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<title>Trang quản trị</title>
	<link rel="stylesheet" href="../css/adminCSS.css">
</head>
<?php
include "../../database/connectDB.php";
include "../../database/library.php";
?>

<body>
	<header id="header-admin">
		<a href="../index.php">
			<img src="../../images/logo.jpg" alt="logo">
		</a>
		<h1 class="heading-title-page">Chào mừng đến với AIO</h1>

		<div class="header-right">
			<img id="admin-img" src="../../images/admin.png" alt="admin-img">
			<div id="admin-name" class="admin-name">
				<?php
				session_start();
				// Kiểm tra xem đã đăng nhập chưa
				require_once('../../database/library.php');
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
					<a href="../index.php">
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
						<li class="dropdown-menu-item"><a href="#">Thêm loại sản phẩm mới</a></li>
						<li class="dropdown-menu-item"><a href="category-list.php">Danh sách loại sản phẩm</a></li>
						<li class="dropdown-menu-item"><a href="../productAD/index.php">Thêm sản phẩm mới</a></li>
						<li class="dropdown-menu-item"><a href="../productAD/product-list.php">Danh sách sản phẩm</a></li>
					</ul>
				</li>

				<li class="nav-item">
					<a href="#">
						<i class="fa-solid fa-truck"></i>
						Quản lý đơn hàng
					</a>
				</li>
				<li class="nav-item">
					<a href="#">
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
		<?php
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$category_name = $_POST['category_name'];
			$sql_check = "SELECT COUNT(*) as count FROM category WHERE category_name = '$category_name'";
			$result_check = mysqli_query($conn, $sql_check);
			$count = mysqli_fetch_assoc($result_check)['count'];
			if ($count > 0) {
				echo "<span class='mesage-submit'>Loại sản phẩm đã tồn tại trong cơ sở dữ liệu !</span>";
			} else {
				$sql = "INSERT INTO category (category_name) VALUES ('$category_name')";
				$result = mysqli_query($conn, $sql);
				if ($result) {
					echo "<span class='mesage-submit'>Thêm loại sản phẩm thành công !</span>";
				} else {
					echo "<span class='mesage-submit'>Thêm loại sản phẩm thất bại: " . mysqli_error($conn) . "</span>";
				}
			}
			mysqli_close($conn);
		}
		?>
		<section class="content-right">
			<form action="" class="form-category-add" method="POST">
				<h1>Thêm danh mục sản phẩm</h1>
				<input required name="category_name" type="text" placeholder="Nhập tên danh mục...">
				<div class="btn-cate-page">
					<a class="btn-category-list" href="category-list.php">Danh sách danh mục</a>

					<button class="btn-add" type="submit" name="add">Thêm</button>
				</div>
			</form>

			<style>
				* {
					font-family: Arial, Helvetica, sans-serif;
				}

				.content-right {
					width: 80%;
					margin: 10px 0px 0px 0px;
					background-color: lightgray;
					border-radius: 10px;
				}

				.form-category-add {
					max-width: 500px;
					margin: 0 auto;
					padding: 20px;
					border-radius: 10px;
					background-color: #fff;
					box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
					text-align: center;
					margin-top: 160px;
				}

				.form-category-add h1 {
					font-size: 24px;
					font-weight: bold;
					margin-bottom: 20px;
				}

				.form-category-add input[type="text"] {
					width: 100%;
					padding: 10px;
					margin-bottom: 20px;
					border-radius: 5px;
					border: 1px solid #ccc;
					font-size: 16px;
					outline: none;
				}

				.btn-cate-page {
					display: flex;
					justify-content: space-between;
					align-items: center;
				}

				.btn-category-list,
				.btn-add {
					display: inline-block;
					padding: 10px 20px;
					border-radius: 5px;
					font-size: 16px;
					font-weight: bold;
					text-decoration: none;
					text-align: center;
					color: #ffffff;
					background-color: #ff4a4a;
					border: none;
					transition: all 0.3s ease;
				}

				.feedback-category-add {
					display: none;
					position: absolute;
				}

				.mesage-submit {
					position: absolute;
					left: 47%;
					bottom: 235px;
					padding: 10px;
					background-color: #fff;
					box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
					opacity: 0;
					transition: opacity 0.3s ease-in-out;
					color: #000;
					border-radius: 10px;
				}

				.mesage-submit.show {
					opacity: 1;
				}
			</style>
		</section>
	</main>
</body>
<script>
	//mesage khi submit
	let mesageSubmit = document.querySelector('.mesage-submit');
	mesageSubmit.classList.add('show');
	setTimeout(function() {
		mesageSubmit.classList.remove('show');
	}, 1500);


	const dropdownToggle = document.querySelector('.dropdown-toggle');

	dropdownToggle.addEventListener('click', function() {
		const dropdownMenu = this.nextElementSibling;
		dropdownMenu.classList.toggle('show');
		this.classList.toggle('active');
		const icon = this.querySelector("i");
		if (dropdownMenu.classList.contains("show")) {
			icon.classList.remove("fa-chevron-down");
			icon.classList.add("fa-chevron-up");
		} else {
			icon.classList.remove("fa-chevron-up");
			icon.classList.add("fa-chevron-down");
		}
	});

	// Sử dụng sự kiện click bên ngoài để đóng menu khi nhấn ra ngoài
	document.addEventListener('click', function(event) {
		const dropdowns = document.querySelectorAll('.dropdown-menu');
		dropdowns.forEach(function(dropdown) {
			if (dropdown.classList.contains('show') && !dropdown.contains(event.target) && !dropdownToggle.contains(event.target)) {
				dropdown.classList.remove('show');
				dropdownToggle.classList.remove('active');
				const icon = dropdownToggle.querySelector("i");
				icon.classList.remove("fa-chevron-up");
				icon.classList.add("fa-chevron-down");
			}
		});
	});
</script>
<script src="../js/admin.js"></script>

</html>