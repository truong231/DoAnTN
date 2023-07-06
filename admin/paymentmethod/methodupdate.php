<?php
    $method=mysqli_fetch_array($connect->query("select*from paymentmethods where id=".$_GET['id']));?>
?>

<?php
    if(isset($_POST['paymentName'])){
        $paymentName=$_POST['paymentName'];
        $query="select*from paymentmethods where paymentName='$paymentName' and id!=".$method['id'];
        if(mysqli_num_rows($connect->query($query))!=0){
            $alert="Đã tồn tại phương thức thanh toán này!";
        }else{
            $status=$_POST['status'];
            $connect->query("update paymentmethods set paymentName='$paymentName',status='$status' where id=".$method['id']);
            header("Location: ?option=method");
        }
    }
?>

<h2>Chỉnh sửa phương thức thanh toán</h2>
<section style="color: red; font-weight: bold; text-align:center;"><?=isset($alert)?$alert:''?></section>
<section class="container col-md-6">
    <form method="post">
        <section class="form-group">
            <label>Tên phương thức: </label><input value="<?=$method['paymentName']?>" name="paymentName" required class="form-control">
        </section>
        <section class="form-group">
            <label>Trạng thái: </label><br><input type="radio" name="status" value="1" <?=$method['status']==1?'checked':''?>> Active <input type="radio" name="status" value="0" <?=$method['status']==0?'checked':''?>> Unactive
        </section>
        <section>
            <input type="submit" value="Xác nhận" class="btn btn-primary">
            <a href="?option=method" class="btn btn-outline-secondary btn-sm"> &lt;&lt; Quay lại</a>
        </section>
    </form>
</section>