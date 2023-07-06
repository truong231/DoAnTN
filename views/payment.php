<?php
    if(isset($_POST['fullName'])):
        $fullName=$_POST['fullName'];
        $phone=$_POST['phone'];
        $email=$_POST['email'];
        $address=$_POST['address'];
        $connect->query("update users set fullName='$fullName',phone='$phone',email='$email',address='$address' where username='".$_SESSION['user']."'");
    endif;
?>
<?php
    $query="select*from users where username='".$_SESSION['user']."'";
    $user=mysqli_fetch_array($connect->query($query));
?>
<?php
    if(isset($_POST['customerName'])):
        $customerName=$_POST['customerName'];
        $phone=$_POST['phone'];
        $email=$_POST['email'];
        $address=$_POST['address'];
        $note=$_POST['note'];
        $paymentMethodId=$_POST['paymentMethodId'];
        $userId=$user['id'];
        $connect->query("insert orders(userId,paymentMethodId,orderDate,customerName,phone,email,address,note) values('$userId','$paymentMethodId',now(),'$customerName','$phone','$email','$address','$note')");
        $order=mysqli_fetch_array($connect->query("select id from orders order by id desc limit 1"));
        $orderId=$order['id'];
        foreach (array_keys($_SESSION['cart']) as $productId){
            $quantity=$_SESSION['cart'][$productId];
            $product=mysqli_fetch_array($connect->query("select * from products where id=$productId"));
            $price=$product['price'];
            $sale=$product['sale'];
            $VAT=$product['VAT'];
            $connect->query("insert orderdetail values('$orderId','$productId','$quantity','$price','$sale','$VAT')");
        }
        unset($_SESSION['cart']);
        echo"<script>alert('Đặt hàng thành công, chúng tôi sẽ liên hệ lại cho bạn sớm nhé, tiếp tục mua hàng nào!'); location='.'</script>";
    endif;
?>
<section class="container-fluid">
    <section class="col-md-8 payment"><br><br>
        <center><h1>Thanh toán</h1></center><br>
        <h2>Thông tin khách hàng</h2>
        <form method="post">
            <section class="form-group">
                <label>Họ và tên:</label>
                <input type="text" name="customerName" class="form-control" value="<?=$user['fullName']?>" required>
            </section>
            <section class="form-group">
                <label>Điện thoại:</label>
                <input type="tel" name="phone" class="form-control" pattern="\d{10,13}" title="Số điện thoại không đúng!" value="<?=$user['phone']?>" required>
            </section>
            <section class="form-group">
                <label>Email:</label>
                <input type="email" name="email" class="form-control" pattern=".+@.+(\.[a-z]{2,3}){1,2}" value="<?=$user['email']?>" required>
            </section>
            <section class="form-group">
                <label>Địa chỉ:</label>
                <textarea name="address" class="form-control" required><?=$user['address']?></textarea>
            </section>
            <section class="form-group">
                <label>Ghi chú:</label>
                <textarea name="note" class="form-control"></textarea>
            </section><br>
            <section class="form-group">
                <input type="submit" value="Cập nhật thông tin" class="btn btn-info btn-sm">
            </section><br>
            <?php
                $paymentMethods=$connect->query("select*from paymentmethods where status");
            ?>
            <h2>Phương thức thanh toán</h2>
            <?php
                foreach($paymentMethods as $paymentMethod):
            ?>
            <section class="form-group">
                <input type="radio" name="paymentMethodId" value="<?=$paymentMethod['id']?>" <?=$paymentMethod['id']==3?'disabled':''?> <?=$paymentMethod['id']==4?'disabled':''?> <?=$paymentMethod['id']!=1?:'checked'?>><?=$paymentMethod['paymentName']?>
            </section>
            <?php endforeach;?><br>
            <section class="form-group">
                <input type="submit" value="Thanh toán" class="btn btn-success">
            </section>
        </form>
    </section>
</section>