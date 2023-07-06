<?php
    if(isset($_GET['id'])){
        $id=$_GET['id'];
        $keyadmin=$connect->query("select * from users where id=$id");
        $keyadmin=mysqli_fetch_array($keyadmin);
        if(($keyadmin['keyAdmin'])==1){
            echo"<script>alert('Không thể xóa tài khoản Admin!');</script>";
        }else{
            $customer=$connect->query("select*from orders where userId=$id");
            if(mysqli_num_rows($customer)!=0){
                $connect->query("update users set status=0 where id=$id");
            }else{
                $connect->query("delete from users where id=$id");
            }
        }
    }
?>

<?php
     $query="select*from users";
     $result=$connect->query($query);
?>
<h2>DANH SÁCH TÀI KHOẢN</h2></br>
<table class="table table-bordered">
    <thead>
        <tr style="text-align: center">
            <th>STT</th>
            <th>Mã</th>
            <th>Tên người dùng</th>
            <th>Họ và tên</th>
            <th>Số điện thoại</th>
            <th>Email</th>
            <th>Địa chỉ</th>
            <th>Trạng thái</th>
            <th>Quyền hạn</th>
            <th>Tùy chọn</th>
        </tr>
    </thead>
    <tbody>
        <?php $count=1;?>
        <?php foreach($result as $item):?>
            <tr>
                <td><?=$count++?></td>
                <td><?=$item['id']?></td>
                <td><?=$item['username']?></td>
                <td><?=$item['fullName']?></td>
                <td><?=$item['phone']?></td>
                <td><?=$item['email']?></td>
                <td style="width: 150px"><?=$item['address']?></td>
                <td><?=$item['status']==1?'Active':'Unactive'?></td>
                <td><?=$item['keyAdmin']==1?'Admin':'Khách hàng'?></td>
                <td style="text-align: center"><a class="btn btn-sm btn-info" href="?option=activeuser&id=<?=$item['id']?>">Chỉnh sửa</a> <a href="?option=account&id=<?=$item['id']?>" class="btn btn-sm btn-danger" onclick="return confirm('Bạn muốn xóa tài khoản của khách hàng này?')">Xóa</a></td>
            </tr>
        <?php endforeach;?>
    </tbody>
</table>