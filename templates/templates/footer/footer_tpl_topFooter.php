    <link rel="stylesheet" type="text/css" href="/css/templates/footer_tpl_topFooter.css">
    <div id="Footer-OneFooter">
        <div class="Center-Width">  
            <div class="Infor-Width">  
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <h4 class="titleFooter">Liên hệ</h4>
                            <p class="contentContactFooter"><?php echo $rowConfig['web_email']?><br><strong>Hotline:</strong><?php echo $rowConfig['content_home3']?><br>
<strong>Email:</strong> <?php echo $rowConfig['content_home2']?><br>
<strong>Website:</strong> <?php echo $rowConfig['web_name']?></p>
                        </div>
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <h4 class="titleFooter">Tin tức mới nhất</h4>
                            <?php 
                                $action = new action();
                                $action_news = new action_news();     
                                $idNewsCat = 58;
                                $numRecords = 5;
                                $fromRecord = 0;
                                $rows = $action_news->getSomeLastNews_byIdCat($idNewsCat,$numRecords,$fromRecord);
                            ?>
                            <ul class="listLinkFooter">
                            <?php 
                                foreach ($rows as $row => $key) {
                                    $action_news1 = new action_news(); 
                                    $rowLang1 = $action_news1->getNewsLangDetail_byId($key['news_id'],$lang);
                                    $row1 = $action_news1->getNewsDetail_byId($key['news_id'],$lang);
                            ?>
                                <li><a href="/<?= $rowLang1['friendly_url']?>"><i class="iconfont-right3"></i> <?= $rowLang1['lang_news_name']?></a></li>                                       
                            <?php
                                }
                            ?>
                            </ul>        
                        </div>
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <h4 class="titleFooter">Đăng ký nhận tin</h4>
                            <div class="fb-page" data-href="<?php echo $rowConfig['content_home9']?>" data-tabs="timeline" data-width="500" data-height="165" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="<?php echo $rowConfig['content_home9']?>" class="fb-xfbml-parse-ignore"><a href="<?php echo $rowConfig['content_home9']?>">SEXSHOPS.NET.VN</a></blockquote></div>    
                        </div>
                    </div>
                </div>    
            </div><!--end Infor-Width-->
        </div><!--end Center-Width-->
    </div><!--end Content-OneFooter-->