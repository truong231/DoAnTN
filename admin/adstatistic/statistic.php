<?php
// Mở và thống kê số lượt có trong file txt
    $fp = "..\accesstimes.txt";
    $fo = fopen($fp, 'r');
    $fr = fread($fo, filesize($fp));
    $fr++;
    $fc = fclose($fo);

    // Mở và ghi lại số lượt bằng thuộc tính w, w++
    $fo = fopen($fp, 'w');
    $fw = fwrite($fo, $fr);
    $fc = fclose($fo);
?>

<table border="1px" width="250px" height="10px" align="right">
    <tr>
        <td>Số lượng truy cập Website</td>
        <td><?php echo $fr?></td>
    </tr>
</table>

<hr>
<h2>Tổng quan</h2>
<section class="container-fluid row">
    <section class="col-md-2" style="background: orange; text-align: center; color: white">
        <h5 style="margin-top: 10px">SẢN PHẨM</h5>
        <?php
            $products=$connect->query("select*from products where status=1");
            echo mysqli_num_rows($products);
        ?><br><hr>
        Bé trai:
        <?php
            $products=$connect->query("select*from products where gender='Nam' and status=1");
            echo mysqli_num_rows($products);
        ?><br>
        Bé gái:
        <?php
            $products=$connect->query("select*from products where gender='Nữ' and status=1");
            echo mysqli_num_rows($products);
        ?><br><hr>
        Còn hàng:
        <?php
            $products=$connect->query("select*from products where available=1 and status=1");
            echo mysqli_num_rows($products);
        ?><br>
        Hết hàng:
        <?php
            $products=$connect->query("select*from products where available=0 and status=1");
            echo mysqli_num_rows($products);
        ?><br><hr>
        Đang sale:
        <?php
            $products=$connect->query("select*from products where sale!=0 and status=1");
            echo mysqli_num_rows($products);
        ?><hr>
    </section>
    <section class="col-md-2" style="background: green; text-align: center; color: white">
        <h5 style="margin-top: 10px">TÀI KHOẢN</h5>
        <?php
            $products=$connect->query("select*from users where status");
            echo mysqli_num_rows($products);
        ?><hr>
        Quản trị viên:
        <?php
            $products=$connect->query("select*from users where keyAdmin=1 and status");
            echo mysqli_num_rows($products);
        ?><br>
        Khách hàng:
        <?php
            $products=$connect->query("select*from users where keyAdmin=0 and status");
            echo mysqli_num_rows($products);
        ?><hr>
        Đang khóa:
        <?php
            $products=$connect->query("select*from users where keyAdmin=0 and status=0");
            echo mysqli_num_rows($products);
        ?><hr>
    </section>
    <section class="col-md-2" style="background: violet; text-align: center; color: white">
        <h5 style="margin-top: 10px">ĐƠN HÀNG</h5>
        <?php
            $products=$connect->query("select*from orders where status");
            echo mysqli_num_rows($products);
        ?><hr>
        <?php
            $chuaXuLy=mysqli_num_rows($connect->query("select*from orders where status=1"));
            $dangXuLy=mysqli_num_rows($connect->query("select*from orders where status=2"));
            $daXuLy=mysqli_num_rows($connect->query("select*from orders where status=3"));
            $huy=mysqli_num_rows($connect->query("select*from orders where status=4"));
        ?>
        Chưa xử lý: <?=$chuaXuLy?><br><hr>
        Đang xử lý: <?=$dangXuLy?><br><hr>
        Đã xử lý: <?=$daXuLy?><br><hr>
        Hủy: <?=$huy?><br><hr>
    </section>
    <section class="col-md-2" style="background: darkviolet; text-align: center; color: white">
        <h5 style="margin-top: 10px">PHẢN HỒI</h5>
        <?php
            $products=$connect->query("select*from comments where status");
            echo mysqli_num_rows($products);
        ?><hr>
        Chưa duyệt:
        <?php
            $products=$connect->query("select*from comments where status=0");
            echo mysqli_num_rows($products);
        ?><hr>
        Đã duyệt:
        <?php
            $products=$connect->query("select*from comments where status=1");
            echo mysqli_num_rows($products);
        ?><hr>
    </section>
    <section class="col-md-2" style="background: darkblue; text-align: center; color: white">
        <h5 style="margin-top: 10px">ĐÁNH GIÁ</h5>
        <?php
            $products=$connect->query("select*from pr_rating where status");
            echo mysqli_num_rows($products);
        ?><hr>
    </section>
    <section class="col-md-2" style="background: darkred; text-align: center; color: white">
        <h5 style="margin-top: 10px">TIN TỨC</h5>
        <?php
            $products=$connect->query("select*from news where status=1");
            echo mysqli_num_rows($products);
        ?><hr>
    </section>
</section>

<hr>
<h2>Doanh thu</h2>
<section class="container-fluid">
    <section>
        Số đơn hàng đã thanh toán:
        <?php
            $daXuLy=mysqli_num_rows($connect->query("select*from orders where status=3"));
            echo $daXuLy;
        ?>
    </section>
    <section>
        Doanh thu:
        <?php
            $totals=$connect->query("select b.* from orders a join orderdetail b on a.id=b.orderId where status=3");
        ?>
        <?php
            $sum=0;
            foreach($totals as $total){
                $sum+=(($total['price']-($total['price']*$total['sale']/100))+($total['price']*$total['VAT']/100))*$total['quantity'];  
            }
            echo number_format($sum,0,',','.');
        ?> ₫
    </section><br><hr>
</section>