<?php
    if(isset($_POST['content'])):
        $content=$_POST['content'];
        $productId=$_GET['productId'];
        if(isset($_SESSION['user'])):
            $user=mysqli_fetch_array($connect->query("select*from users where username='".$_SESSION['user']."'"));
            $userId=$user['id'];
            $connect->query("insert comments(userId,productId,date,content) values($userId,$productId,now(),'$content')");
            echo"<script>alert('Bình luận của bạn đã được gửi đi và sẽ được hiển thị sớm!')</script>";
        else:
            $_SESSION['content']=$content;
            echo"<script>alert('Bạn cần đăng nhập để bình luận!');
                location='login.php?request=0&a&productId=$productId';</script>";
        endif;
    endif;
?>
<?php
    if(isset($_POST['starRatingId'])):
        $starRatingId=$_POST['starRatingId'];
        $productId=$_GET['productId'];
        if(isset($_SESSION['user'])):
            $user=mysqli_fetch_array($connect->query("select*from users where username='".$_SESSION['user']."'"));
            $userId=$user['id'];
            $query="select*from pr_rating where userId='$userId' and productId='$productId'";
            if(mysqli_num_rows($connect->query($query))==0):
                $connect->query("insert pr_rating(userId,productId,starRatingId) values($userId,$productId,'$starRatingId')");
            else:
                $connect->query("update pr_rating set starRatingId=$starRatingId where userId='$userId' and productId='$productId'");
            endif;
            echo"<script>alert('Cảm ơn bạn đã đánh giá sản phẩm của chúng tôi!')</script>";
        else:
            $_SESSION['starRatingId']=$starRatingId;
            echo"<script>alert('Bạn cần đăng nhập để đánh giá!');
                location='login.php?request=0&b&productId=$productId';</script>";
        endif; 
    endif;
?>
<?php
    $productId=$_GET['productId'];
    $query="select*from products where id='$productId'";
    $rs=$connect->query($query);
    $rs=mysqli_fetch_array($rs);
?>
<section class="container-fluid">
    <section class="container-fluid row">
        <section class="col-md-5">
            <img src="images/<?=$rs['image']?>" width="80%" style="margin:40px 20px;">
        </section>
        <section class="col-md-7">
            <section class="container-fluid" style="margin:40px 0; font-size:24px; font-weight:bold"><?=$rs['productName']?></section>
            <section class="container-fluid row" style="margin:40px 20px;">
                <section class="col-md-5" style="color:<?=$rs['available']==1?'green':'grey'?>"><?=$rs['available']==1?'Còn hàng':'Hết hàng'?></section>
                <?php if($rs['sale']==0):?>
                    <section class="col-md-7" style="text-align :right; font-weight:bold; font-size:20px"><?=number_format($rs['price'],0,',','.')?> ₫</section>
                <?php else:?>
                <section>
                    <div style="font-weight: bold; font-size: 20px; color: red; text-align :right"><?=number_format($rs['price']-($rs['price']*$rs['sale']/100),0,',','.')?> ₫</div>&ensp;&ensp;&ensp;
                    <div style="font-weight: bold; font-size: 20px; text-decoration: line-through; color: gray; text-align :right"><?=number_format($rs['price'],0,',','.')?> ₫</div>
                </section></br>
                <?php endif;?>
            </section>
            <hr>
            <section class="container-fluid" style="margin: 20px 0">Kích cỡ: <?=$rs['size']?>Y</section>
            <section class="container-fluid" style="margin: 20px 0">Giới tính: <?=$rs['gender']?></section>
            <section class="container-fluid" style="margin: 20px 0">Hãng: <?=$rs['brand']?></section>
            <section class="container-fluid" style="margin: 20px 0">
                <form method="post" action="order.php?request=cart&action=add&productId=<?=$rs['id']?>">
                    <label>Số lượng: </label>
                    <section style="display:inline-flex; width:30%;">
                        <input type="number" name="number" value="1" class="form-control" min="1" max="99">&nbsp;
                        <input type="submit" <?=$rs['available']==1?'':'disabled'?> value="Thêm vào giỏ hàng" class="btn btn-warning">
                    </section>
                </form>
            </section>
            <hr>
            <section class="container-fluid" style="font-weight:bold; font-size:20px">Mô tả</section>
            <section class="container-fluid" style="margin: 20px 0"><?=$rs['description']?></section>
            <h8 style="font-weight: bold">Hướng dẫn giặt là</h8>
            <ul>
                <li>Giặt máy dưới 30 độ C.</li>
                <li>Có thể Giặt khô.</li>
                <li>Không được: Tẩy.</li>
                <li>Sấy ở nhiệt độ dưới 60 độ C.</li>
                <li>Chỉ được là hơi nhiệt độ nhẹ</li>
            </ul>
        </section>
        <hr>
            <?php
                $starRating=$connect->query("select*from starrating where status order by numberStar desc");
                if(isset($_SESSION['user'])):
                    $user=mysqli_fetch_array($connect->query("select*from users where username='".$_SESSION['user']."'"));
                    $userId=$user['id'];
                    $prstrt=$connect->query("select*from pr_rating where productId='$productId' and userId='$userId'");
                else:
                    $prstrt=$connect->query("select*from pr_rating where productId='$productId' and userId='0'");
                endif; 
            ?>
            <h4 style="text-align: center; font-weight: bold; color: rgb(0, 107, 150)">Đánh giá</h4><br><br><br>
            <table class="container" style="margin-bottom: 30px">
            <tr>
                <td class="col-md-4">
            <?php if(mysqli_num_rows($prstrt)==0):?>
                <section class="rating">
                    <h6>Hãy cho chúng tôi biết đánh giá của bạn</h6>
                    <?php
                        foreach($starRating as $sr):
                    ?>
                    <form method="post">
                        <section class="form-group">
                                <input class="form-check-input" type="radio" name="starRatingId" value="<?=$sr['id']?>" <?=$sr['id']!=5?:'checked'?>> <span style="color: rgb(79, 202, 250); font-weight: bold"><?=$sr['numberStar']?></span>
                                <?php if($sr['id']==5):?>
                                    <i class="fas fa-star" style="color: rgba(0, 217, 255, 0.8)"></i>
                                    <i class="fas fa-star" style="color: rgba(0, 217, 255, 0.8)"></i>
                                    <i class="fas fa-star" style="color: rgba(0, 217, 255, 0.8)"></i>
                                    <i class="fas fa-star" style="color: rgba(0, 217, 255, 0.8)"></i>
                                    <i class="fas fa-star" style="color: rgba(0, 217, 255, 0.8)"></i>
                                <?php elseif($sr['id']==4):?>
                                    <i class="fas fa-star" style="color: rgba(0, 217, 255, 0.8)"></i>
                                    <i class="fas fa-star" style="color: rgba(0, 217, 255, 0.8)"></i>
                                    <i class="fas fa-star" style="color: rgba(0, 217, 255, 0.8)"></i>
                                    <i class="fas fa-star" style="color: rgba(0, 217, 255, 0.8)"></i>
                                <?php elseif($sr['id']==3):?>
                                    <i class="fas fa-star" style="color: rgba(0, 217, 255, 0.8)"></i>
                                    <i class="fas fa-star" style="color: rgba(0, 217, 255, 0.8)"></i>
                                    <i class="fas fa-star" style="color: rgba(0, 217, 255, 0.8)"></i>
                                <?php elseif($sr['id']==2):?>
                                    <i class="fas fa-star" style="color: rgba(0, 217, 255, 0.8)"></i>
                                    <i class="fas fa-star" style="color: rgba(0, 217, 255, 0.8)"></i>
                                <?php elseif($sr['id']==1):?>
                                    <i class="fas fa-star" style="color: rgba(0, 217, 255, 0.8)"></i>
                                <?php endif;?>
                        </section>
                        <?php endforeach;?><br>
                        <section class="form-group">
                            <input type="submit" value="Đánh giá" class="btn btn-success btn-sm">
                        </section>
                        </section>
                    </form>
                </section>
            <?php else:?>
                <section class="rating">
                    <h6>Đã đánh giá</h6>
                    <?php
                        foreach($starRating as $sr):
                    ?>
                    <?php
                        foreach($prstrt as $pt):
                    ?>
                    <form method="post">
                    <section>
                        <section class="form-group">
                                <input class="form-check-input" type="radio" name="starRatingId" value="<?=$sr['id']?>" <?=$sr['id']==$pt['starRatingId']?'checked':''?>> <span style="color: rgb(79, 202, 250); font-weight: bold"><?=$sr['numberStar']?></span>
                                <?php if($sr['id']==5):?>
                                    <i class="fas fa-star" style="color: rgba(0, 217, 255, 0.8)"></i>
                                    <i class="fas fa-star" style="color: rgba(0, 217, 255, 0.8)"></i>
                                    <i class="fas fa-star" style="color: rgba(0, 217, 255, 0.8)"></i>
                                    <i class="fas fa-star" style="color: rgba(0, 217, 255, 0.8)"></i>
                                    <i class="fas fa-star" style="color: rgba(0, 217, 255, 0.8)"></i>
                                <?php elseif($sr['id']==4):?>
                                    <i class="fas fa-star" style="color: rgba(0, 217, 255, 0.8)"></i>
                                    <i class="fas fa-star" style="color: rgba(0, 217, 255, 0.8)"></i>
                                    <i class="fas fa-star" style="color: rgba(0, 217, 255, 0.8)"></i>
                                    <i class="fas fa-star" style="color: rgba(0, 217, 255, 0.8)"></i>
                                <?php elseif($sr['id']==3):?>
                                    <i class="fas fa-star" style="color: rgba(0, 217, 255, 0.8)"></i>
                                    <i class="fas fa-star" style="color: rgba(0, 217, 255, 0.8)"></i>
                                    <i class="fas fa-star" style="color: rgba(0, 217, 255, 0.8)"></i>
                                <?php elseif($sr['id']==2):?>
                                    <i class="fas fa-star" style="color: rgba(0, 217, 255, 0.8)"></i>
                                    <i class="fas fa-star" style="color: rgba(0, 217, 255, 0.8)"></i>
                                <?php elseif($sr['id']==1):?>
                                    <i class="fas fa-star" style="color: rgba(0, 217, 255, 0.8)"></i>
                                <?php endif;?>
                        </section>
                        <?php endforeach;?>
                        <?php endforeach;?><br>
                        <section class="form-group" style="margin-left: -10px">
                            <input type="submit" value="Đánh giá" class="btn btn-success btn-sm">
                        </section>
                        </section>
                    </form>
                </section>
            <?php endif;?>
                </td>
                <td class="col-md-4">
                <center><section class="col-md-6" id style="background: whitesmoke; text-align: center; height: 250px; line-height: 250px; border-radius: 50%; box-shadow: 2px 1px 10px gray; color: grey; font-size: 40px; font-weight: bold">
                <?php
                    $query = "select avg(starRatingId) as avg from pr_rating where productId='".$productId."'";
                    $result = $connect->query($query);
                    while($row = mysqli_fetch_assoc($result)){
                        $avg = $row['avg'];
                    }
                    echo bcdiv($avg, 1, 1);
                ?>/5
                </section></center>
                </td>
                <td class="col-md-2" style="text-align: center; font-weight: bold; font-size: 21px">
                    <?php
                        $query="select*from pr_rating where productId='".$productId."'";
                        $result = $connect->query($query); 
                        echo mysqli_num_rows($result);
                    ?><br>Đánh giá<br>
                </td>
                <td class="col-md-2" style="text-align: left; font-weight: bold; color: gray">
                    5sao: <?php
                        $query="select*from pr_rating where productId='".$productId."' and starRatingId=5";
                        $result = $connect->query($query); 
                        echo mysqli_num_rows($result);
                    ?> Đánh giá<br><br>
                    4sao: <?php
                        $query="select*from pr_rating where productId='".$productId."' and starRatingId=4";
                        $result = $connect->query($query); 
                        echo mysqli_num_rows($result);
                    ?> Đánh giá<br><br>
                    3sao: <?php
                        $query="select*from pr_rating where productId='".$productId."' and starRatingId=3";
                        $result = $connect->query($query); 
                        echo mysqli_num_rows($result);
                    ?> Đánh giá<br><br>
                    2sao: <?php
                        $query="select*from pr_rating where productId='".$productId."' and starRatingId=2";
                        $result = $connect->query($query); 
                        echo mysqli_num_rows($result);
                    ?> Đánh giá<br><br>
                    1sao: <?php
                        $query="select*from pr_rating where productId='".$productId."' and starRatingId=1";
                        $result = $connect->query($query); 
                        echo mysqli_num_rows($result);
                    ?> Đánh giá
                </td>
                </tr>
        </table>
        <hr><br><br>
        <section class="container-fluid">
            <section style="padding-left: 40px">
                <h5 style="font-weight: bold; color: rgb(0, 107, 150); text-decoration: underline">Bình luận</h5>
                <?php
                    $comments=$connect->query("select*from users a join comments b on a.id=b.userId join products c on b.productId=c.id where b.status and productId=".$_GET['productId']);
                    if(mysqli_num_rows($comments)==0):
                        echo"<section style='color: green'>Không có bình luận nào liên quan.!</section>";
                    else:
                        foreach($comments as $comment):
                ?>
                            <section style="font-weight: bold"><?php echo mysqli_num_rows($comments);?> bình luận</section><br>
                            <section style="font-weight: bold; padding-left: 2%"><?=$comment['username']?>:</section>
                            <section style="padding-left: 3%">- <?=$comment['content']?></section>
                <?php
                        endforeach;
                    endif;
                ?><br><br>
                <form method="post">
                    <section>
                        <textarea name="content" style="width: 40%" rows="3" class="form-control" placeholder="Để lại ý kiến của bạn về sản phẩm của chúng tôi tại đây..."></textarea>
                    </section><br>
                    <section style="width: 40%; text-align: center"><input type="submit" value="Bình luận" class="btn btn-primary"></section>
                </form>
            </section><br>
        </section>
    </section><hr>
</section>