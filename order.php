<?php
    session_start();
    $connect=new MySQLi("localhost",'root','','lanlankids');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Lanlankids</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/css.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
	<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
</head>
<body>
    <section class="container-fluid">
        <?php include"layout/indexheader.php";?>
        <?php include"layout/menutop.php";?>
        <section class="container-fluid center">
            <?php include"layout/contentorder.php"?>
        </section>
        <?php include"layout/footer.php";?>
    </section>






    

	<script type="text/javascript" src="js/js.js"></script>
</body>
</html>