<?php
    if(isset($_GET['id'])){
        $id=$_GET['id'];
        $connect->query("delete from paymentmethods where id=$id");
    }
?>

<?php
     $query="select*from paymentmethods";
     $result=$connect->query($query);
?>
<h2>PHƯƠNG THỨC THANH TOÁN</h2></br>
<section style="text-align: center;"><a href="?option=methodadd" class="btn btn-success btn-sm">Thêm phương thức</a></section></br>
<table class="table table-bordered">
    <thead>
        <tr style="text-align: center">
            <th>STT</th>
            <th>Mã phương thức</th>
            <th>Tên phương thức</th>
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
                <td><?=$item['paymentName']?></td>
                <td><?=$item['status']==1?'Active':'Unactive'?></td>
                <td style="text-align: center"><a class="btn btn-sm btn-info" href="?option=methodupdate&id=<?=$item['id']?>">Chỉnh sửa</a> <a href="?option=method&id=<?=$item['id']?>" class="btn btn-sm btn-danger" onclick="return confirm('Bạn muốn xóa?')">Xóa</a></td>
            </tr>
        <?php endforeach;?>
    </tbody>
</table>