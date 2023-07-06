<?php
    function price(){
        global $connect;
        $query="select * from price where status=1";
        return $connect->query($query);
    }
    $result=price();
?>
<section class="col-md-12">
    <section>
        <?php foreach($result as $rs):?>
            <section>
                <a href="?request=search&rangePrice=<?=$rs['rangePrice']?>"><?=$rs['rangePrice']?></a>
            </section>
        <?php endforeach;?>
    </section>
</section>