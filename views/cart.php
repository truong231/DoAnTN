<?php
    if(empty($_SESSION['cart'])){
        $_SESSION['cart']=array();
    }
    if(isset($_GET['action'])){
        switch($_GET['action']){
            case'add':
                $productId=$_GET['productId'];
                if(array_key_exists($productId, $_SESSION['cart'])){
                    if(isset($_POST['number'])){
                        $_SESSION['cart'][$productId]+=$_POST['number'];
                    }else{
                        $_SESSION['cart'][$productId]++;
                    }
                }else{
                    if(isset($_POST['number'])){
                        $_SESSION['cart'][$productId]+=$_POST['number'];
                    }else{
                        $_SESSION['cart'][$productId]=1;
                    } 
                }
                header("location:?request=cart");
                break;
            case'delete':
                $productId=$_GET['productId'];
                unset($_SESSION['cart'][$productId]);
                break;
            case'deleteAll':
                unset($_SESSION['cart']);
                break;
            case'update':
                foreach(array_keys($_SESSION['cart']) as $key):
                    $_SESSION['cart'][$key]=$_POST[$key];
                endforeach;
                break;
            case'payment':
                if(isset($_SESSION['user'])):
                    header('location:?request=payment');
                else:
                    header('location:login.php?&payment=1');
                endif;
                break;
        }
    }
?>
<?php 
    if(isset($_SESSION['cart']) && $_SESSION['cart']!=null):
    ?>
        <form method="post" action="?request=cart&action=update">
        <?php
            $listId='0';
            foreach(array_keys($_SESSION['cart']) as $key):
                $listId.=','.$key;
            endforeach;
            $query="select*from products where id in($listId)";
            $result=$connect->query($query);
            $total=0;
            if(mysqli_num_rows($result)>0):
            ?>
                <section class="container-fluid row cartTitle">
                    <section class="col-md-2">Ảnh</section>
                    <section class="col-md-2">Tên sản phẩm</section>
                    <section class="col-md-2">Giá</section>
                    <section class="col-md-2">Số lượng</section>
                    <section class="col-md-1">thuế(VAT)</section>
                    <section class="col-md-2">Tổng phụ</section>
                    <section class="col-md-1">Tùy chọn</section>
                </section>
                <hr>
            <?php
                foreach($result as $rs):
            ?>
                <section class="container-fluid row cart">
                    <section class="col-md-2">
                        <img src="images/<?=$rs['image']?>" width="50%">
                    </section>
                    <section class="col-md-2">
                        <?=$rs['productName']?>
                    </section>
                    <?php if($rs['sale']==0):?>
                    <section class="col-md-2">
                        <?=number_format($rs['price'],0,',','.')?> ₫
                    </section>
                    <?php else:?>
                    <section class="col-md-2">
                        <?=number_format($rs['price']-($rs['price']*$rs['sale']/100),0,',','.')?> ₫
                    </section>
                    <?php endif;?>
                    <section class="col-md-2">
                        <center><div class="col-md-3">
                            <input type="number" name="<?=$rs['id']?>" class="form-control" value="<?=$_SESSION['cart'][$rs['id']]?>" min="1" max="99">
                        </div></center>
                    </section>
                    <section class="col-md-1">
                        <?=$rs['VAT']?>%
                    </section>
                    <?php if($rs['sale']==0):?>
                    <section class="col-md-2">
                        <?=number_format($subTotal=($rs['price']+($rs['price']*$rs['VAT']/100))*$_SESSION['cart'][$rs['id']],0,',','.')?> ₫
                    </section>
                    <?php else:?>
                    <section class="col-md-2">
                        <?=number_format($subTotal=(($rs['price']-($rs['price']*$rs['sale']/100))+($rs['price']*$rs['VAT']/100))*$_SESSION['cart'][$rs['id']],0,',','.')?> ₫
                    </section>
                    <?php endif;?>
                    <section class="col-md-1">
                        <a href="order.php?request=cart&action=delete&productId=<?=$rs['id']?>" onclick="return confirm('Bạn muốn xóa sản phẩm này khỏi giỏ hàng?');" class="btn btn-outline-danger btn-sm">Xóa</a>
                    </section>
                    <hr>
                </section>
                <?php $total+=$subTotal;?>
            <?php
                endforeach;
            endif;
            ?>
            <section style="float: right;margin-right: 159px;font-weight: bold;">
                <label>Tổng tiền:  </label>
                <?=number_format($total,0,',','.')?> ₫
            </section><br>
            <hr>
            <section style="float: right;margin-right: 39px;">
                <a href="?request=cart&action=deleteAll" class="btn btn-outline-info" onclick="return confirm('Bạn muốn xóa giỏ hàng?');">Xóa giỏ hàng</a>&nbsp;
                <input type="submit" value="Cập nhật giỏ hàng" class="btn btn-primary">&nbsp;
                <a href="order.php?request=cart&action=payment" class="btn btn-warning">Thanh toán</a>
            </section>
        </form>
    <?php
    else:
    ?>
        <section class="alert alert-info" style="text-align: center;">GIỎ HÀNG TRỐNG!</section>
    <?php
    endif;
?>