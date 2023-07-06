<?php
    $newss=mysqli_fetch_array($connect->query("select*from news where id=".$_GET['id']));
?>


<?php
    if(isset($_POST['title'])){
        $title=$_POST['title'];
        $query="select*from news where title='$title' and id!=".$newss['id'];
        if(mysqli_num_rows($connect->query($query))!=0){
            $alert="Đã có sản phẩm khác có tên này!";
        }else{
            $writer=$_POST['writer'];
            $summarynews=$_POST['summarynews'];
            $fullnews=$_POST['fullnews'];
            $status=$_POST['status'];
            //Xử lý phần ảnh:
            $store="../images/";
            $imageName=$_FILES['image']['name'];
            $imageTemp=$_FILES['image']['tmp_name'];
            $exp3=substr($imageName, strlen($imageName)-3);#abcd.jpg
            $exp4=substr($imageName, strlen($imageName)-4);#jpeg, webp,...
            if($exp3=='jpg'||$exp3=='png'||$exp3=='bmp'||$exp3=='gif'||$exp3=='JPG'||$exp3=='PNG'||$exp3=='BMP'||$exp3=='GIF'||$exp4=='jpeg'||$exp4=='webp'||$exp4=='JPEG'||$exp3=='WEBP'){
                $imageName=time().'_'.$imageName;
                move_uploaded_file($imageTemp, $store.$imageName);
                unlink($store.$newss['image']);
                }else{
                    $alert="File đã chọn không phải là file ảnh!";
                }
                if(empty($imageName)){
                    $imageName=$newss['image'];
                }
                ////////////////////
                $connect->query("update news set title='$title',writer='$writer',summarynews='$summarynews',fullnews='$fullnews',image='$imageName',status='$status' where id=".$newss['id']);
                header("Location: ?option=news");
            
        }
    }
?>

<h2>Chỉnh sửa bài viết</h2>
<section style="color: red; font-weight: bold; text-align:center;"><?=isset($alert)?$alert:''?></section>
<section class="container col-md-6">
    <form method="post" enctype="multipart/form-data">
        <section class="form-group">
            <label>Tiêu đề: </label><input name="title" required class="form-control" value="<?=$newss['title']?>">
        </section>
        <section class="form-group">
            <label>Người viết: </label><input name="writer" required class="form-control" value="<?=$newss['writer']?>">
        </section>
        <section class="form-group">
            <label>Bài viết tóm tắt: </label>
            <textarea name="summarynews" id="summarynews"><?=$newss['summarynews']?></textarea>
            <script>CKEDITOR.replace("summarynews");</script>
        </section>
        <section class="form-group">
            <label>Bài viết đầy đủ: </label>
            <textarea name="fullnews" id="fullnews"><?=$newss['fullnews']?></textarea>
            <script>CKEDITOR.replace("fullnews");</script>
        </section>
        <section class="form-group">
            <label>Ảnh: </label><br>
            <img src="../images/<?=$newss['image']?>">
            <input type="file" name="image" class="form-control">
        </section>
        <section class="form-group">
            <label>Trạng thái: </label><br><input type="radio" name="status" value="1" <?=$newss['status']==1?'checked':''?>> Active <input type="radio" name="status" value="0" <?=$newss['status']==0?'checked':''?>> Unactive
        </section>
        <section>
            <input type="submit" value="Xác nhận" class="btn btn-primary">
            <a href="?option=news" class="btn btn-outline-secondary"> &lt;&lt; Quay lại</a>
        </section>
    </form>
</section>