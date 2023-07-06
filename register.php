<?php
    session_start();
    $connect=new MySQLi("localhost",'root','','lanlankids');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Đăng ký</title>
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
                function register(){
                    global $connect;
                    if(isset($_POST['username'])){
                        $username=$_POST['username'];
                        $query="select * from users where username='$username'";
                        $result=$connect->query($query);
                        $password=md5($_POST['password']);
                        $fullName=$_POST['fullName'];
                        $phone=$_POST['phone'];
                        $email=$_POST['email'];
                        $address=$_POST['address'];
                        if(mysqli_num_rows($result)!=0){
                            return "Tên đăng nhập đã có sẵn!";
                        }else{
                            $query="insert users(username,password,fullName,phone,email,address) values('$username','$password','$fullName','$phone','$email','$address')";
                            $connect->query($query);
                            echo"<script>alert('Bạn đã đăng ký thành công, Đăng nhập nào!');
                            location='login.php';</script>";
                        }
                    }
                    return '';
                }
                $alert=register();
            ?><br><br><br>
            <section class="container col-md-4" style="margin-top: 160px; box-shadow: 0 0 10px gray; border-radius: 4%; background: ghostwhite"><br><br>
                <center><h2>Đăng ký tài khoản</h2></center>
                <?php if($alert!=''):?>
                <section class="alert alert-danger" style="text-align: center"><?=$alert?></section>
                <?php endif;?>
                <form method="post">
                    <section class="form-group">
                        <label>Tên tài khoản: </label>
                        <input type="text" name="username" class="form-control" autocomplete="off" required>
                    </section>
                    <section class="form-group">
                        <label>Mật khẩu: </label>
                        <input type="password" name="password" class="form-control" required pattern=".{6,}" title="Mật khẩu phải từ 6 ký tự">
                    </section>
                    <section class="form-group">
                        <label>Nhập lại mật khẩu: </label>
                        <input type="password" name="repassword" class="form-control" oninput="if(value!=password.value){document.getElementById('checkPass').innerHTML='Mật khẩu không trùng khớp!'}else{document.getElementById('checkPass').innerHTML=''}">
                        <span id="checkPass" style="color:red;"></span>
                    </section>
                    <section class="form-group">
                        <label>Họ và tên: </label>
                        <input type="text" name="fullName" class="form-control" value="<?=isset($fullName)?$fullName:''?>" required>
                    </section>
                    <section class="form-group">
                        <label>Số điện thoại: </label>
                        <input type="tel" name="phone" class="form-control" pattern="\d{10,13}" title="Số điện thoại không đúng!" value="<?=isset($phone)?$phone:''?>" required>
                    </section>
                    <section class="form-group">
                        <label>Email: </label>
                        <input type="email" name="email" class="form-control" pattern=".+@.+(\.[a-z]{2,3}){1,2}" value="<?=isset($email)?$email:''?>" required>
                    </section>
                    <section class="form-group">
                        <label>Địa chỉ: </label>
                        <textarea name="address" class="form-control" rows="3"><?=isset($address)?$address:''?></textarea>
                    </section></br>
                    <section class="form-group">
                        <center><input type="submit" value="Register" class="btn btn-outline-primary"></center>
                    </section>
                </form><br><br><br>
            </section>
        </section>
        <?php include"layout/footer.php";?>
        </section>

	<script type="text/javascript" src="js/js.js"></script>
</body>
</html>
