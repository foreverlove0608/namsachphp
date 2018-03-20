
<link rel="stylesheet" type="text/css" href="/css/templates/service_tpl_listServiceCate.css">
<?php 
    $action = new action();
    $action_service = new action_service();     
    if (isset($_GET['slug']) && $_GET['slug'] != '') {
        $slug = $_GET['slug'];                    
        $rowCatLang = $action_service->getServiceCatLangDetail_byUrl($slug,$lang);
        $rowCat = $action_service->getServiceCatDetail_byId($rowCatLang['servicecat_id'],$lang);
        // if ($rowCat['newscat_id'] > 1) $rowsCatSub = $action->getList('newscat','newscat_parent',$rowCatLang['newscat_id'],'newscat_id','desc',$trang,12,'newsCat-cat');
        $rows = $action_service->getServiceList_byMultiLevel_orderServiceId($rowCat['servicecat_id'],'desc',$trang,12,$rowCat['friendly_url']);
    }
    else $rows = $action->getList('service','','','service_id','desc',$trang,12,'service-cat'); 
?>
<div class="row">
    <div class="col-md-12">                   
        <h2 class="titleServiceCate">DỊCH VỤ CỦA CHÚNG TÔI</h2>
        <p class="desServiceCate">Để đáp ứng nhu cầu thị trường, sự đa dạng của các sản phẩm. trong năm 2016 ngoài kinh doanh sản phẩm than nội địa ban lãnh đạo công ty đã mạnh dạn đầu tư đây chuyền máy móc để sản xuất nồi hơi công nghiệp theo hướng hiện đại hóa với sản phẩm cốt lõi là <strong>nồi hơi tầng sôi đốt đa nguyên liệu</strong>.</p>        
    </div>                            
</div>
<div class="row">
<?php 
    $dem = 0;
    foreach ($rows['data'] as $row) {
        $dem++;
        $action_service1 = new action_service(); 
        $rowLang1 = $action_service1->getServiceLangDetail_byId($row['service_id'],$lang);
        $row1 = $action_service1->getServiceDetail_byId($row['service_id'],$lang);
?>
    <div class="col-md-4 col-sm-12"> 
        <div class="coverServiceCate"> 
            <div class="boxServiceCate">
                <img src="/images/<?php echo $row['service_img'];?>" class="imgServiceCate">
                <a href="/<?php echo $rowLang1['friendly_url'];?>" class="nameServiceCate" style="width: 100%;"><?php echo $rowLang1['lang_service_name'];?></a>
                <p class="desBoxServiceCate"><?php echo $rowLang1['lang_service_des'];?></p>
                <p class="moreServiceCate"><a href="/<?php echo $rowLang1['friendly_url'];?>">Xem tiếp</a></p>
            </div>
        </div>
    </div>   
<?php
        if ($dem%3 == 0) {
            echo '<hr style="width: 100%;" />';
        }
    }
?>
   <!--  <div class="col-md-4 col-sm-12"> 
        <div class="coverServiceCate"> 
            <div class="boxServiceCate">
                <img src="/images/c3.png" class="imgServiceCate">
                <a href="/" class="nameServiceCate">Tên Dịch Vụ 2</a>
                <p class="desBoxServiceCate">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy …</p>
                <p class="moreServiceCate"><a href="/">Xem tiếp</a></p>
            </div>
        </div>
    </div>   
    <div class="col-md-4 col-sm-12"> 
        <div class="coverServiceCate"> 
            <div class="boxServiceCate">
                <img src="/images/c2.png" class="imgServiceCate">
                <a href="/" class="nameServiceCate">Tên Dịch Vụ 3</a>
                <p class="desBoxServiceCate">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy …</p>
                <p class="moreServiceCate"><a href="/">Xem tiếp</a></p>
            </div>
        </div>
    </div>               -->   
</div> 
<div>
    <!-- <?= $paging ?> -->
    <?= $rows['paging'] ?>
</div>