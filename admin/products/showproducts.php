<?php
    if(isset($_GET['id'])){
        $id=$_GET['id'];
        $products=$connect->query("select*from orderdetail where productId=$id");
        if(mysqli_num_rows($products)!=0){
            $connect->query("update products set status=0 where id=$id");
        }else{
            $connect->query("delete from products where id=$id");
            unlink("../images/".$_GET['image']);
        }
    }
?>

<?php
     $query="select*from products order by addday desc";
     $result=$connect->query($query);
?>
<h2>DANH SÁCH SẢN PHẨM</h2></br>
<section style="text-align: center;"><a href="?option=productadd" class="btn btn-success btn-sm">Thêm sản phẩm</a></section></br>
<table class="table table-bordered">
    <thead>
        <tr style="text-align: center">
            <th>STT</th>
            <th>Mã</th>
            <th>Tên</th>
            <th>Giá</th>
            <th>Kích cỡ (tuổi)</th>
            <th>Giới tính</th>
            <th>Loại</th>
            <th>Hãng</th>
            <th>Ngày thêm</th>
            <th>Sale(%)</th>
            <th>Ảnh</th>
            <th>Tình trạng hàng</th>
            <th>Trạng thái</th>
            <th>Tùy chọn</th>
        </tr>
    </thead>
    <tbody>
        <?php $count=1;?>
        <?php foreach($result as $item):?>
            <tr>
                <td><?=$count++?></td>
                <td><?=$item['id']?></td>
                <td width="120px"><?=$item['productName']?></td>
                <td><?=number_format($item['price'],0,',','.')?> ₫</td>
                <td width="50px"><?=$item['size']?></td>
                <td><?=$item['gender']?></td>
                <td><?=$item['typefashion']?></td>
                <td><?=$item['brand']?></td>
                <td width="100px"><?=$item['addday']?></td>
                <td><?=$item['sale']?></td>
                <td width="100px"><img src="../images/<?=$item['image']?>" width="100%"></td>
                <td><?=$item['available']==1?'Còn hàng':'Hết hàng'?></td>
                <td><?=$item['status']==1?'Active':'Unactive'?></td>
                <td style="text-align: center"><a class="btn btn-sm btn-info" href="?option=productupdate&id=<?=$item['id']?>">Chỉnh sửa</a> <a href="?option=product&id=<?=$item['id']?>&image=<?=$item['image']?>" class="btn btn-sm btn-danger" onclick="return confirm('Bạn muốn xóa?')">Xóa</a></td>
            </tr>
        <?php endforeach;?>
    </tbody>
</table>