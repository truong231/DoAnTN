<?php
    session_start();
    $connect=new MySQLi("localhost",'root','','lanlankids');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Đăng nhập</title>
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
                function login(){
                    global $connect;
                    if(isset($_POST['username'])){
                        $username=$_POST['username'];
                        $password=md5($_POST['password']);
                        $query="select * from users where username='$username' and password='$password'";
                        $result=$connect->query($query);
                        if(mysqli_num_rows($result)==0){
                            return "Tên đăng nhập hoặc mật khẩu không đúng!";
                        }else{
                            $result=mysqli_fetch_array($result);
                            if(($result['status'])==0){
                                return "Tài khoản này tạm thời đang bị khóa!";
                            }else{
                                $_SESSION['user']=$username;
                                if(($result['keyAdmin'])==1){
                                    echo"<script>alert('Bạn là quản trị viên, mời thao tác!');
                                    location='admin/adchoice.php';</script>";
                                }else{
                                    $_SESSION['user']=$username;
                                    if(isset($_GET['payment'])){
                                        header('location:order.php?request=payment');
                                    }elseif($_GET['productId']){
                                        $userId=$result['id'];
                                        $productId=$_GET['productId'];
                                        if(isset($_GET['a'])){
                                            $content=$_SESSION['content'];
                                            $connect->query("insert comments(userId,productId,date,content) values($userId,$productId,now(),'$content')");
                                            echo"<script>alert('Bình luận của bạn đã được gửi đi và sẽ được hiển thị sớm!'); location='order.php?request=detail&productId=$productId';</script>";
                                        }elseif(isset($_GET['b'])){
                                            $starRatingId=$_SESSION['starRatingId'];
                                            $query="select*from pr_rating where userId='$userId' and productId='$productId'";
                                            if(mysqli_num_rows($connect->query($query))==0):
                                                $connect->query("insert pr_rating(userId,productId,starRatingId) values($userId,$productId,'$starRatingId')");
                                            else:
                                                $connect->query("update pr_rating set starRatingId=$starRatingId where userId='$userId' and productId='$productId'");
                                            endif;
                                            echo"<script>alert('Cảm ơn bạn đã đánh giá sản phẩm của chúng tôi!'); location='order.php?request=detail&productId=$productId';</script>";
                                        }
                                    }else{
                                        echo"<script>alert('Bạn đã đăng nhập thành công!');
                                        location='.';</script>";
                                    }
                                }
                            }
                        }
                    }
                    return '';
                }
                $alert=login();
            ?><br><br><br>
            <section class="container login col-md-4" style="margin-top: 160px; box-shadow: 0 0 10px gray; border-radius: 4%; background: ghostwhite"><br><br>
            <center><h2>Đăng nhập tài khoản</h2></center></br>
                <?php if($alert!=''):?>
                    <section class="alert alert-danger" style="text-align: center"><?=$alert?></section>
                <?php endif;?>
                <form method="post" autocomplete="off">
                    <section class="form-group">
                        <label>Tên tài khoản: </label>
                        <input type="text" name="username" class="form-control" autocomplete="off">
                    </section>
                    <section class="form-group">
                        <label>Mật khẩu: </label>
                        <input type="password" name="password" class="form-control">
                    </section></br>
                    <section class="form-group">
                    <center><input type="submit" value="Đăng nhập" class="btn btn-primary"></center>
                    </section>
                </form><br><br><br>
            </section>
        </section>
        <?php include"layout/footer.php";?>
    </section>

	<script type="text/javascript" src="js/js.js"></script>
</body>
</html>
