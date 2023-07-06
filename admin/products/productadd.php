<?php
    if(isset($_POST['productName'])){
        $productName=$_POST['productName'];
        $query="select*from products where productName='$productName'";
        if(mysqli_num_rows($connect->query($query))!=0){
            $alert="Đã tồn tại sản phẩm này!";
        }else{
            $price=$_POST['price'];
            $size=$_POST['size'];
            $typefashion=$_POST['typefashion'];
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
                $connect->query("insert products(productName,price,size,typefashion,gender,brand,sale,image,description,available,status) values('$productName','$price','$size','$typefashion','$gender','$brand','$sale','$imageName','$description','$available','$status')");
                header("Location: ?option=product");
            }else{
                $alert="File đã chọn không phải là file ảnh!";
            }
            ////////////////////
        }
    }
?>

<h2>Thêm sản phẩm mới</h2>
<section style="color: red; font-weight: bold; text-align:center;"><?=isset($alert)?$alert:''?></section>
<section class="container col-md-6">
    <form method="post" enctype="multipart/form-data">
        <section class="form-group">
            <label>Tên: </label><input name="productName" required class="form-control">
        </section>
        <section class="form-group">
            <label>Giá: </label><input type="number" min="100000" name="price" required class="form-control" oninput="if(value<100000){document.getElementById('checkPrice').innerHTML='Gía phải từ 100.000 trở lên!'}else{document.getElementById('checkPrice').innerHTML=''}">
            <span id="checkPrice" style="color:red;"></span>
        </section>
        <section class="form-group">
            <label>Kích cỡ (tuổi): </label><input type="number" min="3" max="16" name="size" required class="form-control" oninput="if(value<3){document.getElementById('checkage').innerHTML='Tuổi phải trong khoảng 3 đến 16 tuổi!'}else if(value>16){document.getElementById('checkage').innerHTML='Tuổi phải trong khoảng 3 đến 16 tuổi!'}else{document.getElementById('checkage').innerHTML=''}">
            <span id="checkage" style="color:red;"></span>
        </section>
        <section class="form-group">
            <label>Giới tính: </label><input name="gender" required class="form-control" oninput="if(value=='Nữ'){document.getElementById('checkGender').innerHTML=''}else if(value=='Nam'){document.getElementById('checkGender').innerHTML=''}else{document.getElementById('checkGender').innerHTML='Nam hoặc Nữ nhé!'}">
            <span id="checkGender" style="color:red;"></span>
        </section>
        <section class="form-group">
            <label>Loại: </label><input name="typefashion" required class="form-control" oninput="if(value=='Áo'){document.getElementById('checkType').innerHTML=''}else if(value=='Váy'){document.getElementById('checkType').innerHTML=''}else if(value=='Quần'){document.getElementById('checkType').innerHTML=''}else{document.getElementById('checkType').innerHTML='Áo, Váy hoặc Quần nhé!'}">
            <span id="checkType" style="color:red;"></span>
        </section>
        <section class="form-group">
            <label>Hãng: </label><input name="brand" required class="form-control">
        </section>
        <section class="form-group">
            <label>Sale: </label><input name="sale" required class="form-control">
        </section>
        <section class="form-group">
            <label>Ảnh: </label><input type="file" name="image" required class="form-control">
        </section>
        <section class="form-group">
            <label>Mô tả: </label>
            <textarea name="description" id="description"></textarea>
            <script>CKEDITOR.replace("description");</script>
        </section>
        <section class="form-group">
            <label>Tình trạng hàng: </label><br><input type="radio" name="available" value="1" checked> Còn hàng <input type="radio" name="available" value="0"> Hết hàng
        </section>
        <section class="form-group">
            <label>Trạng thái: </label><br><input type="radio" name="status" value="1" checked> Active <input type="radio" name="status" value="0"> Unactive
        </section>
        <section>
            <input type="submit" value="Thêm" class="btn btn-primary">
            <a href="?option=product" class="btn btn-outline-secondary"> &lt;&lt; Quay lại</a>
        </section>
    </form>
</section>