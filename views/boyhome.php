<?php
    $query="select * from products where gender='nam' and status=1 order by addday desc";
    $result=$connect->query($query);
?>
<section class="bc">
    <div class="row"> 
        <div class="btn-group btn-breadcrumb"> <a href="index.php" class="btn btn-default"><i class="fa fa-home" aria-hidden="true"></i></a> <a href="main.php" class="btn btn-default">Sản phẩm mới</a> <a href="boyfashion.php" class="btn btn-default">Bé trai</a>
        </div> 
    </div> 
</section><hr>
<?php include"product.php"?>