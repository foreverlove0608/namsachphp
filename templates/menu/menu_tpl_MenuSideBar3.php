<?php 
    $action = new action();
    $action_product = new action_product();   
    $slug = 'tang-cuong-sinh-ly';                    
    $rowCatLang = $action_product->getProductCatLangDetail_byUrl($slug,$lang);
    $rowCat = $action_product->getProductCatDetail_byId($rowCatLang['productcat_id'],$lang);
    // if ($rowCat['newscat_id'] > 1) $rowsCatSub = $action->getList('newscat','newscat_parent',$rowCatLang['newscat_id'],'newscat_id','desc',$trang,12,'newsCat-cat');
    // $rows = $action_product->getProductList_byMultiLevel_orderProductId($rowCat['productcat_id'],'desc',$trang,7,$rowCat['friendly_url']); 
     $rows = $action->getList('product','','','product_id','desc',$trang,12,'product-cat'); 
?> 
<link rel="stylesheet" type="text/css" href="/css/templates/menu_tpl_MenuSideBar.css">
<ul class="listMenuRB">
<?php 
    foreach ($rows['data'] as $row) {
        $action_product1 = new action_product(); 
        $rowLang1 = $action_product->getProductLangDetail_byId($row['product_id'],$lang);
        $row1 = $action_product->getProductDetail_byId($row['product_id'],$lang);
?>
	<li><a href="/<?= $rowLang1['friendly_url']?>"><i class="iconfont-right3"></i><?= $rowLang1['lang_product_name']?></a></li>
	
<?php
    }
?> 	
</ul>
