<?php 
    if (isset($_POST['gui_lienhe'])) {
        // $nFrom = "tuan truong quang";    //mail duoc gui tu dau, thuong de ten cong ty ban
        // $mFrom = 'truongquangtuan3110@zoho.com';  //dia chi email cua ban 
        // $mPass = '31101983';       //mat khau email cua ban
        // $nTo = 'hung'; //Ten nguoi nhan
        // $mTo = $_POST['email'];   //dia chi nhan mail
        // $mail             = new PHPMailer();
        // $body             = 'Bạn đã đăng ký liên hệ thành công.';   // Noi dung email
        // $title = 'Nguyên Anh Tax kính gửi.';   //Tieu de gui mail
        // $mail->IsSMTP();             
        // $mail->CharSet  = "utf-8";
        // $mail->SMTPDebug  = 0;   // enables SMTP debug information (for testing)
        // $mail->SMTPAuth   = true;    // enable SMTP authentication
        // $mail->SMTPSecure = "ssl";   // sets the prefix to the servier
        // $mail->Host       = "smtp.zoho.com";    // sever gui mail.
        // $mail->Port       = 465;         // cong gui mail de nguyen
        // // xong phan cau hinh bat dau phan gui mail
        // $mail->Username   = $mFrom;  // khai bao dia chi email
        // $mail->Password   = $mPass;              // khai bao mat khau
        // $mail->SetFrom($mFrom, $nFrom);
        // $mail->AddReplyTo('truongquangtuan3110@zoho.com', 'tuan'); //khi nguoi dung phan hoi se duoc gui den email nay
        // $mail->Subject    = $title;// tieu de email 
        // $mail->MsgHTML($body);// noi dung chinh cua mail se nam o day.
        // $mail->AddAddress($mTo, $nTo);
        // // thuc thi lenh gui mail 
        // $mail->Send();
        //
        $name = ($_POST['name']==NULL)?'':$_POST['name'];
        $email = ($_POST['email']==NULL)?'':$_POST['email'];
        $phone = ($_POST['phone']==NULL)?'':$_POST['phone'];
        $address = ($_POST['address']==NULL)?'':$_POST['address'];
        $comment = ($_POST['comment']==NULL)?'':$_POST['comment'];
        $sql = "INSERT INTO lien_he (name, email, phone, address, comment) VALUES ('$name', '$email', '$phone', '$address', '$comment')";
        $result = mysqli_query($conn_vn, $sql);
        echo '<script type="text/javascript">alert(\'Đăng ký thành công.\');</script>';
    }
?>
    <?php include_once "templates/breadcrumbs/breadcrumbs_tpl_mainBreadcrumbs.php";  ?>
    <link rel="stylesheet" type="text/css" href="/css/templates/contact_tpl_pageContact.css">
    <div id="Content-pageContact">
        <div class="Center-Width">  
            <div class="Infor-Width">   
                <div class="container">
                    <p class="titlePageContact">LIÊN HỆ VỚI CHÚNG TÔI</p>
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <h4 class="titleContact1">Thông Tin Liên Hệ</h4>
                            <h2 class="desContactPage">Mọi ý kiến đóng góp, thắc mắc xin quý khách vui lòng liên hệ theo thông tin dưới đây đễ nhận được sự hỗ trợ nhanh và chính xác nhất.<br><br>Chúng tôi luôn coi trọng đánh giá từ phía các bạn, đây là cơ sở để chúng tôi cải thiện và hoàn thiện hệ thống dịch vụ của mình.</h2>
                            <div class="rowPageContact"><i class="iconfont-address1"></i><h3>Address Here.</h3></div>
                            <div class="rowPageContact"><i class="iconfont-phone1"></i><h3>Hotline: <strong>0123.456.789</strong></h3></div>
                            <div class="rowPageContact"><i class="iconfont-mail1"></i><h3>mail@domain.com</h3></div>
                            <div class="rowPageContact"><i class="iconfont-date1"></i><h3><strong style="color:#2e3192;">Thứ 2 - Thứ 7: </strong>7h30 - 17h30<br><strong style="color:#2e3192;">Chủ Nhật:</strong> 8h00 - 16h00</h3></div>
                            <ul class="listMXH_Contact">
                                <li><a href="https://www.facebook.com/myvienngochien" title="MXH"><i class="iconfont-fb1"></i></a></li>
                                <li><a href="#" title="MXH"><i class="iconfont-yt1"></i></a></li>
                                <li><a href="#" title="MXH"><i class="iconfont-gg1"></i></a></li>
                                <li><a href="#" title="MXH"><i class="iconfont-tw1"></i></a></li>
                            </ul>          
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <h4 class="titleContact1">Ý Kiến Phản Hồi</h4>
                            <form class="formPageContact" action="" method="post">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="name" id="name" placeholder="Tên:">
                                </div>
                                <div class="form-group">
                                    <input type="number" class="form-control" name="phone" id="phone" placeholder="Điện Thoại:">
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control" name="email" id="email" placeholder="Email:">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="address" id="address" placeholder="Địa Chỉ:">
                                </div>
                                <div class="form-group">
                                    <textarea class="form-control" rows="5" name="comment" id="comment" placeholder="Ý Kiến Của Bạn:"></textarea>
                                </div>
                                <button type="submit" name="gui_lienhe" class="btn btn-default btnPageContact">Submit</button>
                            </form>      
                        </div>
                    </div>
                    <div class="row" style="margin-top: 20px;">
                        <div class="col-md-12">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3723.9204519790683!2d105.79556791577282!3d21.035868685994448!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ab4763d7ce6f%3A0xf611a57dbc68b809!2zMzEgTmd1eeG7hW4gVsSDbiBIdXnDqm4sIFF1YW4gSG9hLCBD4bqndSBHaeG6pXksIEjDoCBO4buZaSwgVmlldG5hbQ!5e0!3m2!1sen!2s!4v1508186429247" width="100%" height="350" frameborder="0" style="border:0" allowfullscreen></iframe>
                        </div>
                    </div>    
                </div>
            </div><!--end Infor-Width-->  
        </div><!--end Center-Width">-->
    </div><!--end Header-pageContact-->
