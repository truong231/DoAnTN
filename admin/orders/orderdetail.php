<?php
    if(isset($_GET['action'])){
        $condition=" where orderId=".$_GET['orderId']." and productId=".$_GET['productId'];
        if($_GET['type']=='asc'){
            $query="update orderdetail set quantity=quantity+1".$condition;
        }else{
            $query="update orderdetail set quantity=quantity-1".$condition;
        }
        $connect->query($query);
        header("Location: ?option=orderdetail&id=".$_GET['id']);
    }

    if(isset($_POST['status'])){
        $connect->query("update orders set status=".$_POST['status']." where id=".$_GET['id']);
        header("Refresh:0");
    }
?>

<?php
    $query="select a.fullName,a.phone as 'phoneuser',a.address as 'addressuser',a.email as 'emailuser',b.*,c.paymentName from users a join orders b on a.id=b.userId join paymentmethods c on b.paymentMethodId=c.id where b.id=".$_GET['id'];
    $order=mysqli_fetch_array($connect->query($query));
?>

<h2>CHI TIẾT ĐƠN HÀNG<br>(Mã đơn hàng: <?=$order['id']?>)</h2>
<h5>THỜI GIAN TẠO ĐƠN</h5>
<p><?=$order['orderDate']?></p>
<h3>THÔNG TIN NGƯỜI ĐẶT HÀNG</h3>
<table class="table">
    <tbody>
        <tr>
            <td>Họ tên: </td>
            <td><?=$order['fullName']?></td>
        </tr>
        <tr>
            <td>Số điện thoại: </td>
            <td><?=$order['phoneuser']?></td>
        </tr>
        <tr>
            <td>Địa chỉ: </td>
            <td><?=$order['addressuser']?></td>
        </tr>
        <tr>
            <td>Email: </td>
            <td><?=$order['emailuser']?></td>
        </tr>
        <tr>
            <td>Ghi chú: </td>
            <td><?=$order['note']?></td>
        </tr>
    </tbody>
</table>
<h3>THÔNG TIN NGƯỜI NHẬN HÀNG</h3>
<table class="table">
    <tbody>
        <tr>
            <td>Họ tên: </td>
            <td><?=$order['customerName']?></td>
        </tr>
        <tr>
            <td>Số điện thoại: </td>
            <td><?=$order['phone']?></td>
        </tr>
        <tr>
            <td>Địa chỉ: </td>
            <td><?=$order['address']?></td>
        </tr>
        <tr>
            <td>Email: </td>
            <td><?=$order['email']?></td>
        </tr>
    </tbody>
</table>
<h3>PHƯƠNG THỨC THANH TOÁN</h3>
<p><?=$order['paymentName']?></p>

<?php 
    $query="select b.*,c.productName,c.image,c.sale,c.VAT from orders a join orderdetail b on a.id=b.orderId join products c on b.productId=c.id where a.id=".$order['id'];
    $orderdetails=$connect->query($query);
?>
<form method="post">
    <h3>CÁC SẢN PHẨM ĐẶT MUA</h3>
    <?php $count=1;?>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>STT</th>
                <th>Tên sản phẩm</th>
                <th>Ảnh</th>
                <th>Giá</th>
                <th>Số lượng</th>
                <th>Thuế(VAT)</th>
                <th>Tổng tiền</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($orderdetails as $item):?>
            <tr>
                <td><?=$count++?></td>
                <td><?=$item['productName']?></td>
                <td width="30%"><img src="../images/<?=$item['image']?>" width='20%'></td>
                <?php if($item['sale']==0):?>
                    <td><?=number_format($item['price'],0,',','.')?></td>
                <?php else:?>
                    <td><?=number_format($item['price']-($item['price']*$item['sale']/100),0,',','.')?></td>
                <?php endif;?>
                <td><?=$item['quantity']?> <input type="button" value="+" onclick="location='?option=orderdetail&id=<?=$_GET['id']?>&action=update&type=asc&orderId=<?=$item['orderId']?>&productId=<?=$item['productId']?>';"> <input <?=$item['quantity']==0?'disabled':''?> type="button" value="-" onclick="location='?option=orderdetail&id=<?=$_GET['id']?>&action=update&type=desc&orderId=<?=$item['orderId']?>&productId=<?=$item['productId']?>';"></td>
                <td><?=$item['VAT']?>%</td>
                <?php if($item['sale']==0):?>
                    <td><?=number_format(($item['price']+($item['price']*$item['VAT']/100))*$item['quantity'],0,',','.')?></td>
                <?php else:?>
                    <td><?=number_format((($item['price']-($item['price']*$item['sale']/100))+($item['price']*$item['VAT']/100))*$item['quantity'],0,',','.')?></td>
                <?php endif;?>
            </tr>
            <?php endforeach;?>
        </tbody>
    </table>

    <h3>TRẠNG THÁI ĐƠN HÀNG</h3>
    <p style="display: <?=$order['status']==2 || $order['status']==3?'none':''?>"><input type="radio" name="status" value="1" <?=$order['status']==1?'checked':''?>> Chưa xử lý</p>
    <p style="display: <?=$order['status']==3?'none':''?>"><input type="radio" name="status" value="2" <?=$order['status']==2?'checked':''?>> Đang xử lý</p>
    <p><input type="radio" name="status" value="3" <?=$order['status']==3?'checked':''?>> Đã xử lý</p>
    <p style="display: <?=$order['status']==3?'none':''?>"><input type="radio" name="status" value="4" <?=$order['status']==4?'checked':''?>> Hủy</p>
    <section><input <?=$order['status']==3?'disabled':''?> type="submit" value="Chỉnh sửa đơn hàng" class="btn btn-primary"> <a href="?option=order&status=1" class="btn btn-outline-secondary"> &lt;&lt; Quay lại</a></section>
</form>
