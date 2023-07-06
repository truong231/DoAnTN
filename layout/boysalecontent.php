<article class="col-md-9">
        <?php
            if(isset($_GET['request'])){
                switch($_GET['request']){
                    case'logout':
                        unset($_SESSION['user']);
                        header("Location: .");
                        break;
                    case'search':
                        include"views/boysalesearch.php";
                        break;
                    case'detail':
                        include"views/productdetail.php";
                        break;
                    case'cart':
                        include"views/cart.php";
                        break;
                }
            }else{
                include"views/boysalehome.php";
            }
        ?>
</article>