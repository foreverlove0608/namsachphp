<?php 
    $action = new action();
    $action_news = new action_news();     
    $idNewsCat = 58;
    $numRecords = 8;
    $fromRecord = 0;
    $rows = $action_news->getSomeLastNews_byIdCat($idNewsCat,$numRecords,$fromRecord);
?>   
<!-- SECTION MENU -->
<section class="home-products title-line">
    <div id="container">
        <h2 class="widgettitle">
            <span>THỰC ĐƠN MÓN NGON TỪ NẤM</span>
        </h2>
        <div class="owl-carousel owl-theme owl-loaded">
            <div class="owl-stage-outer">
                <div class="owl-stage">
                    <?php
                        foreach ($rows as $row => $key) {
                        $action_news1 = new action_news(); 
                        $rowLang1 = $action_news1->getNewsLangDetail_byId($key['news_id'],$lang);
                        $row1 = $action_news1->getNewsDetail_byId($key['news_id'],$lang);
                    ?>
                    
                    <div class="owl-item item-product">
                        <a href="/<?= $rowLang1['friendly_url']?>" title="">
                            <img src="images/<?= $row1['news_img']?>" alt="">
                        </a>
                            <p>Các món ăn chế biến với</p>
                        <p><strong><a> <?= $rowLang1['lang_news_name']?></a></strong></p>
                    </div>
                        <?php } ?>
                </div>
            </div>
            <div class="owl-controls">
                <div class="owl-nav">
                    <div class="owl-prev"><i class="fas fa-chevron-left"></i></div>
                    <div class="owl-next"><i class="fas fa-chevron-right"></i></div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END SECTION MENU -->