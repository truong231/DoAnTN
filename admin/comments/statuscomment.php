<?php
    $comments=mysqli_fetch_array($connect->query("select*from comments where id=".$_GET['id']));
?>

<?php
    if(isset($_POST['content'])){
        $content=$_POST['content'];
        $status=$_POST['status'];
        $connect->query("update comments set status='$status' where id=".$comments['id']);
        header("Location: ?option=comment");
    }
?>

<h2>Chỉnh sửa phản hồi</h2>
<section style="color: red; font-weight: bold; text-align:center;"><?=isset($alert)?$alert:''?></section>
<section class="container col-md-6">
    <form method="post" enctype="multipart/form-data">
        <section class="form-group">
            <label>Nội dung bình luận: </label><input name="content" class="form-control" value="<?=$comments['content']?>">
        </section>
        <section class="form-group">
            <label>Trạng thái: </label><br><input type="radio" name="status" value="1" <?=$comments['status']==1?'checked':''?>> Active <input type="radio" name="status" value="0" <?=$comments['status']==0?'checked':''?>> Unactive
        </section>
        <section>
            <input type="submit" value="Xác nhận" class="btn btn-primary">
            <a href="?option=customer" class="btn btn-outline-secondary btn-sm"> &lt;&lt; Quay lại</a>
        </section>
    </form>
</section>