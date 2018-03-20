<?php 
    function get_url_lang ($url, $langu) {
        global $conn_vn;
        if ($langu == 'vn') {
            $lang = 'en';
        } elseif ($langu == 'en') {
            $lang = 'vn';
        }
        $sql = "SELECT * FROM servicecat_languages Where languages_code = '$langu' And friendly_url = '$url'";
        $result = mysqli_query($conn_vn, $sql);
        $row = mysqli_fetch_assoc($result);

        $sql = "SELECT * FROM servicecat_languages Where languages_code = '$lang' And servicecat_id = ".$row['servicecat_id'];
        $result = mysqli_query($conn_vn, $sql);
        $row = mysqli_fetch_assoc($result);

        return $row['friendly_url'];
    }
    $url_lang = get_url_lang($slug, $lang);
?>
<link rel="stylesheet" type="text/css" href="/css/templates/service_tpl_pageCate.css">
<div id="Top-pageCateService" style="width: 100%; float: left;"><img src="/images/tServiceCat.jpg" style="width: 100%;"></div>
<div id="Content-pageCateService">
    <div class="Center-Width">  
        <div class="Infor-Width">   
            <div class="container">
            <input type="hidden" name="lang_current" id="lang_current" value="<?php echo $lang;?>">
            <input type="hidden" name="url_lang" value="<?php echo $url_lang;?>" id="url_lang">
                <?php include_once "templates/service/service_tpl_listServiceCate.php";  ?>    
            </div>
        </div><!--end Infor-Width-->  
    </div><!--end Center-Width">-->
</div><!--end Content-pageCateNews-->
