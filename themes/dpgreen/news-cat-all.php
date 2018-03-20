<?php 
    $action = new action();
    $action_news = new action_news();     
    if (isset($_GET['slug']) && $_GET['slug'] != '') {
        $slug = $_GET['slug'];                    
        $rowCatLang = $action_news->getNewsCatLangDetail_byUrl($slug,$lang);
        $rowCat = $action_news->getNewsCatDetail_byId($rowCatLang['newscat_id'],$lang);
        // if ($rowCat['newscat_id'] > 1) $rowsCatSub = $action->getList('newscat','newscat_parent',$rowCatLang['newscat_id'],'newscat_id','desc',$trang,12,'newsCat-cat');
        $rows = $action_news->getNewsList_byMultiLevel_orderNewsId($rowCat['newscat_id'],'desc',$trang,12,$rowCat['friendly_url']);
    }
    else $rows = $action->getList('news','','','news_id','desc',$trang,12,'news-cat'); 

    $rows_tin = $action->getList('news','','','news_id','desc','','','news-cat');
    $record = count($rows_tin);
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
    // $url_lang = get_url_lang($slug, $lang);
?>
<link rel="stylesheet" type="text/css" href="/css/templates/news_tpl_pageCate.css">
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
                            <!-- <?= $paging ?> -->
                            <?php
    $config = array(
        'current_page'  => $trang, // Trang hiện tại
        'total_record'  => $record, // Tổng số record
        'total_page'    => 1, // Tổng số trang
        'limit'         => 12,// limit
        'start'         => 0, // start
        'link_full'     => '',// Link full có dạng như sau: domain/com/page/{page}
        'link_first'    => '',// Link trang đầu tiên
        'range'         => 9, // Số button trang bạn muốn hiển thị 
        'min'           => 0, // Tham số min
        'max'           => 0,  // tham số max, min và max là 2 tham số private
    );

    $pagination = new Pagination;
    $pagination->init($config);
    
    echo $pagination->htmlPaging_tuan('tin-tuc');
?>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-12" style="padding: 0px;">
                        <?php //include_once "templates/sideBar/sideBar_tpl_RightBar.php";  ?> 
                    </div>        
                </div>                  
            </div>
        </div><!--end Infor-Width-->  
    </div><!--end Center-Width">-->
</div><!--end Content-pageCateNews-->
