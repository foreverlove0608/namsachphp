<?php
    //GET 4 MENU ON LEFT
function main_menu ($id, $lang) {
    global $conn_vn;
    $sql = "SELECT * From menu Inner Join menu_languages On menu.menu_id = menu_languages.menu_id Where menu_languages.languages_code = '$lang' And menu.state = 1 And menu.menu_parent = $id Order By menu.menu_sort_order ASC LIMIT 0,4";
        //echo $sql;die;
    $result = mysqli_query($conn_vn, $sql);
    $rows = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

    //main-menu left
function show_menu1 ($list, $lang) {
    $menu1 = new action_menu();
    echo '<ul id="menu-main-menu-left" class="menu">';
    foreach ($list as $item) {
        $url1 = $menu1->setUrlFriendly_byType($item['menu_id'], $lang);
        echo '<li id="menu-item-1277" class="hvr-sweep-to-top">';
        echo '<a href="'.$url1.'">'.$item['lang_menu_name'].'</a>';
        $list_sub = main_menu($item['menu_id'], $lang);
        if (count($list_sub) != 0) {
            show_menu2($list_sub, $lang);
        }
        echo '</li>';
    }
    echo '</ul>';
}
    //sub-menu left
function show_menu2 ($list, $lang) {
    $menu2 = new action_menu();
    echo '<ul class="sub-menu">';
    foreach ($list as $item) {
        $url2 = $menu2->setUrlFriendly_byType($item['menu_id'], $lang);
        echo '<li class="menu-item-882">';
        echo '<a href="'.$url2.'" class="link_main_menu_2">'.$item['lang_menu_name'].'</a>';
        echo '</li>';
    }
    echo '</ul>';
}
$menu_main = main_menu(188, $lang);
$menu_sub = main_menu(192, $lang);




?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords" content="Nấm sạch - chuyên cung cấp Nấm tươi, Nấm khô,thực phẩm từ nấm, cây cảnh nấm, quà tặng nấm, có chứng nhận ATVSTP của bộ y tế. chất lượng và giá cực tốt.">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="author" content="Nấm sạch">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= $title?></title>
    <link rel="stylesheet" href="/css/reset.css">
    <link rel="stylesheet" href="/css/global.css">
    <link rel="stylesheet" href="/css/main-style.css">
    <link href="https://use.fontawesome.com/releases/v5.0.8/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/animate.css">
    <link rel="stylesheet" href="/css/responsive.css">
    <link rel="stylesheet" href="/css/flexslider.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="/assets/owl.theme.default.min.css">
    <link rel="stylesheet" href="/css/about-us.css">
    <!-- Modernizr -->
    <script src="js/modernizr.js"></script>    
</head>
<body>
    <div class="hidden-xs aws-banner fixed-banner turnoff_0">
        <div class="banner-on">
            <div class="container">
                Liên hệ Hotline để biết thêm chi tiết
                <a href="tel:01672523165" class="banner-button">
                    <?php echo $rowConfig['content_home3']?>
                </a>
            </div>
            <a href="" id="close" class="ion-ios-close-empty banner-close">
                <i class="fas fa-times"></i>
            </a>
        </div>
        <div class="banner-off" id="show">HOTLINE</div>
    </div>
    <!-- Start Header -->
    <header>
        <div id="top-bar">
            <div id="container" class="clearfix">
                <div class="widget_cart fl-right">
                    <a href="cart.html" class="shopping-cart"><i class="fas fa-shopping-cart"></i>Giỏ Hàng(3)</a>
                </div>
                <form role="search" method="get" id="top-search" action="" class="form-search fl-left">
                    <input type="search" class="search-field" placeholder="Tìm kiếm sản phẩm..." value="" name="s" title="Search for:">
                </form>
            </div>
        </div>
        <nav id="main-menu" class="navigation">
            <div class="navigation-view-1">
                <div id="container" class="clearfix">
                    <div class="menu-main-menu-left-container fl-left">
                        <?php 
                            $list_menu = $menu->getListMainMenu_byOrderASC();
                        ?>                     
                        <?php
                            show_menu1($menu_main, $lang);
                        ?>
                    </div>
                    <a href="/index.php" class="top-logo">
                        <img src="/images/<?php echo $rowConfig['web_logo'];?>" alt="logo nam sach">
                    </a>
                    <div class="menu-main-menu-right-container fl-right">
                        <ul id="menu-main-menu-right" class="menu">
                            <?php
                            $menu_bot = new action_menu();
                            $rows = $menu_bot->getListMenu_right(188);
                            foreach ($rows as $key) {
                                $url = $menu_bot->setUrlFriendly_byType($key['menu_id'], $lang);
                            ?>
                                <li class="hvr-sweep-to-top">
                                    <a href="<?= $url ?>"><?php echo $key['menu_name'];?></a>
                                    <?php
                                        getSubmenu($key['menu_id'], $lang);
                                    ?>
                                </li>
                            <?php
                            }
                            ?>
                        </ul>
                    </div>

                    <?php
                    function getSubmenu($parent_id, $lang) {
                        global $conn_vn;
                        $submenu = $conn_vn->query("SELECT * FROM menu WHERE menu_parent = ".$parent_id);
                        if ($submenu->num_rows > 0) {
                            echo '<ul class="sub-menu">';
                            $abc = new action_menu();
                            while ( $obj = $submenu->fetch_object() ) {
                               
                               $x = $abc->setUrlFriendly_byType($obj->menu_id, $lang);
                                echo '<li><a href="'.$x.'">' . $obj->menu_name . '</a>';
                                getSubmenu($obj->menu_id);
                                echo '</li>';
                            }
                            echo '</ul>';
                        }   
                    }           

                    ?>
                </div>
            </div>
        </nav>
    </header>
