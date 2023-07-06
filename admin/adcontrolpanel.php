<?php
    $chuaXuLy=mysqli_num_rows($connect->query("select*from orders where status=1"));
    $dangXuLy=mysqli_num_rows($connect->query("select*from orders where status=2"));
    $daXuLy=mysqli_num_rows($connect->query("select*from orders where status=3"));
    $huy=mysqli_num_rows($connect->query("select*from orders where status=4"));
?>

<table class="table table-bordered tbl-admin">
    <tbody>
        <tr>
            <td style="font-weight:bold; color:white; background: black; text-align: center; left: 0; max-width: 100%; overflow: visible; position: fixed !important; top: 0; width: 100%; z-index: 1000" height="150"><h2>BẢNG ĐIỀU KHIỂN HỆ THỐNG</h2><br>Xin chào: <?=$_SESSION['user']?><br>[<a href="?option=logout">Đăng xuất</a>]</td>
        </tr>
        <tr>
            <td style="background: white; height: 100%; left: 0; margin-top: 150px; max-width: 100%; overflow: visible; position: fixed !important; top: 0; width: 19%; z-index: 1000">
                <section><a href="?option=adstatistic"><i class="fas fa-tachometer-alt"></i> Thống kê</a></section><hr>
                <section><a href="?option=account"><i class="fas fa-user-circle"></i> Tài khoản người dùng</a></section><hr>
                <section><a href="?option=product"><i class="fab fa-product-hunt"></i> Sản phẩm</a></section><hr>
                <section><a href="?option=producttype"><i class="fab fa-product-hunt"></i>Loại sản phẩm</a></section><hr>
                <section><a href="?option=price"><i class="fas fa-tags"></i> Giá sản phẩm</a></section><hr>
                <section><a href="?option=method"><i class="fas fa-money-check-alt"></i> Phương thức thanh toán</a></section><hr>
                <section><a href="?option=news"><i class="fas fa-newspaper"></i> Tin tức</a></section><hr>
                <section><a href="?option=comment"><i class="fas fa-comments"></i> Phản hồi</a></section><hr>
                <section>
                    <section style="display: flex">
                    <div class="accordion_f">
                    <div class="accordion_f-item">
                        <div class="accordion_f-header">
                            <i class="fas fa-cart-arrow-down"></i>&nbsp;Đơn hàng
                            <i class="fas fa-angle-down"></i>
                        </div>
                        <div class="accordion_f-body">
                            <section><a href="?option=order&status=1">+ Đơn hàng chưa xử lý [<span style="color: red"><?=$chuaXuLy?></span>]</a></section>
                            <section><a href="?option=order&status=2">+ Đơn hàng đang xử lý [<span style="color: red"><?=$dangXuLy?></span>]</a></section>
                            <section><a href="?option=order&status=3">+ Đơn hàng đã xử lý [<span style="color: red"><?=$daXuLy?></span>]</a></section>
                            <section><a href="?option=order&status=4">+ Đơn hàng hủy [<span style="color: red"><?=$huy?></span>]</a></section>
                        </div>
                    </div>
                    </div>
                    </section>
                </section><hr>
            </td>
            <td style="background: rgb(250, 244, 255); padding-left: 20%; padding-top: 180px">
                <?php
                    if(isset($_GET['option'])){
                        switch($_GET['option']){
                            case'logout':
                                unset($_SESSION['user']);
                                header("Location: ..");
                                break;   
                            case'price':
                                include"price/showprice.php";
                                break;
                            case'priceadd':
                                include"price/priceadd.php";
                                break;
                            case'priceupdate':
                                include"price/priceupdate.php";
                                break;
                            case'product':
                                include"products/showproducts.php";
                                break;
                            case'productadd':
                                include"products/productadd.php";
                                break;
                            case'productupdate':
                                include"products/productupdate.php";
                                break;
                            case'news':
                                include"news/shownews.php";
                                break;
                            case'newsadd':
                                include"news/newsadd.php";
                                break;
                            case'newsupdate':
                                include"news/newsupdate.php";
                                break;
                            case'account':
                                include"account/showaccount.php";
                                break;
                            case'activeuser':
                                include"account/activeuser.php";
                                break;
                            case'order':
                                include"orders/showorders.php";
                                break;
                            case'orderdetail':
                                include"orders/orderdetail.php";
                                break;
                            case'comment':
                                include"comments/showcomment.php";
                                break;
                            case'statuscomment':
                                include"comments/statuscomment.php";
                                break;
                            case'method':
                                include"paymentmethod/showmethod.php";
                                break;
                            case'methodadd':
                                include"paymentmethod/methodadd.php";
                                break;
                            case'methodupdate':
                                include"paymentmethod/methodupdate.php";
                                break;
                            case'adstatistic':
                                include"adstatistic/statistic.php";
                                break;
                            case'producttype':
                                include"producttype/producttype.php";
                                break;
                        }
                    }else{
                        include"adstatistic/statistic.php";
                    }
                ?>
            </td>
        </tr>
    </tbody>
</table>