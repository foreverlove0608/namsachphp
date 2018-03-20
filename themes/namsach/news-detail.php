<!--TRANG DÙNG ĐỂ HIỂN THỊ CHI TIẾT THỰC ĐƠN (TIN TỨC)-->
<?php 
    $action_news = new action_news(); 
    $slug = isset($_GET['slug']) ? $_GET['slug'] : '';
    $rowLang = $action_news->getNewsLangDetail_byUrl($slug,$lang);
    //print_r($rowLang);die;
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
<div class="sub-header products">

</div>
<div id="container" id="aboutus">
    <div class="wp-content clearfix">
        <div class="sidebar-left fl-left">
            <div class="menu-about-us-sidebar-container">
                <ul class="sub-menu">
                    <h3 class="title-detail-menu">các món ăn chế biến với</h3>
                    <li id="menu-item-2526" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-2526">
                        <a href="">nấm tươi</a>
                    </li>
                    <li id="menu-item-284" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-284">
                        <a href="">nấm khô</a>
                    </li>
                    <li id="menu-item-853" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-853">
                        <a href="">thực phẩm từ nấm</a>
                    </li>
                    <li id="menu-item-853" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-853">
                        <a href="">quà tặng nấm</a>
                    </li>
                    <li id="menu-item-853" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-853">
                        <a href="">cây cảnh nấm</a>
                    </li>
                    <li id="menu-item-853" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-853">
                        <a href="">sản phẩm khác</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="right-content fl-left">
            <input type="hidden" name="lang_current" id="lang_current" value="<?php echo $lang;?>">
            <input type="hidden" name="url_lang" value="<?php echo $url_lang;?>" id="url_lang">     
            <h1><?= $rowLang['lang_news_name']?></h1>
            <img src="/images/<?= $row['news_img']?>" alt=""/>
            <div class="content">
                <?= $rowLang['lang_news_content']?>
            </div>
        </div>
    </div>
</div>
