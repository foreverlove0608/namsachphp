
<!--START SECTION CONTACT -->
<section class="home-contact title-line">
    <div id="container">
        <h2 class="widgettitle">
            <span>LIÊN HỆ</span>
        </h2>
        <div class="textwidget clearfix">
            <h3><?php echo $rowConfig['web_email']?></h3>
            <div class="item-contact">
                <a href="#" class="bl1">
                    <span class="icon ion-ios-telephone">
                        <i class="fas fa-phone"></i>
                    </span>
                    <span class="title-contact">ĐIỆN THOẠI - FAX</span>
                    <span class="text"><?php echo $rowConfig['content_home3']?><br> <?php echo $rowConfig['content_home6']?></span>
                </a>
            </div>
            <div class="item-contact">
                <a href="#" class="bl1">
                    <span class="icon ion-ios-location">
                        <i class="fas fa-map-marker-alt"></i>
                    </span>
                    <span class="title-contact">ĐỊA CHỈ</span>
                    <span class="text"><?php echo $rowConfig['content_home1']?></span>
                </a>
            </div>
            <div class="item-contact">
                <div class="bl1">
                    <span class="icon ion-ios-email">
                        <i class="fas fa-envelope"></i>
                    </span>
                    <span class="title-contact">EMAIL - SOCIAL</span>
                    <a href="mailto:example@gmail.com" class="text"><?php echo $rowConfig['content_home2']?></a>
                    <a href="<?php echo $rowConfig['facebook']?>" class="text">Facebook</a>
                </div>
                <div id="fa-like">
                    <div class="fb-like fb_iframe_widget" data-href="https://facebook.com/toiyeunamviet" data-layout="button_count" data-action="like" data-show-faces="true" data-share="true" fb-xfbml-state="rendered" fb-iframe-plugin-query="action=like&amp;app_id=974780655907018&amp;container_width=260&amp;href=https%3A%2F%2Ffacebook.com%2Ftoiyeunamviet&amp;layout=button_count&amp;locale=vi_VN&amp;sdk=joey&amp;share=true&amp;show_faces=true"><span style="vertical-align: bottom; width: 122px; height: 20px;"><iframe name="f7247f9d8ce184" width="1000px" height="1000px" frameborder="0" allowtransparency="true" allowfullscreen="true" scrolling="no" title="fb:like Facebook Social Plugin" src="https://www.facebook.com/v2.3/plugins/like.php?action=like&amp;app_id=974780655907018&amp;channel=http%3A%2F%2Fstaticxx.facebook.com%2Fconnect%2Fxd_arbiter%2Fr%2FMs1VZf1Vg1J.js%3Fversion%3D42%23cb%3Dfc0e47c83f3fac%26domain%3Dtoiyeunamviet.vn%26origin%3Dhttp%253A%252F%252Ftoiyeunamviet.vn%252Ff1c15ee88894de8%26relation%3Dparent.parent&amp;container_width=260&amp;href=https%3A%2F%2Ffacebook.com%2Ftoiyeunamviet&amp;layout=button_count&amp;locale=vi_VN&amp;sdk=joey&amp;share=true&amp;show_faces=true" style="border: none; visibility: visible; width: 122px; height: 20px;" class=""></iframe></span></div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END SECTION CONTACT -->

<!-- START SECTION SUPPER MARKET -->
<section class="supper-market title-line">
    <div id="container">
        <h2 class="widgettitle">
            <span>Hệ thống siêu thị cung cấp các sản phẩm của công ty</span>
        </h2>
        <div class="owl-carousel owl-theme owl-loaded">
            <div class="owl-stage-outer">
                <div class="owl-stage">
                    <div class="owl-item item-product">
                        <img src="image/logo/citimart.png" alt="">
                    </div>
                    <div class="owl-item item-product">
                        <img src="image/logo/fivi.png" alt="">
                    </div>
                    <div class="owl-item item-product">
                        <img src="image/logo/logo_aeon.png" alt="">
                    </div>
                    <div class="owl-item item-product">
                        <img src="image/logo/logo_auchan.jpg" alt="">
                    </div>
                    <div class="owl-item item-product">
                        <img src="image/logo/logo_bhome.png" alt="">
                    </div>
                    <div class="owl-item item-product">
                        <img src="image/logo/logo_bigc.png" alt="">
                    </div>
                    <div class="owl-item item-product">
                        <img src="image/logo/logo_coopmart.png" alt="">
                    </div>
                    <div class="owl-item item-product">
                        <img src="image/logo/logo_happro.png" alt="">
                    </div>
                    <div class="owl-item item-product">
                        <img src="image/logo/logo_intimex.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END SECTION SUPPER MARKET -->
<footer>
    <div id="container">
        <div class="menu-main-menu-footer-container">
            <ul id="menu-main-menu-footer" class="menu clearfix">
                <?php
                    $menu_bot = new action_menu();
                    $rows = $menu_bot->getListMenu_bot(188);
                    foreach ($rows as $item) {
                        $url1 = $menu_bot->setUrlFriendly_byType($item['menu_id'], $lang);
                ?>
                    <li id="menu-item-38" class="">
                        <a href="<?= $url1 ?>"><?php echo $item['menu_name'];?></a>
                    </li>
                <?php        
                    }
                ?>
                <!-- <li id="menu-item-39" class="">
                    <a href="about-us.html">Về chúng tôi</a>
                </li>
                <li id="menu-item-41" class="">
                    <a href="categories.html">Sản phẩm</a>
                </li>
                <li id="menu-item-318" class="">
                    <a href="menu.html">Thực đơn</a>
                </li> -->
            </ul>
        </div>
    </div>		
</footer>
        <!-- Footer Section End --> 
<!-- Footer Section End --> 

<script src="js/jquery-min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.mixitup.js"></script>
<script src="js/nivo-lightbox.js"></script>
<script src="js/owl.carousel.min.js"></script>    
<script src="js/jquery.stellar.min.js"></script>    
<script src="js/jquery.nav.js"></script>    
<script src="js/jquery.easing.min.js"></script>      
<script src="js/jquery.slicknav.js"></script>     
<script src="js/wow.js"></script>  
<script src="js/slider.js"></script>   
<script src="js/jquery.vide.js"></script>
<script src="js/jquery.counterup.min.js"></script>    
<script src="js/jquery.magnific-popup.min.js"></script>    
<script src="js/waypoints.min.js"></script>    
<script src="js/form-validator.min.js"></script>
<script src="js/contact-form-script.js"></script>   
<script src="js/main.js"></script>
<script src="js/jquery.flexslider.js"></script>
</body>
</html>