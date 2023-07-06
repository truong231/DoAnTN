<?php
    if(isset($_GET['id'])){
        $id=$_GET['id'];
        $connect->query("delete from price where id=$id");
    }
?>

<?php
     $query="select*from price";
     $result=$connect->query($query);
?>
<h2>MỨC GIÁ SẢN PHẨM</h2></br>
<section style="text-align: center;"><a href="?option=priceadd" class="btn btn-success btn-sm">Thêm mức giá</a></section></br>
<table class="table table-bordered">
    <thead>
        <tr style="text-align: center">
            <th>STT</th>
            <th>Mã giá</th>
            <th>Phân loại</th>
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
                <td><?=$item['rangePrice']?></td>
                <td><?=$item['status']==1?'Active':'Unactive'?></td>
                <td style="text-align: center"><a class="btn btn-sm btn-info" href="?option=priceupdate&id=<?=$item['id']?>">Chỉnh sửa</a> <a href="?option=price&id=<?=$item['id']?>" class="btn btn-sm btn-danger" onclick="return confirm('Bạn muốn xóa?')">Xóa</a></td>
            </tr>
        <?php endforeach;?>
    </tbody>
</table>