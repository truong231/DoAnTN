<?php
    function size(){
        global $connect;
        $query="select * from size where status=1";
        return $connect->query($query);
    }
    $result=size();
?>
<section class="col-md-12">
    <section class="left" style="text-align: center; font-weight: bold">
        <form>
            <input type="hidden" name="request" value="search">
            <input type="range" name="size" min="3" max="14" step="1" oninput="document.getElementById('max').innerHTML=this.value;" value="<?=isset($_GET['size'])?$_GET['size']:""?>"><br><span id="max"><?=isset($_GET['size'])?$_GET['size']:""?> tuổi</span><br><br>
            <input class="btn btn-primary btn-sm" type="submit" value="tìm kiếm">
        </form>
    </section>
</section>