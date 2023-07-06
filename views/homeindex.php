<?php
    $query="select * from products where status=1 order by addday desc";

    //$page: xem sản phẩm ở trang số bao nhiêu
    $page=1;
    if(isset($_GET['page'])){
        $page=$_GET['page'];
    }
    //số lượng sản phẩm mỗi trang
    $productsperpage=8;
    //lấy các sản phẩm bắt đầu từ chỉ số bao nhiêu trong bảng (0 tức là bắt đầu từ bản ghi đầu tiên)
    $from=($page-1)*$productsperpage;
    //lấy tổng số sản phẩm
    $totalProducts=$connect->query($query);
    //tính tổng số trang có được
    $totalPages=ceil(mysqli_num_rows($totalProducts)/$productsperpage);
    //lấy các sản phẩm ở trang hiện thời
    $query.=" limit $from,$productsperpage";
    $result=$connect->query($query);
?>
<?php include"productindex.php"?>
