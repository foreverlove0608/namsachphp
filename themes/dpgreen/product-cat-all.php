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

    $rows_sp = $action->getList('product','','','product_id','desc','','','product-cat');
    $record = count($rows_sp);
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
<link rel="stylesheet" type="text/css" href="/css/templates/product_tpl_pageCate.css">
<div id="Content-pageCateProduct">
    <div class="Center-Width">  
        <div class="Infor-Width">   
            <div class="container">
                <div class="row"> 
                    <div class="col-md-9 col-sm-12" style="padding: 0px;">
                        <h3 class="titleCateProduct"><span><?= $rowCatLang['lang_productcat_name']?></span></h3>
                        <input type="hidden" name="lang_current" id="lang_current" value="<?php echo $lang;?>">
                        <input type="hidden" name="url_lang" value="<?php echo $url_lang;?>" id="url_lang">
                        <div class="row subRow">
                        <?php 
                            foreach ($rows['data'] as $row) {
                                $action_product1 = new action_product(); 
                                $rowLang1 = $action_product->getProductLangDetail_byId($row['product_id'],$lang);
                                $row1 = $action_product->getProductDetail_byId($row['product_id'],$lang);
                        ?>
                            <div class="col-md-3 col-sm-4 col-xs-6 subRowPH">
                                <div class="coverBoxCateProduct">            
                                    <a href="/<?= $rowLang1['friendly_url']?>" class="imgProductCate"><img src="/images/<?= $row1['product_img']?>"></a>
                                    <a href="/<?= $rowLang1['friendly_url']?>" class="nameProductCate"><?= $rowLang1['lang_product_name']?></a>
                                    <div class="rowSubProductCate">
                                        <p class="pricePH"><?= number_format($row1['product_price'],'0','','.')?>VNĐ</p>
                                        <a href="javascript:void(0)" class="linkPH" onclick="load_url('<?php echo $row['product_id'];?>', '<?php echo $rowLang1['lang_product_name'];?>', '<?php echo $row1['product_price'];?>')">MUA</a>
                                    </div>
                                </div>
                            </div>                        
                        <?php
                            }
                        ?>
                                                
                        </div> 
                        <div>
                            <!-- <?= $paging ?> -->
                            <?php
    $config = array(
        'current_page'  => $trang, // Trang hiện tại
        'total_record'  => $record, // Tổng số record
        'total_page'    => 1, // Tổng số trang
        'limit'         => 12,// limit
        'start'         => 0, // start
        'link_full'     => '',// Link full có dạng như sau: domain/com/page/{page}
        'link_first'    => '',// Link trang đầu tiên
        'range'         => 9, // Số button trang bạn muốn hiển thị 
        'min'           => 0, // Tham số min
        'max'           => 0,  // tham số max, min và max là 2 tham số private
    );

    $pagination = new Pagination;
    $pagination->init($config);
    
    echo $pagination->htmlPaging_tuan('san-pham');
?>
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
        xhttp.open("POST", "/themes/dpgreen/ajax-add-cart.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("action1=add_cart&product_id="+id+"&product_name="+name+"&product_price="+price+"&product_quantity=1&action=add");
        xhttp.send();        
    }
</script>