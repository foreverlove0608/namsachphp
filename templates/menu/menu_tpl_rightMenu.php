<?php
    //GET 4 MENU ON LEFT
    function right_menu ($id, $lang) {
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
    function show_menu_right ($list, $lang) {
        $menu_right = new action_menu();
//        print_r($list);die;
        echo '<ul id="menu-main-menu-right" class="menu">';
        foreach ($list as $item) {
            $url1 = $menu1->setUrlFriendly_byType($item['menu_id'], $lang);
            echo '<li id="menu-item-1277" class="hvr-sweep-to-top">';
            echo '<a href="'.$url1.'">'.$item['lang_menu_name'].'</a>';
            $list_sub = main_menu($item['menu_id'], $lang);
            if (count($list_sub) != 0) {
                show_menu_sub_right($list_sub, $lang);
            }
            echo '</li>';
        }
        echo '</ul>';
    }
    //sub-menu left
    function show_menu_sub_right ($list, $lang) {
        $menu_sub_right = new action_menu();
        echo '<ul class="sub-menu">';
        foreach ($list as $item) {
            $url2 = $menu_sub_right->setUrlFriendly_byType($item['menu_id'], $lang);
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
    <?php 
        $list_menu1 = $menu->getListMainMenu_byOrderASC();
    ?>                     
    <?php
    show_menu_sub_right($menu_main, $lang);
    ?>
</div>

