<?php
    session_start();
    $connect=new MySQLi("localhost",'root','','lanlankids');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Control Panel</title>
    <link rel="stylesheet" type="text/css" href="css/css.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
	<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="../public/ckeditor/ckeditor.js"></script>
</head>
<body>
    <section>
        <?php
            include"adcontrolpanel.php";
        ?>
    </section>
    <script type="text/javascript" src="js/js.js"></script>
</body>
</html>
