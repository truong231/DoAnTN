<?php
    if(isset($_GET['id'])){
        $id=$_GET['id'];
        $connect->query("delete from orderdetail where orderId=$id");
        $connect->query("delete from orders where id=$id");
        header("Location: ?option=order&status=4");
    }
?>

<?php
    $status=$_GET['status'];
     $query="select*from orders where status=$status order by orderDate desc";
     $result=$connect->query($query);
?>
<h2>DANH SÁCH ĐƠN HÀNG <?=$status==1?'CHƯA XỬ LÝ':($status==2?'ĐANG XỬ LÝ':($status==3?'ĐÃ XỬ LÝ':'HỦY'))?></h2></br>
<table class="table table-bordered">
    <thead>
        <tr style="text-align: center">
            <th>STT</th>
            <th>Mã</th>
            <th>Ngày tạo</th>
            <th>Tùy chọn</th>
        </tr>
    </thead>
    <tbody>
        <?php $count=1;?>
        <?php foreach($result as $item):?>
            <tr>
                <td><?=$count++?></td>
                <td><?=$item['id']?></td>
                <td><?=$item['orderDate']?></td>
                <td style="text-align: center"><a class="btn btn-sm btn-info" href="?option=orderdetail&id=<?=$item['id']?>">Chi tiết</a> <a style="display:<?=$status==4?'':'none'?>" href="?option=order&id=<?=$item['id']?>" class="btn btn-sm btn-danger" onclick="return confirm('Bạn muốn xóa?')">Xóa</a></td>
            </tr>
        <?php endforeach;?>
    </tbody>
</table>