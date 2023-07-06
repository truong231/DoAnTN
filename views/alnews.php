<section class="container-fluid">
    <?php if(mysqli_num_rows($result)==0):?>
        <section class="alert alert-info" style="text-align: center">Không có tin tức nào!</section>
    <?php else:?>
        <table class="table table-nobordered">
        <h4>Tin tức</h4></br>
    <tbody>
    <?php foreach($result as $item):?>
        <tr>
            <td width="400px">
                <a href="?request=detailnews&newsId=<?=$item['id']?>"><img src="images/<?=$item['image']?>" width="100%"></a>
            </td>
            <td>
                <span style="font-weight: bold; font-size: 20px;"><a href="?request=detailnews&newsId=<?=$item['id']?>"><?=$item['title']?></a></span><br>
                &ensp;<span style="font-size: 14px; color: green;">Người viết: <?=$item['writer']?> / <?=$item['writeday']?></span><br><br>
                <?=$item['summarynews']?>
            </td>
        </tr>
    <?php endforeach;?>
    </tbody>
</table>
    <?php endif;?>
</section>