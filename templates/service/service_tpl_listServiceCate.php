<?php 
    $action = new action();
    $action_service = new action_service();     
    if (isset($_GET['slug']) && $_GET['slug'] != '') {
        $slug = $_GET['slug'];                    
        $rowCatLang = $action_service->getServiceCatLangDetail_byUrl($slug,$lang);
        $rowCat = $action_service->getServiceCatDetail_byId($rowCatLang['servicecat_id'],$lang);
        if ($rowCat['servicecat_id'] > 1){
            $rowsCatSub = $action->getList('service','servicecat_id',$rowCatLang['servicecat_id'],'service_id','desc',$trang,12,'service-cat');
//            print_r($rowsCatSub);die;
        } 
        //$rows = $action_service->getServiceList_byMultiLevel_orderServiceId($rowCat['servicecat_id'],'desc',$trang,12,$rowCat['friendly_url']);
    }
    else $rows = $action->getList('service','','','service_id','desc',$trang,12,'service-cat'); 
?>
<div class="sub-header products">
    <h3 class="titleCateProduct"><span>Khuyến mãi</span></h3>
</div>
<div id="container" id="aboutus" class="clearfix">
    <div class="sidebar-left fl-left">
        <div class="menu-about-us-sidebar-container">
            <ul class="sub-menu">
                <h3 class="title-detail-menu">blog</h3>
                <li id="menu-item-2526" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-2526">
                    <a href="">cách thức mua hàng</a>
                </li>
                <li id="menu-item-284" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-284">
                    <a href="">khuyến mãi</a>
                </li>
                <li id="menu-item-853" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-853">
                    <a href="">hỏi đáp</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="right-content fl-left">
        <?php 
            $dem = 0;
            foreach ($rowsCatSub['data'] as $row) {
                $dem++;
                $action_service1 = new action_service(); 
                $rowLang1 = $action_service1->getServiceLangDetail_byId($row['service_id'],$lang);
                $row1 = $action_service1->getServiceDetail_byId($row['service_id'],$lang);
        ?>
        <div class="list-product item-menu">
            <div class="img-thumb">
                <a href="/<?php echo $rowLang1['friendly_url'];?>" title="">
                    <img src="/images/<?php echo $row['service_img'];?>" alt="">
                </a>
            </div>
            <div class="title-list-menu">
                <a href="/<?php echo $rowLang1['friendly_url'];?>" title="">
                    <?php echo $rowLang1['lang_service_name'];?>
                </a>
            </div>
            <div class="title-list-menu">
                 <?php echo $row['service_create_date'];?>
                <?php echo $row['service_views'];?>
            </div>
        </div>
        <?php
            }
        ?>
    </div>
    <!-- phân trang -->
    <?= $paging ?>
    <?= $rows['paging'] ?>
</div>