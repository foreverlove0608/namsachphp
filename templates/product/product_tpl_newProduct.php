<!-- HIỂN THỊ SAN PHAM MOI Ở TRANG CHỦ-->
<?php
    $action = new action();
    $action_product = new action_product();   
    $row2 = $action_product->getListProductNew_hasLimit(12);   // var_dump($row2);die;
    $slug = 'san-pham-moi';
    $rowCatLang = $action_product->getProductCatLangDetail_byUrl($slug,$lang);
    $rowCat = $action_product->getProductCatDetail_byId($rowCatLang['productcat_id'],$lang);
    // if ($rowCat['newscat_id'] > 1) $rowsCatSub = $action->getList('newscat','newscat_parent',$rowCatLang['newscat_id'],'newscat_id','desc',$trang,12,'newsCat-cat');
    $rows = $action_product->getProductList_byMultiLevel_orderProductId($rowCat['productcat_id'],'desc',$trang,12,$rowCat['friendly_url']);
?>
<!-- SECTION HOME PRODUCT - PRODUCT NEW -->
<section class="home-products title-line">
    <div id="container">
        <h2 class="widgettitle">
            <span>SẢN PHẨM MỚI</span>
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
<script type="text/javascript">
    function load_url (id, name, price) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
           // document.getElementById("demo").innerHTML = this.responseText;
           // alert(this.responseText);
           // alert('thanh cong.');
           window.location.href = "/cart-detail";
          }
        };
        xhttp.open("POST", "/themes/namsach/ajax-add-cart.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("action1=add_cart&product_id="+id+"&product_name="+name+"&product_price="+price+"&product_quantity=1&action=add");
        xhttp.send();        
    }
</script>