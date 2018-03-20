<?php 
    $action_page = new action_page();
    $menu = new action_menu();
    $slug = isset($_GET['slug']) ? $_GET['slug'] : '';
    
    $rowLang = $action_page->getPageLangDetail_byUrl($slug,$lang);
    //$row = $action_page->getPageDetail_byId($rowLang['news_id'],$lang);
    $_SESSION['sidebar'] = 'pageDetail';
    $sidebar = $action_page->getMenu_page(13);
?>
<link rel="stylesheet" href="css/about-us.css"/>
<div class="sub-header products">
     <h3 class="titleCateProduct"><span><?= $rowLang['lang_page_name']?></span></h3>
</div>
<div id="container" id="aboutus" class="clearfix">
    <div class="sidebar-left fl-left">
        <div class="menu-about-us-sidebar-container">
            <ul id="menu-about-us-sidebar" class="menu">
                <li id="menu-item-86" class="menu-item menu-item-type-post_type menu-item-object-page current-menu-item page_item page-item-15 current_page_item menu-item-has-children menu-item-86">
                    <ul class="sub-menu">
                    <?php
                    foreach ($sidebar as $item_menu_page){
                         $url = $menu->setUrlFriendly_byType($item_menu_page['menu_id'], $lang);
                    ?>
                        <li id="menu-item-2526" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-2526">
                            <a href="<?= $url ?>"><?php echo $item_menu_page['menu_name'];?></a>
                        </li>
                    <?php
                    }
                    ?>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
    <div class="right-content fl-left"> 
        <?php echo $rowLang['lang_page_content'];?>
    </div>
</div>