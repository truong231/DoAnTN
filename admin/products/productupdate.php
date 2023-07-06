<?php
    $product=mysqli_fetch_array($connect->query("select*from products where id=".$_GET['id']));
?>

<?php
    if(isset($_POST['productName'])){
        $productName=$_POST['productName'];
        $query="select*from products where productName='$productName' and id!=".$product['id'];
        if(mysqli_num_rows($connect->query($query))!=0){
            $alert="Đã có sản phẩm khác có tên này!";
        }else{
            $price=$_POST['price'];
            $size=$_POST['size'];
            $gender=$_POST['gender'];
            $brand=$_POST['brand'];
            $sale=$_POST['sale'];
            $description=$_POST['description'];
            $available=$_POST['available'];
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
                unlink($store.$product['image']);
                }else{
                    $alert="File đã chọn không phải là file ảnh!";
                }
                if(empty($imageName)){
                    $imageName=$product['image'];
                }
                ////////////////////
                $connect->query("update products set productName='$productName',price='$price',size='$size',gender='$gender',brand='$brand',sale='$sale',image='$imageName',description='$description',available='$available',status='$status' where id=".$product['id']);
                header("Location: ?option=product");
            
        }
    }
?>

<h2>Chỉnh sửa sản phẩm</h2>
<section style="color: red; font-weight: bold; text-align:center;"><?=isset($alert)?$alert:''?></section>
<section class="container col-md-6">
    <form method="post" enctype="multipart/form-data">
        <section class="form-group">
            <label>Tên: </label><input name="productName" required class="form-control" value="<?=$product['productName']?>">
        </section>
        <section class="form-group">
            <label>Giá: </label><input type="number" min="100000" name="price" required class="form-control" value="<?=$product['price']?>">
        </section>
        <section class="form-group">
            <label>Kích cỡ (tuổi): </label><input type="number" min="1" max="16" name="size" required class="form-control" value="<?=$product['size']?>">
        </section>
        <section class="form-group">
            <label>Giới tính: </label><input name="gender" required class="form-control" value="<?=$product['gender']?>">
        </section>
        <section class="form-group">
            <label>Hãng: </label><input name="brand" required class="form-control" value="<?=$product['brand']?>">
        </section>
        <section class="form-group">
            <label>Sale: </label><input name="sale" required class="form-control" value="<?=$product['sale']?>">
        </section>
        <section class="form-group">
            <label>Ảnh: </label><br>
            <img width="50%" src="../images/<?=$product['image']?>">
            <input type="file" name="image" class="form-control">
        </section>
        <section class="form-group">
            <label>Mô tả: </label>
            <textarea name="description" id="description"><?=$product['description']?></textarea>
            <script>CKEDITOR.replace("description");</script>
        </section>
        <section class="form-group">
            <label>Tình trạng hàng: </label><br><input type="radio" name="available" value="1" <?=$product['available']==1?'checked':''?>> Còn hàng <input type="radio" name="available" value="0" <?=$product['available']==0?'checked':''?>> Hết hàng
        </section>
        <section class="form-group">
            <label>Trạng thái: </label><br><input type="radio" name="status" value="1" <?=$product['status']==1?'checked':''?>> Active <input type="radio" name="status" value="0" <?=$product['status']==0?'checked':''?>> Unactive
        </section>
        <section>
            <input type="submit" value="Xác nhận" class="btn btn-primary">
            <a href="?option=product" class="btn btn-outline-secondary"> &lt;&lt; Quay lại</a>
        </section>
    </form>
</section>