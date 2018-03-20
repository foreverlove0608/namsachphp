<?php 
    $action = new action();
    $action_product = new action_product();   
    $slug = 'tang-cuong-sinh-ly';                    
    $rowCatLang = $action_product->getProductCatLangDetail_byUrl($slug,$lang);
    $rowCat = $action_product->getProductCatDetail_byId($rowCatLang['productcat_id'],$lang);
    // if ($rowCat['newscat_id'] > 1) $rowsCatSub = $action->getList('newscat','newscat_parent',$rowCatLang['newscat_id'],'newscat_id','desc',$trang,12,'newsCat-cat');
    $rows = $action_product->getProductList_byMultiLevel_orderProductId($rowCat['productcat_id'],'desc',$trang,12,$rowCat['friendly_url']); 
?> 
<link rel="stylesheet" type="text/css" href="/css/templates/product_tpl_productHome.css">
<h3 class="titleListProductHome"><span><?= $rowCat['productcat_name']?></span></h3>
<div class="row subRow">
<?php 
    foreach ($rows['data'] as $row) {
        $action_product1 = new action_product(); 
        $rowLang1 = $action_product->getProductLangDetail_byId($row['product_id'],$lang);
        $row1 = $action_product->getProductDetail_byId($row['product_id'],$lang);
?>
    <div class="col-md-3 col-sm-4 col-xs-6 subRowPH">
        <div class="coverBoxProductHome">            
            <a href="/<?= $rowLang1['friendly_url']?>" class="imgProductHome"><img src="/images/<?= $row1['product_img']?>"></a>
            <a href="/<?= $rowLang1['friendly_url']?>" class="nameProductHome"><?= $rowLang1['lang_product_name']?></a>
            <div class="rowSubProductHome">
                <p class="pricePH"><?= number_format($row1['product_price'],'0','','.')?>VNĐ</p>
                <a href="javascript:void(0)" class="linkPH" onclick="load_url('<?php echo $row['product_id'];?>', '<?php echo $rowLang1['lang_product_name'];?>', '<?php echo $row1['product_price'];?>')">MUA</a>
            </div>
        </div>
    </div>
<?php
    }
?>  
</div>
