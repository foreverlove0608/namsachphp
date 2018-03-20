<!-- Dùng cho list các dịch vụ mới nhất trong cùng thuộc 1 danh mục -->
<?php 
    $action = new action();
    $action_service = new action_service();     
    $idServiceCat = 2;
    $limit = 3;
    $serviceCat_detail = $action_service->getServiceCatDetail_byId($idServiceCat,$lang);
    $rows = $action_service->getListServiceRelate_byIdCat_hasLimit($idServiceCat,$limit);    
?>
<link rel="stylesheet" type="text/css" href="/css/templates/service_tpl_mainService2.css">
<div id="Content-colStruc"> 
    <div class="Center-Width">  
        <div class="Infor-Width">          
            <div class="container">
                <h3 class="titleThreadHome titleThreadHomeLong"><?= $serviceCat_detail['servicecat_name'] ?></h3>   
                <div class="row">
                <?php 
                    foreach ($rows as $row => $key) {
                        $action_service1 = new action_service(); 
                        $rowLang1 = $action_service1->getServiceLangDetail_byId($key['service_id'],$lang);
                        $row1 = $action_service1->getServiceDetail_byId($key['service_id'],$lang);
                ?>
                    <div class="col-md-4 col-sm-12 colStruc">                            
                        <a href="/<?= $rowLang1['friendly_url']?>" class="linkStruc">
                            <img src="/images/<?= $row1['service_img']?>" class="imgColStruc"/>
                            <p class="titleColStruc"><?= $rowLang1['lang_service_name']?></p>
                        </a>
                    </div>
                <?php
                    }
                ?> 
                </div>
            </div>
        </div><!--end Infor-Width-->  
    </div><!--end Center-Width">-->
</div><!--end Content-colStruc-->