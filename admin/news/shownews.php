<?php
    if(isset($_GET['id'])){
        $id=$_GET['id'];
        $connect->query("delete from news where id=$id");
        unlink("../images/".$_GET['image']);
    }
?>

<?php
     $query="select*from news order by writeday desc";
     $result=$connect->query($query);
?>
<h2>DANH SÁCH TIN TỨC</h2></br>
<section style="text-align: center;"><a href="?option=newsadd" class="btn btn-success btn-sm">Thêm tin tức</a></section></br>
<table class="table table-bordered">
    <thead>
        <tr style="text-align: center">
            <th>STT</th>
            <th>Mã</th>
            <th>Tiêu đề</th>
            <th>Người viết</th>
            <th>Ngày viết</th>
            <th>Bài viết tóm tắt</th>
            <th>Bài viết đầy đủ</th>
            <th>Ảnh</th>
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
                <td width="100px"><?=$item['title']?></td>
                <td width="100px"><?=$item['writer']?></td>
                <td><?=$item['writeday']?></td>
                <td width="150px"><?=$item['summarynews']?></td>
                <td width="500px"><?=$item['fullnews']?></td>
                <td width="100px"><img src="../images/<?=$item['image']?>" width="100%"></td>
                <td><?=$item['status']==1?'Active':'Unactive'?></td>
                <td style="text-align: center"><a class="btn btn-sm btn-info" href="?option=newsupdate&id=<?=$item['id']?>">Chỉnh sửa</a> <a href="?option=product&id=<?=$item['id']?>&image=<?=$item['image']?>" class="btn btn-sm btn-danger" onclick="return confirm('Bạn muốn xóa?')">Xóa</a></td>
            </tr>
        <?php endforeach;?>
    </tbody>
</table>