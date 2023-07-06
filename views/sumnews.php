<?php
    $query="select * from news where status=1";
    $result=$connect->query($query);
?>
<?php include"alnews.php"?>