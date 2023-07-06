<?php
    $customers=mysqli_fetch_array($connect->query("select*from users where id=".$_GET['id']));
?>

<?php
    if(isset($_POST['username'])){
        $username=$_POST['username'];
        $status=$_POST['status'];
        $keyAdmin=$_POST['keyAdmin'];
        $connect->query("update users set status='$status',keyAdmin='$keyAdmin' where id=".$customers['id']);
        header("Location: ?option=account");
    }
?>

<h2>Chỉnh sửa tài khoản</h2>
<section style="color: red; font-weight: bold; text-align:center;"><?=isset($alert)?$alert:''?></section>
<section class="container col-md-6">
    <form method="post" enctype="multipart/form-data">
        <section class="form-group">
            <label>Tên người dùng: </label><input name="username" class="form-control" value="<?=$customers['username']?>">
        </section>
        <section class="form-group">
            <label>Trạng thái: </label><br><input type="radio" name="status" value="1" <?=$customers['status']==1?'checked':''?>> Active <input type="radio" name="status" value="0" <?=$customers['status']==0?'checked':''?>> Unactive
        </section>
        <section class="form-group">
            <label>Quyền hạn: </label><br><input type="radio" name="keyAdmin" value="1" <?=$customers['keyAdmin']==1?'checked':''?>> Admin <input type="radio" name="keyAdmin" value="0" <?=$customers['keyAdmin']==0?'checked':''?>> Khách hàng
        </section>
        <section>
            <input type="submit" value="Xác nhận" class="btn btn-primary">
            <a href="?option=customer" class="btn btn-outline-secondary"> &lt;&lt; Quay lại</a>
        </section>
    </form>
</section>