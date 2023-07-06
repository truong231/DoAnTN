<?php
    session_start();
    $connect=new MySQLi("localhost",'root','','lanlankids');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Đổi mật khẩu</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/css.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
	<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
</head>
<body>
    <section class="container-fluid">
        <?php include"layout/indexheader.php";?>
        <?php include"layout/menutop.php";?>
        <section class="container-fluid center">
            <?php
                function changepass(){
                    global $connect;
                    if(isset($_POST['doimatkhau'])){
                        $username=$_POST['username'];
                        $password=md5($_POST['password']);
                        $newpass=md5($_POST['newpassword']);
                        $query="select * from users where username='$username' and password='$password' limit 1";
                        $result=$connect->query($query);
                        if(mysqli_num_rows($result)==0){
                            return "Tên đăng nhập hoặc mật khẩu không đúng!";
                        }else{
			                if($_POST['newpassword']!=$_POST['renewpassword']){
				                return "Nhập lại mật khẩu chưa khớp!";
			                }else{
                                $query="update users set password='$newpass' where username='$username'";
                                $connect->query($query);
                                return "Đổi mật khẩu thành công!";
                            }
                        }
                    }
                    return '';
                }
                $alert=changepass();
            ?><br><br><br>
            <section class="container col-md-4" style="margin-top: 160px; box-shadow: 0 0 10px gray; border-radius: 4%; background: ghostwhite"><br><br>
            <h3 style="text-align: center">Đổi mật khẩu</h3>
                <?php if($alert!=''):?>
                    <section class="alert alert-danger" style="text-align: center"><?=$alert?></section>
                <?php endif;?>
                <form method="post" autocomplete="off">
                    <section class="form-group">
                        <label>Tên tài khoản (*): </label>
                        <input type="text" name="username" class="form-control" autocomplete="off">
                    </section>
                    <section class="form-group">
                        <label>Mật khẩu cũ (*): </label>
                        <input type="password" name="password" class="form-control" pattern=".{6,}" title="Mật khẩu phải từ 6 ký tự">
                    </section>
                    <section class="form-group">
                        <label>Mật khẩu mới (*): </label>
                        <input type="password" name="newpassword" class="form-control" pattern=".{6,}" title="Mật khẩu phải từ 6 ký tự">
                    </section>
                    <section class="form-group">
                        <label>Nhập lại mật khẩu mới (*): </label>
                        <input type="password" name="renewpassword" class="form-control">
                    </section><br>
                    <section class="form-group">
                        <center><input type="submit" name="doimatkhau" value="Đổi mật khẩu" class="btn btn-outline-primary"></center>
                    </section>
                </form><br><br><br>
            </section>	
        </section>
        <?php include"layout/footer.php";?>
    </section>

	<script type="text/javascript" src="js/js.js"></script>
</body>
</html>