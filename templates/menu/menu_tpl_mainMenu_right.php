<?php
    $menu_bot = new action_menu();
    $rows = $menu_bot->getListMenu_bot(188);
    print_r($rows);die;
    //GET 4 MENU ON LEFT
    function main_menu_right ($id, $lang) {
        global $conn_vn;
        $sql = "SELECT * From menu Inner Join menu_languages On menu.menu_id = menu_languages.menu_id Where menu_languages.languages_code = '$lang' And menu.state = 1 And menu.menu_parent = $id Order By menu.menu_sort_order ASC LIMIT 4,6";
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

<div class="menu-main-menu-right-container fl-right">
    <ul id="menu-main-menu-right" class="menu">
        <li class="hvr-sweep-to-top">
            <a href="how-to-buy.html">Hướng dẫn mua hàng</a>
            <ul class="sub-menu">
                <li><a href="how-to-buy.html">Cách thức mua hàng</a></li>
                <li><a href="ask-answer.html">Hỏi đáp</a></li>
                <li><a href="promotion.html">Khuyến mãi</a></li>
            </ul>
        </li>
        <li class="hvr-sweep-to-top">
            <a href="news.html">Nấm và sức khoẻ</a>
        </li>
    </ul>
</div>