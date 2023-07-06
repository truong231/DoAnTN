<article class="col-md-7" style="margin-top:210px">
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
                    case'detailnews':
                        include"views/detailnews.php";
                        break;
                    case'cart':
                        include"views/cart.php";
                        break;
                }
            }else{
                include"views/sumnews.php";
            }
        ?>
</article>