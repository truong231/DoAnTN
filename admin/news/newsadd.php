<?php
    if(isset($_POST['title'])){
        $title=$_POST['title'];
        $query="select*from news where title='$title'";
        if(mysqli_num_rows($connect->query($query))!=0){
            $alert="Đã tồn tại bài viết này!";
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
                $connect->query("insert news(title,writer,summarynews,fullnews,image,status) values('$title','$writer','$summarynews','$fullnews','$imageName','$status')");
                header("Location: ?option=news");
            }else{
                $alert="File đã chọn không phải là file ảnh!";
            }
            ////////////////////
        }
    }
?>

<h2>Thêm tin mới</h2>
<section style="color: red; font-weight: bold; text-align:center;"><?=isset($alert)?$alert:''?></section>
<section class="container col-md-6">
    <form method="post" enctype="multipart/form-data">
        <section class="form-group">
            <label>Tiêu đề: </label><input name="title" required class="form-control">
        </section>
        <section class="form-group">
            <label>Người viết: </label><input name="writer" required class="form-control">
        </section>
        <section class="form-group">
            <label>Bài viết tóm tắt: </label>
            <textarea name="summarynews" id="summarynews"></textarea>
            <script>CKEDITOR.replace("summarynews");</script>
        </section>
        <section class="form-group">
            <label>Bài viết đầy đủ: </label>
            <textarea name="fullnews" id="fullnews"></textarea>
            <script>CKEDITOR.replace("fullnews");</script>
        </section>
        <section class="form-group">
            <label>Ảnh: </label><input type="file" name="image" required class="form-control">
        </section>
        <section class="form-group">
            <label>Trạng thái: </label><br><input type="radio" name="status" value="1" checked> Active <input type="radio" name="status" value="0"> Unactive
        </section>
        <section>
            <input type="submit" value="Thêm" class="btn btn-primary">
            <a href="?option=news" class="btn btn-outline-secondary"> &lt;&lt; Quay lại</a>
        </section>
    </form>
</section>