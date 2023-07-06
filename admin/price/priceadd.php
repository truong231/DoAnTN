<?php
    if(isset($_POST['rangePrice'])){
        $rangePrice=$_POST['rangePrice'];
        $query="select*from price where rangePrice='$rangePrice'";
        if(mysqli_num_rows($connect->query($query))!=0){
            $alert="Đã tồn tại loại mức giá này!";
        }else{
            $status=$_POST['status'];
            $connect->query("insert price(rangePrice,status) values('$rangePrice','$status')");
            header("Location: ?option=price");
        }
    }
?>

<h2>Thêm mức giá mới</h2>
<section style="color: red; font-weight: bold; text-align:center;"><?=isset($alert)?$alert:''?></section>
<section class="container col-md-6">
    <form method="post">
        <section class="form-group">
            <label>Phân loại: </label><input name="rangePrice" required class="form-control">
        </section>
        <section class="form-group">
            <label>Trạng thái: </label><br><input type="radio" name="status" value="1" checked> Active <input type="radio" name="status" value="0"> Unactive
        </section>
        <section>
            <input type="submit" value="Thêm" class="btn btn-primary">
            <a href="?option=price" class="btn btn-outline-secondary"> &lt;&lt; Quay lại</a>
        </section>
    </form>
</section>