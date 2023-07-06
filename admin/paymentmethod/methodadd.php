<?php
    if(isset($_POST['paymentName'])){
        $paymentName=$_POST['paymentName'];
        $query="select*from paymentmethods where paymentName='$paymentName'";
        if(mysqli_num_rows($connect->query($query))!=0){
            $alert="Đã tồn tại phương thức thanh toán này!";
        }else{
            $status=$_POST['status'];
            $connect->query("insert paymentmethods(paymentName,status) values('$paymentName','$status')");
            header("Location: ?option=method");
        }
    }
?>

<h2>Thêm phương thức thanh toán mới</h2>
<section style="color: red; font-weight: bold; text-align:center;"><?=isset($alert)?$alert:''?></section>
<section class="container col-md-6">
    <form method="post">
        <section class="form-group">
            <label>Tên phương thức: </label><input name="paymentName" required class="form-control">
        </section>
        <section class="form-group">
            <label>Trạng thái: </label><br><input type="radio" name="status" value="1" checked> Active <input type="radio" name="status" value="0"> Unactive
        </section>
        <section>
            <input type="submit" value="Thêm" class="btn btn-primary">
            <a href="?option=method" class="btn btn-outline-secondary btn-sm"> &lt;&lt; Quay lại</a>
        </section>
    </form>
</section>