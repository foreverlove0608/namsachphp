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
<!--HIỂN THỊ CHI TIẾT DỊCH VỤ-->
<div class="sub-header products">
     <h3 class="titleCateProduct"><span><?= $rowLang['lang_service_name']?></span></h3>
</div>
<div id="container" id="aboutus">
    <div class="wp-content clearfix">
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
            <h1><?= $rowLang['lang_service_name']?></h1>
            <input type="hidden" name="lang_current" id="lang_current" value="<?php echo $lang;?>">
            <input type="hidden" name="url_lang" value="<?php echo $url_lang;?>" id="url_lang">
            <?php echo $rowLang['lang_service_content'];?>
        </div>
    </div>
</div>