<?php
    if(isset($_GET['id'])){
        $id=$_GET['id'];
        $connect->query("delete from comments where id=$id");
    }
?>

<?php
     $query="select*from comments order by date desc";
     $result=$connect->query($query);
?>
<h2>DANH SÁCH BÌNH LUẬN</h2></br>
<table class="table table-bordered">
    <thead>
        <tr style="text-align: center">
            <th>STT</th>
            <th>Mã</th>
            <th>Id người dùng</th>
            <th>Id sản phẩm</th>
            <th>Thời gian</th>
            <th>Nội dung</th>
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
                <td><?=$item['userId']?></td>
                <td><?=$item['productId']?></td>
                <td><?=$item['date']?></td>
                <td><?=$item['content']?></td>
                <td><?=$item['status']==1?'Active':'Unactive'?></td>
                <td style="text-align: center"><a class="btn btn-sm btn-info" href="?option=statuscomment&id=<?=$item['id']?>">Duyệt</a> <a href="?option=comment&id=<?=$item['id']?>" class="btn btn-sm btn-danger" onclick="return confirm('Bạn muốn xóa bình luận của người dùng này?')">Xóa</a></td>
            </tr>
        <?php endforeach;?>
    </tbody>
</table>