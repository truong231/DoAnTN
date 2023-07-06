<?php
    function search(){
        global $connect;
        $query="select*from products where status=1 ";
        if(isset($_POST['keyword'])){
            $query.="and productName like '%".$_POST['keyword']."%'";
        }
        if(isset($_GET['rangePrice'])){
            $rangePrice=$_GET['rangePrice'];
            $range=preg_split('[\s]', $rangePrice);
            $from=0;
            $to=0;
            if($range[0]=='Trên'){
                $from=$range[1];
            }
            elseif($range[0]=='Dưới'){
                $to=$range[1];
            }
            else{
                $range1=preg_split('[\-]', $range[0]);
                $from=$range1[0];
                $to=$range1[1];
            }
            if($to==0){
                $query.="and price>$from";
            }
            elseif($from==0){
                $query.="and price<$to";
            }
            else{
                $query.="and price>=$from and price<=$to";
            }
        }
        if(isset($_GET['size'])){
            $query.="and size=".$_GET['size'];
        }
        $result=$connect->query($query);
        return $result;
    }
    $result=search();
?>
<?php if(isset($_POST['keyword'])):?>
    <div style="margin: 30px 30px; color: gray">Kết quả tìm kiếm cho từ khóa "<span style="font-weight: bold"><?=$_POST['keyword']?></span>" :</div>
<?php endif;?>
<?php
    include"product.php";
?>