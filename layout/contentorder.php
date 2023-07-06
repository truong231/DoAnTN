<article class="col-md-12">
        <?php
            if(isset($_GET['request'])){
                switch($_GET['request']){
                    case'logout':
                        unset($_SESSION['user']);
                        header("Location: .");
                        break;
                    case'search':
                        include"views/search.php";
                        break;
                    case'detail':
                        include"views/productdetail.php";
                        break;
                    case'cart':
                        include"views/cart.php";
                        break;
                    case'payment':
                        include"views/payment.php";
                        break;
                }
            }else{
                include"views/homeindex.php";
            }
        ?>
</article>