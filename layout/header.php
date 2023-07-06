<header class="container-fluid fix">
	<section style="margin:auto; display: flex;">
		<a class="logo" href="index.php"><img src="images/Lanlankids.png" title="Lanlankids" width='200px' height='95px'></a>
		<form action="?request=search" method="post">
			<section class="findheader" style="margin:27px; display:flex;">
				<input type="search" name="keyword" placeholder="Bạn cần tìm sản phẩm nào?" class="form-control"style="width: 650px">
				<input type="submit" value="Tìm kiếm" class="btn btn-info btn-sm">
			</section>
		</form>
		<section class="iconheader" style="margin:30px; display:flex;">
			<?php if(!isset($_SESSION['user'])):?>
				<div class="dropdown">
					<i class="fa fa-user dropbtn"></i>
					<div class="dropdown-content">
						<a href="login.php">Đăng nhập</a>
						<a href="changepass.php">Đổi mật khẩu</a>
						<a href="register.php">Đăng ký</a>
					</div>
				</div>
			<?php else:?>
				<section style="float: left; font-weight:bold; text-align: center; margin-top: -10px">Xin chào: <span style="color: red"><?=$_SESSION['user']?></span> <i class="fas fa-hand-sparkles"></i><br><a href="index.php?request=logout"><i class="fas fa-sign-out-alt" title="Đăng xuất"></i></a>
				</section>&emsp;
			<?php endif;?>
			<div class="icons">
				<a style="margin-left: 30px;" href="intro.php?option=contact"><i class="fas fa-map-marker-alt" title="Liên hệ"></i></a>
				<a style="margin-left: 30px;" href="order.php?request=cart"><i class="fas fa-cart-plus" title="Giỏ hàng"></i>
					<?php
						if(isset($_SESSION['cart'])){
							$count=count($_SESSION['cart']);
							echo "<span id=\"cart_count\" class=\"text-warning bg-dark\">$count</span>";
						}else{
							echo "<span id=\"cart_count\" class=\"text-warning bg-dark\">0</span>";
						}
					?>
				</a>
				<?php if(isset($_SESSION['user'])):
					$users=mysqli_fetch_array($connect->query("select*from users where username='".$_SESSION['user']."'"));?>
					<a style="margin-left: 60px;" href="./admin/admin.php"><i class="fa fa-cog" <?=$users['keyAdmin']==1?'':'hidden'?> aria-hidden="true" title="Quản trị Admin"></i></a>
				<?php else:''?>
				<?php endif;?>
			</div>
		</section>
	</section>
</header>