<?php
 // session_start();
 //    ob_start();

    // include_once('__autoload.php');
    // include_once('lib/database.php');                              
    $action_tmp = new action();
    $action_template = new action_template();    
    // liệt kê tất cả các folder Template
    $foldersTemplate = $action_tmp->getList('templatecat','','','templatecat_id','desc',$trang,24,$slug);

    foreach ($foldersTemplate['data'] as $row) {
        $templates = $action_template->getListTemplateRelate_byIdCat($row['templatecat_id']);
        // liệt kê tất cả các template có trong từng folder
        foreach ($templates as $key1 => $row1) {
	        echo $row1['friendly_url'];
	    }	   
    }
?>