<section class="container-fluid">
    <?php if(mysqli_num_rows($result)==0):?>
        <section class="alert alert-info" style="text-align: center">Không có sản phẩm nào!</section>
    <?php else:?>
        <?php foreach($result as $rs):?>
            <section class="col-md-3 product">
                <section class="img">
                    <?php if($rs['sale']!=0):?>
                        <h7 style="position: absolute; left: 10px; top: 10px; background: white; color: red; font-weight: bold; font-size:14px">&ensp;-<?=$rs['sale']?>%&ensp;</h7>
                    <?php endif;?>
                    <img src="images/<?=$rs['image']?>" style="border-radius: 4%" width="100%" height="100%">
                    <a href="order.php?request=detail&productId=<?=$rs['id']?>">
                        <div class="overlay" style="border-radius: 4%">
                            <div class="text" style="font-family: sans; font-size: 24px; font-weight: bold; color: rgba(0, 217, 255, 0.8)">Lanlankids</div>
                        </div>
                    </a>
                </section><br>
                <section>
                        <div style="font-size: 14px"><?=$rs['productName']?></div>
                </section><br>
                <section>
                    <span style="font-weight: bold; font-size: 14px; color: red"><?=number_format($rs['price']-($rs['price']*$rs['sale']/100),0,',','.')?> ₫</span>&ensp;&ensp;&ensp;
                    <span style="font-weight: bold; font-size: 14px; text-decoration: line-through; color: gray"><?=number_format($rs['price'],0,',','.')?> ₫</span>
                </section></br>
                <section>
                    <a href="order.php?request=detail&productId=<?=$rs['id']?>" class="btn btn-outline-primary" style="font-size: 11px">Chi tiết</a>
                </section>
            </section>
        <?php endforeach;?>
    <?php endif;?>
</section>