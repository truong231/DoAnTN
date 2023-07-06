<?php
    function price(){
        global $connect;
        $query="select * from price where status=1";
        return $connect->query($query);
    }
    $result=price();
?>
<section class="col-md-12">
    <section class="left">
        <?php foreach($result as $rs):?>
            <section class="filter">
                <a href="?request=search&rangePrice=<?=$rs['rangePrice']?>" style="text-decoration: none;"><?=$rs['rangePrice']?></a>
            </section>
        <?php endforeach;?>
    </section>
</section>