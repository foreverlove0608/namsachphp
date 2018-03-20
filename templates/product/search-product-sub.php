<?php 
	$page = $_GET['page'];
	$trang = $_GET['trang'];
    $limit = 12;
	// $q = $_GET['search'];
    
    if (isset($_POST['q'])) {
        $q = $_POST['q'];
        $q = vi_en($q);
        $q = trim($q);
    } else {
        $q = $_GET['search'];
        $q = str_replace('-', ' ', $q);
    }

    if ($trang != 0) {
        $position = $trang*$limit;
    } else {
        $position = 0;
    }
    
    
    $sql_total_record = "SELECT * FROM product_languages INNER JOIN product ON product_languages.product_id = product.product_id WHERE (product_name like '%$q%' or product_code like '%$q%') And languages_code = '$lang' ";
    $result_total_record = mysqli_query($conn_vn, $sql_total_record);
    $total_record = mysqli_num_rows($result_total_record);
	
	$sql = "SELECT * FROM product_languages INNER JOIN product ON product_languages.product_id = product.product_id WHERE (product_name like '%$q%' or product_code like '%$q%') And languages_code = '$lang' Limit $position,$limit ";
	$result = mysqli_query($conn_vn,$sql);
	
	$rows = array();
	while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
		$rows[] = $row;
	}

    // $return_search = $action->getListProductSearch1($q, $position);
    // $rows = $return_search['data'];
?>
<?php 
    $action = new action();
    $action_product = new action_product();   
    $slug = 'sextoy-nguoi-lon';                    
    $rowCatLang = $action_product->getProductCatLangDetail_byUrl($slug,$lang);
    $rowCat = $action_product->getProductCatDetail_byId($rowCatLang['productcat_id'],$lang);
    // if ($rowCat['newscat_id'] > 1) $rowsCatSub = $action->getList('newscat','newscat_parent',$rowCatLang['newscat_id'],'newscat_id','desc',$trang,12,'newsCat-cat');
    // $rows = $action_product->getProductList_byMultiLevel_orderProductId($rowCat['productcat_id'],'desc',$trang,12,$rowCat['friendly_url']); 
?> 

<!-- HIỂN THỊ SẢN PHẨM ĐƯỢC KIẾM TÌM -->
<div class="sub-header products">
    TÌM KIẾM SẢN PHẨM
</div>
<div id="container" id="aboutus" class="clearfix">
    <div class="sidebar-left fl-left">
        <div class="menu-about-us-sidebar-container">
            <ul class="sub-menu">
                <li id="menu-item-2526" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-2526">
                    <a href="categories.html">nấm tươi</a>
                </li>
                <li id="menu-item-284" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-284">
                    <a href="categories.html">nấm khô</a>
                </li>
                <li id="menu-item-853" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-853">
                    <a href="categories.html">thực phẩm từ nấm</a>
                </li>
                <li id="menu-item-853" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-853">
                    <a href="categories.html">quà tặng nấm</a>
                </li>
                <li id="menu-item-853" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-853">
                    <a href="categories.html">cây cảnh nấm</a>
                </li>
                <li id="menu-item-853" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-853">
                    <a href="categories.html">sản phẩm khác</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="right-content fl-left">
        <h3>KẾT QUẢ TÌM KIẾM:</h3>
        <?php 
            foreach ($rows as $v_row) {
                $action_product1 = new action_product(); 
                $rowLang1 = $action_product->getProductLangDetail_byId($v_row['product_id'],$lang);
                $row1 = $action_product->getProductDetail_byId($v_row['product_id'],$lang);
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
                <a href="javascript:void(0)" class="linkPH" onclick="load_url('<?php echo $row['product_id'];?>', '<?php echo $rowLang1['lang_product_name'];?>', '<?php echo $row1['product_price'];?>')">thêm vào giỏ hàng</a>
            </div>
        </div>
        <?php
            }
        ?>

        <!-- HIỂN THỊ THANH PHÂN TRANG -->
        <?php
            $config = array(
                'current_page'  => $trang+1, // Trang hiện tại
                'total_record'  => $total_record, // Tổng số record
                'total_page'    => 1, // Tổng số trang
                'limit'         => $limit,// limit
                'start'         => 0, // start
                'link_full'     => '',// Link full có dạng như sau: domain/com/page/{page}
                'link_first'    => '',// Link trang đầu tiên
                'range'         => 9, // Số button trang bạn muốn hiển thị 
                'min'           => 0, // Tham số min
                'max'           => 0,  // tham số max, min và max là 2 tham số private
                'search'        => str_replace(' ', '-', $q)

            );

            $pagination = new Pagination;
            $pagination->init($config);
            
        ?>
    </div>
    <div>
        <?php echo $pagination->htmlPaging1(); ?>
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
    </div>
</div>
