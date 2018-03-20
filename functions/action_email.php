<?php 
// link huong dan: https://www.sitepoint.com/sending-emails-php-phpmailer/
	function email ($email_to, $title = "", $content = "") {
		$nFrom = "tuan truong quang";    //mail duoc gui tu dau, thuong de ten cong ty ban
        $mFrom = 'truongquangtuan3110@zoho.com';  //dia chi email cua ban 
        $mPass = '31101983';       //mat khau email cua ban
        $nTo = 'hung'; //Ten nguoi nhan
        //$mTo = $_POST['email_dichvu'];   //dia chi nhan mail
		$mTo = $email_to;
        $mail             = new PHPMailer();
        //$body             = "<p>Kế toán thuế trọn gói: $ktttg</p><p>Kê khai thuế online: $kktol</p><p>Rà soát sổ sách: $rsss</p><p>Hoàn thiện sổ sách: $htss</p><p>Quyết toán thuế: $qtt</p>";   // Noi dung email
        //$title = 'Nguyên Anh Tax kính gửi';   //Tieu de gui mail
        $mail->IsSMTP();             
        $mail->CharSet  = "utf-8";
        $mail->SMTPDebug  = 0;   // enables SMTP debug information (for testing)
        $mail->SMTPAuth   = true;    // enable SMTP authentication
        $mail->SMTPSecure = "ssl";   // sets the prefix to the servier
        $mail->Host       = "smtp.zoho.com";    // sever gui mail.
        $mail->Port       = 465;         // cong gui mail de nguyen
        // xong phan cau hinh bat dau phan gui mail
        $mail->Username   = $mFrom;  // khai bao dia chi email
        $mail->Password   = $mPass;              // khai bao mat khau
        $mail->SetFrom($mFrom, $nFrom);
        $mail->AddReplyTo('truongquangtuan3110@zoho.com', 'quang'); //khi nguoi dung phan hoi se duoc gui den email nay
        $mail->Subject    = $title;// tieu de email 
        $mail->MsgHTML($content);// noi dung chinh cua mail se nam o day.
        $mail->AddAddress($mTo, $nTo);
	$mail->AddAddress('truongquangtuan3110@zoho.com');
        $mail->Send();
	}
?>