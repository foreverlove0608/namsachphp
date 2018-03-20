<?php 
    $action_product = new action_product(); 
    $slug = isset($_GET['slug']) ? $_GET['slug'] : '';

    $rowLang = $action_product->getProductLangDetail_byUrl($slug,$lang);
    $row = $action_product->getProductDetail_byId($rowLang['product_id'],$lang);
    $_SESSION['productcat_id_relate'] = $row['productcat_id'];
    $_SESSION['sidebar'] = 'productDetail';

    // $cart->emptyCartTmp();   
    /*******************************
     * Một số biến được lấy ra từ cơ sở dữ liệu 
     * 0. ID sản phẩm: <?= $row['product_id'];?>
     * 1. Tên sản phẩm: <?= $row['product_name']?>
     * 2. Đường dẫn: <?= $row['friendly_url']?>
     * 3. Nội dung: <?= $row['product_content']?>
     * 4. Mô tả: <?= $row['product_des']?>
     * 5. Ảnh sp: <?= $row['product_img']?>
     * 6. Giá: <?= number_format($row['product_price'],'0','','.')?>
     * 7. Giá KM: <?= number_format($row['product_sale'],'0','','.')?>
     * 8.    
    */
?>
<!-- <script>  
 $(document).ready(function(data){  
      $('.add_to_cart').click(function(){  
           var product_id = $(this).attr("id");  
           var product_name = $('#name'+product_id).val();  
           var product_price = $('#price'+product_id).val();  
           var product_quantity = $('#quantity'+product_id).val();  
           var action = "add";  
           if(product_quantity > 0)  
           {  
                $.ajax({  
                     url:"ajax.php?action=add_cart",  
                     method:"POST",  
                     dataType:"json",  
                     data:{  
                          product_id:product_id,   
                          product_name:product_name,   
                          product_price:product_price,   
                          product_quantity:product_quantity,   
                          action:action  
                     },  
                     success:function(data)  
                     {  
                          $('#order_table').html(data.order_table);  
                          $('.badge').text(data.cart_item);  
                          if (confirm('Thêm sản phẩm thành công, bạn có muốn thanh toán luôn không')) {
                              window.location = '/cart-detail';
                          }else{
                              location.reload();
                          }  
                     }  
                });  
           }  
           else  
           {  
                alert("Please Enter Number of Quantity")  
           }  
      });  
      $(document).on('click', '.delete', function(){  
           var product_id = $(this).attr("id");  
           var action = "remove";  
           if(confirm("Are you sure you want to remove this product?"))  
           {  
                $.ajax({  
                     url:"ajax.php?action=add_cart",  
                     method:"POST",  
                     dataType:"json",  
                     data:{product_id:product_id, action:action},  
                     success:function(data){  
                          $('#order_table').html(data.order_table);  
                          $('.badge').text(data.cart_item);  
                     }  
                });  
           }  
           else  
           {  
                return false;  
           }  
      });  
      $(document).on('keyup', '.quantity', function(){  
           var product_id = $(this).data("product_id");  
           var quantity = $(this).val();  
           var action = "quantity_change";  
           if(quantity != '')  
           {  
                $.ajax({  
                     url :"ajax.php?action=add_cart",  
                     method:"POST",  
                     dataType:"json",  
                     data:{product_id:product_id, quantity:quantity, action:action},  
                     success:function(data){  
                          $('#order_table').html(data.order_table);  
                     }  
                });  
           }  
      });  
 });  
 </script> -->
<script src="js/jquery-min.js"></script>
 <script type="text/javascript">
   $(document).ready(function(data){  
      $('.btn_addCart').click(function(){ 
          //alert('OK');
         // var product_id = $(this).attr("id");
           var product_id = $('#product_id').val();
           var product_name = $('#product_name').val();  
           var product_price = $('#product_price').val();  
           var product_quantity = $('.number_cart').val();
           console.log(product_quantity);
           var action = "add";
           // var a = {a : 'a'};
           if(product_quantity > 0)  
           {  
                // $.ajax({  
                //      url:"http://shoptraicam.thietkewebsitegbvn.com/functions/ajax.php",  
                //      method:"POST",  
                //      dataType:"json",  
                //      data: a,  
                //      success:function(data)  
                //      {  
                //           // $('#order_table').html(data.order_table);  
                //           // $('.badge').text(data.cart_item);  
                //           // if (confirm('Thêm sản phẩm thành công, bạn có muốn thanh toán luôn không')) {
                //           //     window.location = '/cart-detail';
                //           // }else{
                //           //     location.reload();
                //           // }  
                //           alert('success');
                //      },
                //      error: function (error) {
                //         alert('error: ');
                //      }
                // });  

                // alert(product_price);
                // var xhttp = new XMLHttpRequest();
                // xhttp.onreadystatechange = function() {
                //   if (this.readyState == 4 && this.status == 200) {
                //    // document.getElementById("demo").innerHTML = this.responseText;
                //    // alert(this.responseText);
                //    alert('Thêm giỏ hàng thành công.');
                //    // window.location.href = "/cart-detail";
                //   }
                // };
                // xhttp.open("POST", "/themes/dpgreen/ajax-add-cart.php", true);
                // xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                // xhttp.send("action1=add_cart&product_id="+product_id+"&product_name="+product_name+"&product_price="+product_price+"&product_quantity="+product_quantity+"&action=add");
                // xhttp.send();

                 $.ajax({  
                     url:"/functions/ajax.php?action=add_cart",  
                     method:"POST",  
                     dataType:"json",  
                     data:{  
                          product_id:product_id,   
                          product_name:product_name,   
                          product_price:product_price,   
                          product_quantity:product_quantity,   
                          action:action  
                     },  
                     success:function(data)  
                     {  
                          // $('#order_table').html(data.order_table);  
                          // $('.badge').text(data.cart_item);  
                          if (confirm('Thêm sản phẩm thành công, bạn có muốn thanh toán luôn không')) {
                              window.location = '/cart-detail';
                          }else{
                              location.reload();
                          }  
                     },
                     error: function () {
                        alert('loi');
                     }  
                });  

           }  
           else  
           {  
                alert("Please Enter Number of Quantity")  
           }  
      });
   });
 </script>
 <?php 
    function get_url_lang ($url, $langu) {
        global $conn_vn;
        if ($langu == 'vn') {
            $lang = 'en';
        } elseif ($langu == 'en') {
            $lang = 'vn';
        }
        $sql = "SELECT * FROM product_languages Where languages_code = '$langu' And friendly_url = '$url'";
        $result = mysqli_query($conn_vn, $sql);
        $row = mysqli_fetch_assoc($result);

        $sql = "SELECT * FROM product_languages Where languages_code = '$lang' And product_id = ".$row['product_id'];
        $result = mysqli_query($conn_vn, $sql);
        $row = mysqli_fetch_assoc($result);

        return $row['friendly_url'];
    }
    $url_lang = get_url_lang($slug, $lang);
?>
 
 
 <div class="sub-header products">
    <h3 class="">
        <?= $rowLang['lang_product_name']?>
    </h3>
 </div>
 <div id="container" id="aboutus">
     <div class="wp-content clearfix">
         <div class="sidebar-left fl-left">
             <div class="single-product-services">
                 <div class="service-item">
                     <div class="service-item-icon">
                         <i class="fas fa-truck"></i>
                     </div>
                     <h3 class="service-item-title">VẬN CHUYỂN</h3>
                     <p>Miễn phí ship trong nội thành Hà Nội với đơn hàng trên 200k</p>
                 </div>
                 <div class="service-item">
                     <div class="service-item-icon">
                         <i class="fas fa-trophy"></i>
                     </div>
                     <h3 class="service-item-title">CHẤT LƯỢNG</h3>

                     <p>Cam kết chỉ cung cấp các loại nấm rõ nguồn gốc và được chứng nhận an toàn vệ sinh thực phẩm</p>
                 </div>
             </div>
         </div>
         <div class="right-content fl-left">
             <div class="clearfix">
                 <div class="img-product-thumb img-pro">
                    <img src="/images/<?= $row['product_img']?>" class="imgPD">
                    <?php
                        $img_sub = json_decode($row['product_sub_img']);
                    ?>
                    <ul>
                        <?php foreach ($img_sub as $item) {?>
                            <?php $image = json_decode($item, true);?>
                            <li class="item_image">
                                <div class="sub_item_image">
                                    <img src="/images/<?= $image['image'] ?>"/>
                                </div>
                            </li>
                        <?php } ?> 
                    </ul>  
                 </div>
                <input type="hidden" name="lang_current" id="lang_current" value="<?php echo $lang;?>">
                <input type="hidden" name="url_lang" value="<?php echo $url_lang;?>" id="url_lang">
                 <div class="content-product">
                     <h3 class="title-detail-pro">
                         <?= $rowLang['lang_product_name']?>
                     </h3>
                     <h4 class="price-detail-pro">
                         <span><?= number_format($row['product_price'],'0','','.')?> VNĐ</span>
                     </h4>
                    <div class="quantity">
                       <input type="number" name="quantity" value="1" placeholder="" class="number_cart" size="4">
                       <input type="hidden" name="id" id="product_id" value="<?php echo $rowLang['product_id'];?>">
                       <input type="hidden" name="name" id="product_name" value="<?= $rowLang['lang_product_name'];?>">
                       <input type="hidden" name="price" id="product_price" value="<?php echo $row['product_price'];?>">
                    </div>
                    <button type="submit" class="btn_addCart">Thêm vào giỏ hàng</button>
                 </div>
             </div>
             <div class="woocommerce-tabs">
                 <ul class="tabs">
                     <li class="description_tab active">
                         <a href="#tab-description">Mô Tả</a>
                     </li>
                 </ul>
                 <div class="panel entry-content" id="tab-description" style="display: block;">
                    <p class="subProductDetail">Mã sản phẩm: <strong><?= $rowLang['lang_product_code']?></strong></p>
                    <p class="subProductDetail">Hãng sản xuất: <strong><?= $row['product_expiration']?></strong></p>
                    <p class="subProductDetail">Xuất xứ: <strong><?= $row['product_material']?></strong></p>
                     <?= $rowLang['lang_product_content']?>
                </div>
            </div>
     </div>
 </div>
 
 
<!-- <link rel="stylesheet" type="text/css" href="/css/templates/product_tpl_pageDetail.css">
 <style type="text/css">
  .box_sub_image {
    margin-left: 15px;
  }
   .item_image {
    width: 80px;
    height: 80px;
   }

   .sub_item_image {
    width: 100%;
    height: 100%;
   }

   .sub_item_image > img {
    width: 100%;
    height: 100%;
   }

   .contentPageProductDetail * {
    float: none;
   }
 </style>-->