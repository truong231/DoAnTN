<?php
     $query="select*from news order by writeday desc";
     $result=$connect->query($query);
?>

<aside class="col-md-3" style="margin:210px 50px">
<table class="table table-bordered">
    <tbody>
    <tr>
    <td colspan="2"><h5 style="text-align: center">TIN TỨC MỚI</h5></td>
    </tr>
    <?php foreach($result as $item):?>
        <tr>
            <td width="200px"><a href="?request=detailnews&newsId=<?=$item['id']?>"><img src="images/<?=$item['image']?>" width="100%"></a></td>
            <td>
                <a href="?request=detailnews&newsId=<?=$item['id']?>"><?=$item['title']?></a><br>
                <span style="font-size: 14px; color: green;"><?=$item['writer']?><br><?=$item['writeday']?></span>
            </td>
        </tr>
    <?php endforeach;?>
    </tbody>
</table>
</aside>