<?php
    session_start();
    $connect=new MySQLi("localhost",'root','','lanlankids');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Control Panel</title>
    <link rel="stylesheet" type="text/css" href="css.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <style>
		.sum{width: 700px; height: 300px; padding: 20px 20px; margin: auto; box-shadow: 0 0 10px gray; background: rgb(250, 244, 255)}
	</style>
	<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="../public/ckeditor/ckeditor.js"></script>
</head>
<body>
	<section class="sum">
		<section class="container col-md-12 row" style="text-align: center"><br>
			<h4 style="margin: 40px 0 80px 0">Thao tác với quyền hạn như</h4>
			<section class="container col-md-6">
				<a href="..\index.php" class="btn btn-success">Khách hàng</a>
			</section>
			<section class="container col-md-6">
				<a href="..\admin\admin.php" class="btn btn-warning">Quản trị viên</a>
			</section>
		</section>
	</section>
    <script type="text/javascript" src="js.js"></script>
</body>
</html>
