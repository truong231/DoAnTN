<article class="col-md-8" style="margin-top:210px">
        <?php
            if(isset($_GET['option'])){
                switch($_GET['option']){
                    case'logout':
                        unset($_SESSION['user']);
                        header("Location: .");
                        break;
                    case'search':
                        include"views/search.php";
                        break;
                    case'cart':
                        include"views/cart.php";
                        break;
                    case'intro':
                        include"views/introshop.php";
                        break;
                    case'trademark':
                        include"views/trademark.php";
                        break;
                    case'system':
                        include"views/systemshop.php";
                        break;
                    case'policy':
                        include"views/policy.php";
                        break;
                    case'contact':
                        include"views/contact.php";
                        break;
                }
            }else{
                include"views/introshop.php";
            }
        ?>
</article>
