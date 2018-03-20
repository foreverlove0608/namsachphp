<?php 
    $action = new action();
    $rows = $action->getList('service','','','service_id','desc',$trang,4,'service-cat');
    print_r($rows);die;
?>
<link rel="stylesheet" type="text/css" href="/css/templates/news_tpl_RightBarService.css">
<ul class="listNewsLastestRight">
<?php foreach ($rows['data'] as $row) { ?>
    <li>
        <a href="/<?php echo $row['friendly_url'];?>" class="imgNLR"><img src="/images/<?php echo $row['service_img'];?>"></a>
        <div class="rightNLR">
            <a href="/<?php echo $row['friendly_url'];?>" class="nameNLR" style="width: 100%;"><?php echo $row['service_name'];?></a>
            <p class="dateNLR"><?php echo $row['service_update_date'];?></p>
        </div>
    </li>
<?php } ?>
    <!--
    <li>
        <a href="/" class="imgNLR"><img src="/images/r2.jpg"></a>
        <div class="rightNLR">
            <a href="/" class="nameNLR">Website có quảng cáo dụ cài ứng dụng di động sẽ bị google phạt</a>
            <p class="dateNLR">23:35 - 07/01/2016</p>
        </div>
    </li> -->
</ul>
