<?php 
    $action_news = new action_news(); 
    $slug = isset($_GET['slug']) ? $_GET['slug'] : '';

    $rowLang = $action_news->getNewsLangDetail_byUrl($slug,$lang);
    $row = $action_news->getNewsDetail_byId($rowLang['news_id'],$lang);
    $_SESSION['sidebar'] = 'newsDetail';
?>
<?php 
    function get_url_lang ($url, $langu) {
        global $conn_vn;
        if ($langu == 'vn') {
            $lang = 'en';
        } elseif ($langu == 'en') {
            $lang = 'vn';
        }
        $sql = "SELECT * FROM news_languages Where languages_code = '$langu' And friendly_url = '$url'";
        $result = mysqli_query($conn_vn, $sql);
        $row = mysqli_fetch_assoc($result);

        $sql = "SELECT * FROM news_languages Where languages_code = '$lang' And news_id = ".$row['news_id'];
        $result = mysqli_query($conn_vn, $sql);
        $row = mysqli_fetch_assoc($result);

        return $row['friendly_url'];
    }
    $url_lang = get_url_lang($slug, $lang);
?>
<link rel="stylesheet" type="text/css" href="/css/templates/news_tpl_pageDetail.css">
<style type="text/css">
    .contentPageNewsDetail * {
        float: none;
    }

    .contentPageNewsDetail li {
        list-style-type: disc;
    }
</style>
<div id="Content-pageDetailNews">
    <div class="Center-Width">  
        <div class="Infor-Width">   
            <div class="container">
                <div class="row"> 
                    <div class="col-md-9 col-sm-12" style="padding: 0px;">
                    <input type="hidden" name="lang_current" id="lang_current" value="<?php echo $lang;?>">
                    <input type="hidden" name="url_lang" value="<?php echo $url_lang;?>" id="url_lang">                    
                        <h1 class="mainNameNews"><?= $rowLang['lang_news_name']?></h1>
                        <p class="datePND">Đăng lúc <?= $row['news_created_date']?></p>
                        <p class="desPageNewsDetail"><?= $rowLang['lang_news_des']?></p>
                        <div class="contentPageNewsDetail">
                            <?= $rowLang['lang_news_content']?>
                        </div>
                        <!-- Go to www.addthis.com/dashboard to customize your tools --> 
                        <div class="addthis_inline_share_toolbox" style="margin-top: 15px;"></div>
                    </div>
                    <div class="col-md-3 col-sm-12" style="padding: 0px;">
                        <?php include_once "templates/sideBar/sideBar_tpl_RightBar.php";  ?> 
                    </div>           
                </div>
            </div>
        </div><!--end Infor-Width-->  
    </div><!--end Center-Width-->
</div><!--end Content-pageDetailNews-->
