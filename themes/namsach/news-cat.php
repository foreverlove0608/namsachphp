<!--TRANG DÙNG ĐỂ HIỂN THỊ DANH MỤC THỰC ĐƠN-->
<?php
    $action = new action();
    $action_news = new action_news();   
    $action_menu = new action_menu();
    function getmainMenu(){
        global $conn_vn;
        $row[] = array();
    }
    if (isset($_GET['slug']) && $_GET['slug'] != '') {
        $slug = $_GET['slug'];
        echo $slug;
        $rowCatLang = $action_news->getNewsCatLangDetail_byUrl($slug,$lang);
        $rowCat = $action_news->getNewsCatDetail_byId($rowCatLang['newscat_id'],$lang);
        // if ($rowCat['newscat_id'] > 1) $rowsCatSub = $action->getList('newscat','newscat_parent',$rowCatLang['newscat_id'],'newscat_id','desc',$trang,12,'newsCat-cat');
        $rows = $action_news->getNewsList_byMultiLevel_orderNewsId($rowCat['newscat_id'],'desc',$trang,12,$rowCat['friendly_url']);
    }
    else $rows = $action->getList('news','','','news_id','desc',$trang,12,'news-cat'); 

?>
<?php 
    function get_url_lang ($url, $langu) {
        global $conn_vn;
        if ($langu == 'vn') {
            $lang = 'en';
        } elseif ($langu == 'en') {
            $lang = 'vn';
        }
        $sql = "SELECT * FROM newscat_languages Where languages_code = '$langu' And friendly_url = '$url'";
        $result = mysqli_query($conn_vn, $sql) or die(mysqli_error($conn_vn));
        $row = mysqli_fetch_assoc($result);

        $sql = "SELECT * FROM newscat_languages Where languages_code = '$lang' And newscat_id = ".$row['newscat_id'];
        $result = mysqli_query($conn_vn, $sql) or die(mysqli_error($conn_vn));
        $row = mysqli_fetch_assoc($result);

        return $row['friendly_url'];
    }
    $url_lang = get_url_lang($slug, $lang);
?>
<link rel="stylesheet" type="text/css" href="/css/templates/news_tpl_pageCate.css">
<?php
    if(isset($slug) && $slug == "")
?>
<div id="Content-pageCateNews">
    <div class="Center-Width">  
        <div class="Infor-Width">   
            <div class="container">
                <div class="row"> 
                    <div class="col-md-9 col-sm-12" style="padding: 0px;">
                        <p class="titlePageCateNews">Tin Tức</p>
                        <input type="hidden" name="lang_current" id="lang_current" value="<?php echo $lang;?>">
                        <input type="hidden" name="url_lang" value="<?php echo $url_lang;?>" id="url_lang">      
                        <ul class="listSubTopCN"> 
                        <?php 
                             foreach ($rows['data'] as $row) {
                                 $action_news1 = new action_news(); 
                                 $rowLang1 = $action_news1->getNewsLangDetail_byId($row['news_id'],$lang);
                                 $row1 = $action_news1->getNewsDetail_byId($row['news_id'],$lang);
                        ?>
                             <li>
                                <a href="/<?= $rowLang1['friendly_url']?>">
                                    <img src="/images/<?= $row1['news_img']?>">
                                    <p><?= $rowLang1['lang_news_name']?></p>
                                </a>
                            </li> 
                        <?php
                            }
                        ?>
 
                         </ul>
                        <div> 
                           
                         </div>
                    </div>
                    <div class="col-md-3 col-sm-12" style="padding: 0px;"> 
                        <?php //include_once "templates/sideBar/sideBar_tpl_RightBar.php";  ?> 
                     </div>        
                </div>                  
            </div> 
        </div>
    </div>
</div>



