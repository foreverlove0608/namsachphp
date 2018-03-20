<!-- HIEN THI NOI DUNG CHI TIET CHO TUNG DANH MUC -->
<?php 
    $action = new action();
    $action_product = new action_product();     
    if (isset($_GET['slug']) && $_GET['slug'] != '') {
        $slug = $_GET['slug'];                    
        $rowCatLang = $action_product->getProductCatLangDetail_byUrl($slug,$lang);
        $rowCat = $action_product->getProductCatDetail_byId($rowCatLang['productcat_id'],$lang);
        // if ($rowCat['newscat_id'] > 1) $rowsCatSub = $action->getList('newscat','newscat_parent',$rowCatLang['newscat_id'],'newscat_id','desc',$trang,12,'newsCat-cat');
        $rows = $action_product->getProductList_byMultiLevel_orderProductId($rowCat['productcat_id'],'desc',$trang,12,$rowCatLang['friendly_url']);
    }
    else $rows = $action->getList('product','','','product_id','desc',$trang,12,'product-cat'); 
?> 
<?php 
    function get_url_lang ($url, $langu) {
        global $conn_vn;
        if ($langu == 'vn') {
            $lang = 'en';
        } elseif ($langu == 'en') {
            $lang = 'vn';
        }
        $sql = "SELECT * FROM productcat_languages Where languages_code = '$langu' And friendly_url = '$url'";
        $result = mysqli_query($conn_vn, $sql);
        $row = mysqli_fetch_assoc($result);

        $sql = "SELECT * FROM productcat_languages Where languages_code = '$lang' And productcat_id = ".$row['productcat_id'];
        $result = mysqli_query($conn_vn, $sql);
        $row = mysqli_fetch_assoc($result);

        return $row['friendly_url'];
    }
    $url_lang = get_url_lang($slug, $lang);
?>
<div class="sub-header products">
     <h3 class="titleCateProduct"><span><?= $rowCatLang['lang_productcat_name']?></span></h3>
</div>
<div id="container" id="aboutus" class="clearfix">
    <div class="sidebar-left fl-left">
        <div class="menu-about-us-sidebar-container">
            <h3><span>DANH MỤC SẢN PHẨM</span></h3>
            <ul class="sub-menu">
                <li id="menu-item-2526" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-2526">
                    <a href="categories.html">nấm tươi</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="right-content fl-left">
        <h3 class="titleCateProduct"><span><?= $rowCatLang['lang_productcat_name']?></span></h3>
        <input type="hidden" name="lang_current" id="lang_current" value="<?php echo $lang;?>">
        <input type="hidden" name="url_lang" value="<?php echo $url_lang;?>" id="url_lang">
        <?php 
            foreach ($rows['data'] as $row) {
                $action_product1 = new action_product(); 
                $rowLang1 = $action_product->getProductLangDetail_byId($row['product_id'],$lang);
                $row1 = $action_product->getProductDetail_byId($row['product_id'],$lang);
        ?>
        <div class="list-product">
            <div class="img-thumb">
                <a href="/<?= $rowLang1['friendly_url']?>" title="">
                    <img src="/images/<?= $row1['product_img']?>" alt="">
                </a>
            </div>
            <div class="title-list-product">
                <a href="/<?= $rowLang1['friendly_url']?>" title="">
                    <?= $rowLang1['lang_product_name']?>
                </a>
            </div>
            <div class="price">
               <?= number_format($row1['product_price'],'0','','.')?> VNĐ
            </div>
            <div class="addtocart">
                <a href="javascript:void(0)" class="linkPH" onclick="load_url('<?php echo $row['product_id'];?>', '<?php echo $rowLang1['lang_product_name'];?>', '<?php echo $row1['product_price'];?>')"> thêm vào giỏ</a>
            </div>
        </div>
        <?php
            }
        ?>
    </div>
    <!-- phân trang -->
    <nav class="woocommerce-pagination">
        <div>
            <!-- <?= $paging ?> -->
            <?= $rows['paging'] ?>
        </div>   
    </nav>
</div>
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