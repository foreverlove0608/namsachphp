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
 <script type="text/javascript">
   $(document).ready(function(data){  
      $('.btn_addCart').click(function(){  
         // var product_id = $(this).attr("id");
           var product_id = $('#product_id').val();
           var product_name = $('#product_name').val();  
           var product_price = $('#product_price').val();  
           var product_quantity = $('.number_cart').val();  
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
 <link rel="stylesheet" type="text/css" href="/css/templates/product_tpl_pageDetail.css">
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
 </style>
<div id="Content-pageDetailProduct">
    <div class="Center-Width">  
        <div class="Infor-Width">   
            <div class="container">
                <div class="row" style="margin-top: 100px;"> 
                    <div class="col-md-9 col-sm-12" style="padding: 0px;">
                        <div class="leftProductDetail">
                            <img src="/images/<?= $row['product_img']?>" class="imgPD">
                        </div>
                        
                        <input type="hidden" name="lang_current" id="lang_current" value="<?php echo $lang;?>">
                        <input type="hidden" name="url_lang" value="<?php echo $url_lang;?>" id="url_lang">
                        <div class="rightProductDetail">   
                            <h1 class="nameProductDetail"><?= $rowLang['lang_product_name']?></h1>
                            <span class="subProductDetail">Mã sản phẩm: <strong><?= $rowLang['lang_product_code']?></strong></span>
                            <span class="subProductDetail">Hãng sản xuất: <strong><?= $row['product_expiration']?></strong></span>
                            <span class="subProductDetail">Xuất xứ: <strong><?= $row['product_material']?></strong></span>
                            <span class="priceProductDetail"><?= number_format($row['product_price'],'0','','.')?> VNĐ</span>
                            <div class="rowBuyPD">
                                <input type="number" name="quantity" value="1" placeholder="" class="number_cart">
                                <input type="hidden" name="id" id="product_id" value="<?php echo $rowLang['product_id'];?>">
                                <input type="hidden" name="name" id="product_name" value="<?= $rowLang['lang_product_name'];?>">
                                <input type="hidden" name="price" id="product_price" value="<?php echo $row['product_price'];?>">
                                <button type="submit" class="btn_addCart">Thêm vào giỏ</button>                         
                            </div>
                            <!-- <a target="_blank" href="https://www.nganluong.vn/button_payment.php?receiver=truongquangtuan3110@gmail.com&product_name=<?= $rowLang['lang_product_name'] ?>&price=4000&return_url=(URL thanh toán thành công)&comments=(Ghi chú về đơn hàng)"><img src="https://www.nganluong.vn/css/newhome/img/button/pay-lg.png" border="0" /></a> -->

                            <p class="callProductDetail">Liên hệ ngay để được tư vấn<br><strong>0123.456.789</strong></p>
                            <div class="fb-share-button" data-href="<?= curPageURL(); ?>" data-layout="button_count" data-size="small" data-mobile-iframe="true"><a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse">Chia sẻ</a></div>
                        </div>
                        <?php
                          $img_sub = json_decode($row['product_sub_img']);
                        ?>
                        <div class="box_sub_image">
                          <ul class="sub_image">
                              <div class="row">
                                    <?php foreach ($img_sub as $item) {?>
                                        <?php $image = json_decode($item, true);?>
                                        <li class="item_image">
                                            <div class="sub_item_image">
                                                <img src="/images/<?= $image['image'] ?>"/>
                                            </div>
                                        </li>
                                    <?php } ?>                                                     
                              </div>
                          </ul>
                        </div>
                        
                        <p class="mainNameProduct"><span>Thông tin chi tiết</span></p>
                        <div class="contentPageProductDetail">
                            <?= $rowLang['lang_product_content']?>
                            
                        </div>
                        <div style="float: left;">
                          <div class="fb-comments" data-href="<?= curPageURL(); ?>" data-numposts="15"></div>
                        </div>                  
                    </div>
                    <div class="col-md-3 col-sm-12" style="padding: 0px;">
                        <?php include_once "templates/sideBar/sideBar_tpl_RightBar.php";  ?> 
                    </div>           
                </div>
            </div>
        </div><!--end Infor-Width-->  
    </div><!--end Center-Width-->
</div><!--end Content-pageDetailProduct-->