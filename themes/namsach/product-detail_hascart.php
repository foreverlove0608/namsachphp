<?php

    $action_product = new action_product(); 
    $slug = isset($_GET['slug']) ? $_GET['slug'] : '';

    $rowLang = $action_product->getProductLangDetail_byUrl($slug,$lang);
    $row = $action_product->getProductDetail_byId($rowLang['product_id'],$lang);
    $_SESSION['productcat_id_relate'] = $row['productcat_id'];
    $_SESSION['sidebar'] = 'productDetail';

    $cart->emptyCartTmp();   
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
<script>  
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
 </script>

        <div id="Content-infoPage">
            <div class="Center-Width">
                <div class="Infor-Width">                    
                    <div class="rowInfoPage">                               
                        <div class="rowBreadcrumb">
                            <a href="/tin-tuc-1" class="titleBreadcrumb"><p>Trang Chủ</p> <i class="iconfont-right3"></i></a>
                            <a href="/tin-tuc-2" class="titleBreadcrumb"><p><?= $row['product_name']?></p></a>
                        </div>
                        <div class="leftInfoPage">                    
                            <div class="leftProductDetail">
                                <a href="#" class="mainIMGPD"><img src="../image/product/<?= $row['product_img']?>" /></a>
                            </div>  
                            <div class="rightProductDetail">
                                <h1 class="nameProductDetail"><?= $row['product_name']?></h1>
                                <p class="notePD">Tình trạng: <strong>Còn hàng</strong></p>
                                <div class="likeAddthis"></div>
                                <div class="shortDesPD"> 
                                    <div class="listStar">
                                        <i class="iconfont-top4"></i>
                                        <i class="iconfont-top4"></i>
                                        <i class="iconfont-top4"></i>
                                        <i class="iconfont-top4"></i>
                                        <i class="iconfont-top4"></i>
                                    </div>     
                                    <!-- start - content description -->                                                                                         
                                    
                                    <!-- end - content description -->

                                <!-- Start - Giỏ hàng -->   
                                <div class="tab-content" style="width: 100%;float:left;">
                                    <table style=" margin-top:10px;">
                                        <thead>
                                            <tr>
                                                <th width="100%" style="font-size:17px; font-weight:bold;">Giá</th>
                                                <th width="100%" style="font-size:17px; font-weight:bold;">Số lượng <span style=" color:#C00;">(*)</span></th>
                                            </tr>                                                            
                                        </thead>
                                        <tbody>
                                            <tr style="border-bottom: 1px dashed #e7e7e7" data-cart="<?php echo htmlentities(json_encode(array("price"=>$row['product_price'], "product"=>$row['product_id'])))?>" >
                                                <td width="100%" style="height: 37px;vertical-align: middle;" class="priceProductDetail"><strong><span><?= number_format($row['product_price'],'0','','.')?>đ</span></strong></td>
                                                <td width="100%" style="height: 37px;vertical-align: middle;"><input placeholder="Vui lòng nhập số lượng" type="number" name="" class="amount" min="1" value="1" style="outline:none;"></td>
                                            </tr>
                                        </tbody>
                                    </table>                                    
                                </div>
                                
                                <div style="float: right;">
                                  <div style="margin: 6px 0px; width:100%; float:left;">
                                      <button class="btnProductDetail" id="submit" style="float: right;"><i class="iconfont-cart1"></i>Mua ngay</button>
                                  </div>
                                </div>
                                <!-- End - Giỏ hàng -->   

                                <!-- mua hang test -->
                                <div class="col-md-4" style="margin-top:12px;">  
                                      <div style="border:1px solid #333; background-color:#f1f1f1; border-radius:5px; padding:16px; height:350px;" align="center">  
                                           <img src="images/<?php echo $row['product_img']; ?>" class="img-responsive" /><br />  
                                           <h4 class="text-info">San pham: <?php echo $row1['product_name']; ?></h4> 
                                           <h4 class="text-danger"><?php echo number_format($row['product_price']); ?> (vnd)</h4>  
                                           <input type="text" name="quantity" id="quantity<?php echo $row['product_id']; ?>" class="form-control" value="1" />  
                                           <input type="hidden" name="hidden_name" id="name<?php echo $row['product_id']; ?>" value="<?php echo $row['product_name']; ?>" />  
                                           <input type="hidden" name="hidden_price" id="price<?php echo $row['product_id']; ?>" value="<?php echo $row['product_price']; ?>" />  
                                           <input type="button" name="add_to_cart" id="<?php echo $row['product_id'] ?>" style="margin-top:5px;" class="btn btn-warning form-control add_to_cart" value="Add to Cart" />  
                                      </div>  
                                 </div>
                                <!-- mua hang test -->

                               </div>                            
                            </div>      
                            <div class="bottomProductDetail">
                                <span class="span-tab">
                                    <span class="span-tab1 span_tab"><a href="#tab_1">Chi tiết sản phẩm</a></span>
                                    <span class="span-tab2 span_tab"><a href="#tab_2">Giao hàng - Thanh toán</a></span>
                                    <span class="span-tab3 span_tab"><a href="#tab_3">Cam kết từ Green Phar</a></span>
                                    <span class="span-tab4 span_tab"><a href="#tab_4">Đánh Giá</a></span>
                                </span>
                                <div class="span_tab_content" id="tab_1">
                                    <div class="contentPDTab">
                                    <!-- start - content product -->
                                    <?= $row['product_content']?>

                                        
                                    <!-- end - content product -->    
                                    </div>
                                </div>
                                <div class="span_tab_content" id="tab_2">
                                    <div class="contentPDTab">
                                <h2>Giao hàng</h2>      

                                <p>

                                Sau khi đặt hàng thành công, Bộ phận Chăm sóc Khách hàng của DP GREEN- PHAR sẽ liên hệ với Quý khách để xác nhận và gửi email/sms về thông tin đơn hàng trong thời gian sớm nhất. Hiện tại DP GREEN-PHAR hợp tác với ViettelPost - đơn vị chuyển phát hàng đầu tại Việt Nam để thực hiện chuyển phát các sản phẩm tới Quý khách hàng.<br>

Sau khi xác nhận thành công, đơn hàng sẽ được giao đến Quý khách trong khoảng thời gian sau đây:

<strong>Tại Thành phố Hồ Chí Minh và Hà Nội:</strong> Giao hàng sau 1 - 4h làm việc<br>

<strong>Các khu vực tỉnh, thành còn lại:</strong> Giao hàng sau 1 - 2 ngày làm việc<br>

<em>*Lưu ý: thời gian giao hàng dự kiến ở trên chỉ áp dụng cho các đơn hàng trong nước.</em>

Tất cả các đơn hàng từ khắp cả nước sẽ được chia làm 2 khu vực và phí vận chuyển áp dụng cho tất cả các đơn hàng của Quý khách (trong đó, DP GREEN-PHAR đã hỗ trợ 50-70% chi phí giao hàng và phí thu tiền hộ):

<br>

<i class="iconfont-address4"></i><strong style="text-decoration:underline;">Khu vực 1:</strong>&nbsp;Thành phố Hồ Chí Minh và Hà Nội là 10.000đ/đơn hàng bất kỳ <br>

<i class="iconfont-address4"></i><strong style="text-decoration:underline;">Khu vực 2:</strong>&nbsp;Các tỉnh, thành phố còn lại trên toàn quốc là 20.000đ/đơn hàng bất kỳ<br>

<i class="iconfont-address4"></i><strong style=" color:#C00;">FREE SHIP NẾU ĐƠN HÀNG TRÊN 600.000 VNĐ.</strong>



                                </p>

                                <p style="color:#0055ab;">

                                Quý khách hàng lưu ý luôn luôn kiểm tra kĩ tình trạng sản phẩm sau khi nhận được ngay tại thời điểm nhận hàng và có sự chứng kiến của nhân viên giao hàng. Các vấn đề như bể vỡ, vỏ hộp chai thuốc bị rách nát hoặc seal đã bị mở, … Tất cả những sự cố này sẽ chỉ được đổi trả nếu do lỗi từ phía nhân viên của DP GREEN-PHAR và đơn vị vận chuyển ViettelPost.

                                </p>

                                <p>

                                Trong quá trình giao hàng có thể phát sinh những vấn đề ngoài ý muốn về phía Khách hàng khiến việc giao hàng bị chậm trễ. DP GREEN-PHAR sẽ linh động giải quyết cho Khách hàng trong từng trường hợp như sau:<br>



- Khách hàng không cung cấp chính xác và đầy đủ địa chỉ giao hàng và số điện thoại liên lạc.<br>



- Khách hàng không sẵn sàng để nhận hàng vào thời điểm giao hàng.<br>



- DP GREEN- PHAR đã giao hàng đúng hẹn theo thông tin giao hàng nhưng không liên lạc được với Khách hàng và chờ tại địa điểm giao hàng quá 15 phút, mọi nỗ lực của nhân viên giao hàng nhằm liên hệ với Khách hàng đều không thành công.<br>

<h2>THANH TOÁN</h2>
<p>
DP GREEN- PHAR hỗ trợ 4 phương thức thanh toán cho tất cả các đơn hàng trên hệ thống.<br />

1. Thanh toán khi nhận hàng (COD): Quý khách sẽ thanh toán tiền mặt cho nhân viên giao hàng ngay sau khi nhận được hàng.<br />

2. Thanh toán bằng Internet Banking: Thẻ/tài khoản ATM của quý khách có đăng kí sử dụng dịch vụ internet banking<br />
3. Thanh toán bằng thẻ quốc tế Visa, Master Card<br />
4. Chuyển khoản trực tiếp tại ngân hàng.<br />

Mọi thắc mắc và góp ý vui lòng liên hệ Hotline Chăm sóc khách hàng: <strong>(024) 6262.7731</strong>
</p>

                                    </div>
                                </div>
                                <div class="span_tab_content" id="tab_3">
                                    <div class="contentPDTab">
                                        <p><strong>Cam kết bán hàng tại DP GREEN- PHAR  được xây dựng dựa trên uy tín và sứ mệnh mang đến những sản phẩm chất lượng, tốt nhất cho khách hàng.</strong><br />
                                        <i class="iconfont-tick2"></i>Mang đến cho khách hàng sản phẩm chính hãng, có tem bảo hành và nguồn gốc xuất xứ, lô sản xuất và hạn sử dụng đầy đủ.<br />
<i class="iconfont-tick2"></i>Hoàn tiền 100% cho khách hàng nếu sản phẩm bị thất lạc, sai sót từ phía DP GREEN-PHAR dẫn đến giao dịch không thành công hoặc sản phẩm bị hư hỏng, bể vỡ do lỗi của DP GREEN-PHAR...<br />
<i class="iconfont-tick2"></i>Luôn cung cấp sản phẩm đúng chất lượng như hình ảnh và thông tin đăng tải theo đúng mức giá được niêm yết.<br />
<i class="iconfont-tick2"></i>Giữ bí mật tuyệt đối thông tin của khách hàng, không chia sẻ cho các cá nhân và tổ chức khác.<br />
<i class="iconfont-tick2"></i>Bán đúng giá tại các nhà thuốc (chưa bao gồm phí giao hàng).<br />
<i class="iconfont-tick2"></i>Giao hàng tận nơi trên toàn quốc.<br />
<i class="iconfont-tick2"></i>Cam kết bảo mật thông tin cá nhân của tất cả khách hàng.<br />
<strong>Thông tin của khách hàng sẽ được DP GREEN- PHAR sử dụng với những công việc được đưa ra trong chính sách này.</strong><br />
<i class="iconfont-tick2"></i>DP GREEN- PHAR chỉ sử dụng thông tin của khách hàng trong thời gian mà pháp luật cho phép và chỉ phục vụ cho giao dịch giữa 2 bên.<br />
<i class="iconfont-tick2"></i>Thông tin của khách hàng tuyệt đối sẽ không được mua bán hay chuyển giao cho bên thứ 3.<br />
<strong>Thông tin khách hàng mà chúng tôi thu thập và do khách hàng đồng ý cung cấp gồm:</strong><br />
<strong>1. </strong>Tên khách hàng, Năm sinh<br />
<strong>2. </strong>Số điện thoại liên hệ<br />
<strong>3. </strong>Email (nếu có)<br />
<strong>4. </strong>Địa chỉ giao nhận<br />
<strong>Các thông tin trên được DP GREEN-PHAR sử dụng vào các mục đích:</strong><br />
<i class="iconfont-tick2"></i>Liên lạc với khách hàng để xác minh đơn đặt hàng.<br />
<i class="iconfont-tick2"></i>Thông báo về việc giao hàng và hỗ trợ khách hàng.<br />
<i class="iconfont-tick2"></i>Xử lý đơn hàng của khách hàng trên hệ thống<br />
<i class="iconfont-tick2"></i>DP GREEN- PHAR sẽ chia sẻ thông tin khách hàng (Địa chỉ nhận hàng và số điện thoại liện hệ) với công ty chuyển phát nhanh để phục vụ cho việc giao hàng tới quý khách.<br />
<strong>Bảo mật thông tin cá nhân khách hàng:</strong><br />
<i class="iconfont-tick2"></i>DP GREEN- PHAR đảm bảo tất cả mọi thông tin của khách hàng sẽ được bảo mật tuyệt đối và sử dụng đúng mục đích.<br />
<i class="iconfont-tick2"></i>Sau khi đã hoàn thành giao dịch thông tin khách hàng sẽ được chúng tôi xóa khỏi hệ thống chỉ lưu lại các thông tin cần thiết để hỗ trợ khách hàng dịch vụ về sau.<br />
<strong>Chính sách bảo mật tại DP GREEN- PHAR:</strong><br />
<i class="iconfont-tick2"></i>DP GREEN- PHAR có thể thay đổi chính sách bảo mật và mọi thay đổi sẽ được công khai trên website: www.greenphar.com<br />
<i class="iconfont-tick2"></i>Tất cả các thay đổi về chính sách bảo mật chúng tôi đều tuân thủ theo quy định của Pháp Luật Nhà Nước hiện hành.<br />
<i class="iconfont-tick2"></i>Mọi ý kiến thắc mắc, khiếu nại và tranh chấp vui lòng liên hệ với chúng tôi qua hotline: <strong>(024) 6262. 7731</strong><br /><br />
Trân trọng,<br />
<strong style="color:#096DDD; font-style:italic;">DP GREEN-PHAR: Chu Đáo, Tin Cậy!</strong>

                                        </p>                                        
                                    </div>
                                </div>
                                <div class="span_tab_content" id="tab_4">
                                    <div class="contentPDTab">


                                        <!-- start - đánh giá product -->    
                                        <div class="fb-comments" data-href="https://www.facebook.com/ANTRIGP/posts/206227106552097" data-width="100%" data-numposts="5"></div>
                                        <!-- end - đánh giá product -->    
                                        
                                    </div>
                                </div>
                            </div>                  
                        </div>
                        <?php include ('interface/sidebar_right.php'); ?>                    
                    </div>
                </div> <!-- end Infor-Width -->
            </div> <!-- end Center-Width -->
        </div> <!-- end Content-Pro-Cate -->





