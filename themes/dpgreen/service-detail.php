<?php 
    $action_service = new action_service(); 
    $slug = isset($_GET['slug']) ? $_GET['slug'] : '';

    $rowLang = $action_service->getServiceLangDetail_byUrl($slug,$lang);
    $row = $action_service->getServiceDetail_byId($rowLang['service_id'],$lang);
    $_SESSION['sidebar'] = 'serviceDetail';
?>
<?php 
    function get_url_lang ($url, $langu) {
        global $conn_vn;
        if ($langu == 'vn') {
            $lang = 'en';
        } elseif ($langu == 'en') {
            $lang = 'vn';
        }
        $sql = "SELECT * FROM service_languages Where languages_code = '$langu' And friendly_url = '$url'";
        $result = mysqli_query($conn_vn, $sql);
        $row = mysqli_fetch_assoc($result);

        $sql = "SELECT * FROM service_languages Where languages_code = '$lang' And service_id = ".$row['service_id'];
        $result = mysqli_query($conn_vn, $sql);
        $row = mysqli_fetch_assoc($result);

        return $row['friendly_url'];
    }
    $url_lang = get_url_lang($slug, $lang);
?>
<link rel="stylesheet" type="text/css" href="/css/templates/service_tpl_pageDetail.css">
<div id="Top-pageDetailService" style="width: 100%; float: left;"><img src="/images/tServiceCat.jpg" style="width: 100%;"></div>
<div id="Content-pageDetailNews">
    <div class="Center-Width">  
        <div class="Infor-Width">   
            <div class="container">
                <div class="row"> 
                    <div class="col-md-8 col-sm-12" style="padding-right: 30px;">
                    <input type="hidden" name="lang_current" id="lang_current" value="<?php echo $lang;?>">
                    <input type="hidden" name="url_lang" value="<?php echo $url_lang;?>" id="url_lang">
                        <h1 class="mainNameService" style="width: 100%;"><?= $rowLang['lang_service_name']?></h1>
                        <p class="datePSD" style="width: 100%;">Đăng lúc <?php echo $row['service_update_date'];?></p>
                        <p class="desPageServiceDetail" style="width: 100%;"><?php echo $rowLang['lang_service_des'];?></p>
                        <div class="contentPageServiceDetail">
                           <?php echo $rowLang['lang_service_content'];?>
                        </div>
                        <!-- Go to www.addthis.com/dashboard to customize your tools --> 
                        <div class="addthis_inline_share_toolbox" style="margin-top: 15px;"></div>
                    </div>
                    <div class="col-md-4 col-sm-12" style="border-left: 1px solid #e0e0e0; padding-left: 30px;">
                        <?php include_once "templates/sideBar/sideBar_tpl_RightBarService.php";  ?>
                    </div>           
                </div>
            </div>
        </div><!--end Infor-Width-->  
    </div><!--end Center-Width-->
</div><!--end Content-pageDetailNews-->