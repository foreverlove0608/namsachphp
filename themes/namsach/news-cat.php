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
<div class="sub-header products">
    THỰC ĐƠN VỚI NẤM
</div>
<div id="container" id="aboutus" class="clearfix">
    <div class="sidebar-left fl-left">
        <div class="menu-about-us-sidebar-container">
            <ul class="sub-menu">
                <h2 class="title-head-menu">món ngon từ nấm</h2>
                <li id="menu-item-2526" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-2526">
                    <a href="categories.html">mộc nhĩ</a>
                </li>
                <li id="menu-item-284" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-284">
                    <a href="categories.html">nấm khô</a>
                </li>
                <li id="menu-item-853" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-853">
                    <a href="categories.html">thực phẩm từ nấm</a>
                </li>
                <li id="menu-item-853" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-853">
                    <a href="categories.html">quà tặng nấm</a>
                </li>
                <li id="menu-item-853" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-853">
                    <a href="categories.html">cây cảnh nấm</a>
                </li>
                <li id="menu-item-853" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-853">
                    <a href="categories.html">sản phẩm khác</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="right-content fl-left">
        <input type="hidden" name="lang_current" id="lang_current" value="<?php echo $lang;?>">
        <input type="hidden" name="url_lang" value="<?php echo $url_lang;?>" id="url_lang">    
        <?php
            foreach ($rows['data'] as $row) {
                $action_news1 = new action_news(); 
                $rowLang1 = $action_news1->getNewsLangDetail_byId($row['news_id'],$lang);
                $row1 = $action_news1->getNewsDetail_byId($row['news_id'],$lang);
        ?>
        <div class="list-product item-menu">
            <div class="img-thumb">
                <a href="/<?= $rowLang1['friendly_url']?>" title="">
                    <img src="/images/<?= $row1['news_img']?>" alt="<?= $row1['news_img']?>">
                </a>
            </div>
            <h3 class="title-menu">các món ăn chế biến với</h3>
            <div class="title-list-menu">
                <a href="/<?= $rowLang1['friendly_url']?>" title="">
                    <?= $rowLang1['lang_news_name']?>
                </a>
            </div>
        </div>
        <?php
            }
        ?>
    </div>
    <!-- phân trang -->
    <nav class="woocommerce-pagination">
        <!--DÙNG ĐỂ PHÂN TRANG CHO TRANG DANH MỤC-->
        <?php
            echo $rows['paging'];
        ?>
    </nav>
</div>



