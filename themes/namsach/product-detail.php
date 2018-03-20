<?php 
    $action_product = new action_product(); 
    $slug = isset($_GET['slug']) ? $_GET['slug'] : '';

    $rowLang = $action_product->getProductLangDetail_byUrl($slug,$lang);
    $row = $action_product->getProductDetail_byId($rowLang['product_id'],$lang);
    $_SESSION['sidebar'] = 'newsDetail';
?>
<link rel="stylesheet" type="text/css" href="/css/templates/product_tpl_pageDetail.css">
<div id="Content-pageDetailProduct">
    <div class="Center-Width">  
        <div class="Infor-Width">   
            <div class="container">
                <div class="row"> 
                    <div class="col-md-9 col-sm-12" style="padding: 0px;">
                        <div class="leftProductDetail">
                            <img src="/images/<?= $row['product_img']?>" class="imgPD">
                        </div>
                        <div class="rightProductDetail">   
                            <h1 class="nameProductDetail"><?= $rowLang['lang_product_name']?></h1>
                            <span class="subProductDetail">Mã sản phẩm: <strong><?= $row['product_code']?></strong></span>
                            <span class="subProductDetail">Hãng sản xuất: <strong><?= $row['product_expiration']?></strong></span>
                            <span class="subProductDetail">Xuất xứ: <strong><?= $row['product_material']?></strong></span>
                            <span class="priceProductDetail"><?= number_format($row['product_price'],'0','','.')?> VNĐ</span>
                            <div class="rowBuyPD">
                                <input type="number" name="" value="1" placeholder="" class="number_cart">
                                <button type="submit" class="btn_addCart">Thêm vào giỏ</button>                         
                            </div>
                            <p class="callProductDetail">Liên hệ ngay để được tư vấn<br><strong>0123.456.789</strong></p>
                        </div>
                        <p class="mainNameProduct"><span>Thông tin chi tiết</span></p>
                        <div class="contentPageProductDetail">
                            <?= $rowLang['lang_product_content']?>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-12" style="padding: 0px;">
                        <?php include_once "templates/sideBar/sideBar_tpl_RightBar.php";  ?> 
                    </div>           
                </div>
            </div>
        </div><!--end Infor-Width-->  
    </div><!--end Center-Width-->
</div><!--end Content-pageDetailNews-->