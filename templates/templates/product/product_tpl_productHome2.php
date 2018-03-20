<?php 
    $action = new action();
    $action_product = new action_product();
    $row2 = $action_product->getListProductHot_hasLimit(8);   // var_dump($row2);die;
    $slug = 'san-pham-mua-nhieu';
    $rowCatLang = $action_product->getProductCatLangDetail_byUrl($slug,$lang);
    $rowCat = $action_product->getProductCatDetail_byId($rowCatLang['productcat_id'],$lang);
    // if ($rowCat['newscat_id'] > 1) $rowsCatSub = $action->getList('newscat','newscat_parent',$rowCatLang['newscat_id'],'newscat_id','desc',$trang,12,'newsCat-cat');
    $rows = $action_product->getProductList_byMultiLevel_orderProductId($rowCat['productcat_id'],'desc',$trang,8,$rowCat['friendly_url']);
    
?> 

<!-- SECTION HOME PRODUCT - PRODUCT MAX SALE -->
<section class="home-products title-line">
    <div id="container">
        <h2 class="widgettitle">
            <span>SẢN PHẨM MUA NHIỀU NHẤT</span>
        </h2>
        <div class="owl-carousel owl-theme owl-loaded">
            <div class="owl-stage-outer">
                <div class="owl-stage">
                    <?php
                        foreach ($row2 as $row) {
                        $action_product1 = new action_product();
                        $rowLang1 = $action_product->getProductLangDetail_byId($row['product_id'],$lang);
                        $row1 = $action_product->getProductDetail_byId($row['product_id'],$lang);
                    ?>
                    <div class="owl-item item-product">
                        <a href="/<?= $rowLang1['friendly_url']?>" title="">
                            <img src="images/<?= $row['product_img']?>" alt="">
                        </a>
                        <p class="name-pro"><a href="/<?= $rowLang1['friendly_url']?>"><?= $rowLang1['lang_product_name']?></a></p>
                        <p><?= number_format($row['product_price'],'0','','.')?>VNĐ</p>
                        <a href="/<?= $rowLang1['friendly_url']?>" title="">
                            <span class="cart">
                                <i class="fas fa-cart-arrow-down"></i>
                            </span>
                        </a>
                        <span class="shopping">
                            <a href="javascript:void(0)" class="linkPH" onclick="load_url('<?php echo $row['product_id'];?>', '<?php echo $rowLang1['lang_product_name'];?>', '<?php echo $row1['product_price'];?>')">Mua hàng</a>
                            <!--<a href="cart.html" title="">Mua hàng</a>-->
                        </span>
                    </div>
                    <?php
                        }
                    ?>
                </div>
            </div>
            <div class="owl-controls">
                <div class="owl-nav">
                    <div class="owl-prev"><i class="fas fa-chevron-left"></i></div>
                    <div class="owl-next"><i class="fas fa-chevron-right"></i></div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- SECTION HOME PRODUCT- PRODUCT NEW -->
<!-- NEWS LETTER -->
<div class="newsletter">
    <div id="container">
        <form id="mc4wp-form-1" class="mc4wp-form mc4wp-form-3346" method="post" data-id="3346" data-name="Default sign-up form">
            <div class="mc4wp-form-fields">
                <label>THÔNG TIN KHUYẾN MÃI, QUÀ TẶNG</label>
                <div class="form-input">
                    <input type="text" class="fphone" name="FPHONE" id="mc4wp_fphone" placeholder="Điện thoại" required="">
                    <input type="email" class="email" id="mc4wp_email" name="EMAIL" placeholder="Email của bạn" required="">
                    <input type="submit" class="submit" value="ĐĂNG KÍ">
                </div>
                <div class="form-tip">
                    <i class="fa fa-info-circle"></i> Mọi thông tin của bạn đăng kí đều được bảo mật, email chúng tôi không gửi dưới dạng spam.
                </div>
            </div>
    </div>
</div>
<!-- END NEWS LETTER -->