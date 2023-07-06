<article class="container-fluid" style="width: 100%; margin-top: 10px">
        <?php if(mysqli_num_rows($result)==0):?>
            <section class="alert alert-info" style="text-align: center">Không có sản phẩm nào!</section>
        <?php else:?>
            <h1 style="text-align: center">Sản phẩm mới nhất</h1><hr>
            <?php foreach($result as $rs):?>
                <section class="col-md-2 productindex">
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
                    <?php if($rs['sale']==0):?>
                    <section>
                        <div style="font-weight: bold; font-size: 14px"><?=number_format($rs['price'],0,',','.')?> ₫</div>
                    </section></br>
                    <?php else:?>
                    <section>
                        <span style="font-weight: bold; font-size: 14px; color: red"><?=number_format($rs['price']-($rs['price']*$rs['sale']/100),0,',','.')?> ₫</span>&ensp;&ensp;&ensp;
                        <span style="font-weight: bold; font-size: 14px; text-decoration: line-through; color: gray"><?=number_format($rs['price'],0,',','.')?> ₫</span>
                    </section></br>
                    <?php endif;?>
                    <section>
                        <a href="order.php?request=detail&productId=<?=$rs['id']?>" class="btn btn-outline-primary" style="font-size: 11px">Chi tiết</a>
                    </section>
                </section>
            <?php endforeach;?>
        <?php endif;?>
    <section class="pages">
        <?php
            for($i=1; $i<=$totalPages; $i++):?>
            <a class="<?=(empty($_GET['page'])&&$i==1)||(isset($_GET['page'])&&$_GET['page']==$i)?'highlight':''?>" style="color: white" href="?page=<?=$i?>"><?=$i?></a> 
        <?php endfor;?>
    </section>
</article><br>
<?php
    $qr="select * from news where status=1 order by writeday desc limit 3";
    $resultnews=$connect->query($qr);
?>
<article>
<h1 style="text-align: center; margin-top: 20px">Tin tức mới nhất</h1>
<p style="text-align: center">Khám phá những xu hướng và thông tin mới nhất.</p><hr>
        <?php foreach($resultnews as $item):?>
            <section class="col-md-3 newsindex">
                <section class="img">
                    <a href="news.php?request=detailnews&newsId=<?=$item['id']?>"><img src="images/<?=$item['image']?>" style="border-radius: 4%" width="100%"></a>
                </section>
                <section>
                    <span style="font-weight: bold; font-size: 18px;"><a href="news.php?request=detailnews&newsId=<?=$item['id']?>"><?=$item['title']?></a></span>
                </section><br>
                <section>
                    <span style="font-size: 14px; color: green;">Người viết: <?=$item['writer']?> / <?=$item['writeday']?></span>
                </section></br>
                <section>
                    <?=$item['summarynews']?>
                </section>
                <section>
                    <a href="news.php?request=detailnews&newsId=<?=$item['id']?>" style="color: red; font-size: 16px; text-decoration: underline; float: right">Xem thêm</a>
                </section>
            </section>
        <?php endforeach;?>
        </article>
