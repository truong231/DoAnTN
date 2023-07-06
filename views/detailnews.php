<?php
    $newsId=$_GET['newsId'];
    $query="select*from news where id='$newsId'";
    $rs=$connect->query($query);
    $rs=mysqli_fetch_array($rs);
?>
<section class="container-fluid">
<table class="table table-nobordered">
        <h4>Tin tức</h4></br>
    <tbody>
        <tr>
            <td width="600px" colspan="2"><img src="images/<?=$rs['image']?>" width="70%"></td>
        </tr>
        <tr>
            <td>
                <span style="font-weight: bold; font-size: 20px;"><?=$rs['title']?></span><br>
                &ensp;<span style="font-size: 14px; color: gray;">Người viết: <?=$item['writer']?></span><br><br>
                <?=$rs['fullnews']?>
            </td>
        </tr>
    </tbody>
</table>
</section>