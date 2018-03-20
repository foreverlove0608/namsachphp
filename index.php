<?php
    session_start();
    ob_start();

    @define ( '_myTheme' , './themes/namsach/');
    @define ( '_template' , './templates/');
    @define ( '_lang' , './languages/');

    include_once('__autoload.php');
    include_once('lib/database.php');
    include_once('lib/Pagination.php');
    // include_once('lib/class.phpmailer.php');
    // include_once('lib/class.smtp.php');
    include_once('lib/vi_en.php');
    // include_once('lib/gump.class.php');
    include_once('lib/config.php');
    include_once('lib/NL_Checkoutv3.php');

    $trang = isset($_GET['trang']) ? $_GET['trang'] : '1';
    $action = new action();
    $cart = new action_cart();
    $menu = new action_menu();
    $rowConfig = $action->getDetail('config','config_id',1);
    // $_SESSION['productcat_id_relate'] = '';
    // $_SESSION['productcat_url_relate'] = '';
    // $_SESSION['sidebar'] = '';


    /*----------------
     * ĐA NGÔN NGỮ
     *---------------*/
    // $lang = isset($_GET['lang']) ? $_GET['lang'] : 'vn';
    $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";  
    // if(isSet($_GET['lang'])){
    //     $lang = $_GET['lang'];
    //     $id_lang = $_GET['lang'];
    //     // register the session and set the cookie
    //     $_SESSION['lang'] = $lang;        
    //     //setcookie('lang', $lang, time() + (3600 * 24 * 30));
    // }
    // $_SESSION['lang'] = 'vn';
    // unset($_SESSION['lang']);
    // else if(isSet($_SESSION['lang']))

    if(isSet($_SESSION['lang']))
    {
        $lang = $_SESSION['lang'];
        $id_lang = $_SESSION['lang'];
    }
    else if(isSet($_COOKIE['lang']))
    {
        $lang = $_COOKIE['lang'];
        $id_lang = $_COOKIE['lang'];
    }
    else{
        $lang = 'vn';
        $id_lang = 'vn';
    }
    switch ($lang) {
        case 'en':
            $lang_file = 'lang_en.php';
            break;
        case 'vn':
            $lang_file = 'lang_vn.php';
            break;    
        default:
        $lang_file = 'lang_vn.php';
    }
    include_once _lang.$lang_file;
    include_once _lang."lang_words.php";


   /*-----------------------------
    * Phân tích url thân thiện 
    *---------------------------*/
    if (isset($_GET['page'])) {                
        $urlAnalytic = $action->getTypePage_byUrl($_GET['page'],$lang);                       
        $_SESSION['urlAnalytic']  = $urlAnalytic;        
        $_SESSION['slug'] = $_GET['slug'];        
    } 
    else{
        $_SESSION['urlAnalytic']  = '';        
        $_SESSION['slug'] = '';
    }

    /*---------------------------------
     * Thông tin cấu hình website
     *--------------------------------*/
    $config_id = 1;
    // $rowConfigLang = $action->getDetail_New('config_languages', array('config_id', 'languages_code'), array(&$config_id, &$lang), 'is');    
    include_once('functions/meta_des.php');  
?>
    
    <!-- SHOW DATA HEADER -->
    <?php include_once _myTheme."header.php"; ?>
    
    
    <!--NOI DUNG CHINH CUA PAGE-->
        <?php         
            if (isset($_GET['page'])){
              // if ($_GET['page'] == 'san-pham') {
              //   $urlAnalytic = 'san-pham';
              // } elseif ($_GET['page'] == 'tin-tuc') {
              //   $urlAnalytic = 'tin-tuc';
              // } else {
                $urlAnalytic = $action->getTypePage_byUrl($_GET['page'],$lang);
              // }
                
                //echo $urlAnalytic." urlAnalytic"; 
                // echo $_GET['page']."page";
                //echo $_GET['slug'];

                switch ($urlAnalytic) {
                /*----------------------------------------
                 * KHI $urlAnalytic LIÊN QUAN TỚI SẢN PHẨM
                 *----------------------------------------*/                    
                    case 'san-pham-all':
                    /*-----------------------------------------------------------
                     * Tùy theo yêu cầu website có thể rơi vào những lựa chọn sau: 
                     *   - Hiển thị tất cả sản phẩm của website
                     *   - Hiển thị các danh mục sản phẩm
                     *-----------------------------------------------------------*/                    
                        # Option 1: Hiển thị các danh mục sản phẩm              
                            // include_once _myTheme."productCat-cat.php"; break; 
                        # Option 2: Hiển thị tất các sản phẩm của web                                                
                            include_once _myTheme."product-cat-all.php"; break;  

                    case 'productcat_languages': 
                    /*-----------------------------------------------------------
                    * Tùy theo yêu cầu website có thể rơi vào những lựa chọn sau: 
                    *   - Hiển thị tất cả sản phẩm thuộc danh mục được chọn
                    *   - Hiển thị các danh mục sản phẩm con
                    *-----------------------------------------------------------*/      
                        # Option 1: Hiển thị các danh mục sản phẩm con             
                            // $action_product1 = new action_product();  
                            // $hasProductCatSub= $action_product1->getListProductCatSub($_GET['slug'],$lang);  
                            // if ($hasProductCatSub == 1)                                       
                            //     include_once _myTheme."productCat-cat.php";
                            // else                                      
                            //     include_once _myTheme."product-cat.php";
                            // break; 
                        # Option 2: Hiển thị tất các sản phẩm thuộc danh mục                                               
                            include_once _myTheme."product-cat.php"; break;                      
   
                    case 'product_languages':
                    /*----------------------------------------
                    * Hiển thị chi tiết từng sản phẩm
                    *----------------------------------------*/ 
                        # Option 1: Hiển thị chi tiết sản phẩm                             
                            include_once _myTheme."product-detail-hascart.php"; break;

                    case 'product_producer_languages':
                    /*-----------------------------------------------------------
                    * Tùy theo yêu cầu website có thể rơi vào những lựa chọn sau: 
                    *   - Hiển thị các danh mục sản phẩm con cùng nhà sản xuất
                    *   - Hiển thị các sản phẩm cùng nhà sản xuất                
                    *-----------------------------------------------------------*/                          
                        # Option 1: Hiển thị các danh mục sản phẩm con cùng nhà sản xuất
                            // $action_producer = new action_product();  
                            // $hasProducerSub= $action_producer->getListProducerSub($_GET['slug'],$lang);  
                            // if ($hasProducerSub == 1)                                        
                            //     include_once _myTheme."productCat-cat-producer.php";
                            // else
                            //     include_once _myTheme."product-cat-producer.php";
                            // break;
                        # Option 2: Hiển thị các sản phẩm cùng nhà sản xuất
                            include_once _myTheme."product-cat-producer.php"; break;

                     /*----------------------------------------
                    * KHI $urlAnalytic LIÊN QUAN TỚI SEARCH
                    *----------------------------------------*/  
                    case 'search-product':

                            include_once _myTheme."search-product.php"; break;

                /*----------------------------------------
                * KHI $urlAnalytic LIÊN QUAN TỚI TIN TỨC
                *----------------------------------------*/  
                    case 'tin-tuc-all':
                    /*-----------------------------------------------------------
                    * Tùy theo yêu cầu website có thể rơi vào những lựa chọn sau: 
                    *   - Hiển thị tất cả tin tức của website
                    *   - Hiển thị các danh mục tin tức
                    *-----------------------------------------------------------*/      
                        # Option 1: Hiển thị các danh mục tin tức                   
                            // include_once _myTheme."newsCat-cat.php"; break;  
                        # Option 2: Hiển thị tất các tin tức của web                                                
                            include_once _myTheme."news-cat-all.php"; break;  

                    case 'newscat_languages':       
                    /*-----------------------------------------------------------
                    * Tùy theo yêu cầu website có thể rơi vào những lựa chọn sau: 
                    *   - Hiển thị các danh mục tin tức con
                    *   - Hiển thị tất cả các tin trong cùng danh mục                
                    *-----------------------------------------------------------*/  
                        # Option 1: Hiển thị các danh mục tin tức   
                            // $action_news1 = new action_news();  
                            // $hasNewsCatSub= $action_news1->getListNewsCatSub($_GET['slug'],$lang);
                            // if ($hasNewsCatSub == 1)                            
                            //     include_once _myTheme."newsCat-cat.php";
                            // else{
                            //     if ($_GET['page'] == 'khuyen-mai') include_once _myTheme."newsCat-sale.php";                                    
                            //     else include_once _myTheme."newsCat-type1.php"; 
                            // }       
                            // break; 
                        # Option 2: Hiển thị tất cả bài tin tức cùng danh mục
                            include_once _myTheme."news-cat.php"; break;

                    case 'news_languages':
                    /*----------------------------------------
                    * Hiển thị chi tiết từng tin tức
                    *----------------------------------------*/ 
                        # Option 1: Hiển thị chi tiết từng tin tức                             
                            include_once _myTheme."news-detail.php"; break;


                /*----------------------------------------
                * KHI $urlAnalytic LIÊN QUAN TỚI DỊCH VỤ
                *----------------------------------------*/   
                    case 'dich-vu':
                    /*-----------------------------------------------------------
                    * Tùy theo yêu cầu website có thể rơi vào những lựa chọn sau: 
                    *   - Hiển thị tất cả dịch vụ của website
                    *   - Hiển thị các danh mục dịch vụ
                    *-----------------------------------------------------------*/      
                        # Option 1: Hiển thị các danh mục dịch vụ                   
                            include_once _myTheme."serviceCat-cat.php"; break;  
                        # Option 2: Hiển thị tất các dịch vụ của web                                                
                            include_once _myTheme."service-cat.php"; break;      

                    case 'servicecat_languages':       
                    /*-----------------------------------------------------------
                    * Tùy theo yêu cầu website có thể rơi vào những lựa chọn sau: 
                    *   - Hiển thị các danh mục dịch vụ con
                    *   - Hiển thị tất cả các dịch vụ trong cùng danh mục                
                    *-----------------------------------------------------------*/  
                        # Option 1: Hiển thị các danh mục dịch vụ   
                            // $action_service1 = new action_service();  
                            // $hasServiceCatSub= $action_service1->getListServiceCatSub($_GET['slug'],$lang);
                            // if ($hasServiceCatSub == 1)                            
                            //     include_once _myTheme."serviceCat-cat.php";
                            // else{
                            //     if ($_GET['page'] == 'khuyen-mai') include_once _myTheme."serviceCat-sale.php";                                    
                            //     else include_once _myTheme."serviceCat-type1.php"; 
                            // }       
                            // break; 
                        # Option 2: Hiển thị tất cả bài dịch vụ cùng danh mục
                            include_once _myTheme."service-cat.php"; break;

                    case 'service_languages':
                    /*----------------------------------------
                    * Hiển thị chi tiết từng dịch vụ
                    *----------------------------------------*/ 
                        # Option 1: Hiển thị chi tiết từng dịch vụ                             
                            include_once _myTheme."service-detail.php"; break;

                /*----------------------------------------
                * KHI $urlAnalytic LIÊN QUAN TỚI PAGES
                *----------------------------------------*/
                    case 'page_language':    
                    /*----------------------------------------
                    * Hiển thị chi tiết trang page
                    *----------------------------------------*/
                        # Option 1: Hiển thị chi tiết trang page                        
                            include_once _myTheme."page.php"; break;

                /*----------------------------------------
                * KHI $urlAnalytic LIÊN QUAN TỚI GIỎ HÀNG
                *----------------------------------------*/
                    case 'cart-detail':  
                        include_once _myTheme."cart-detail1.php"; break;

                    case 'cart-payment':   
                        include_once _myTheme."cart-payment.php"; break;

                    case 'payment-success':
                        include_once _myTheme . "payment_success.php"; break;
                
                /*----------------------------------------
                * KHI $urlAnalytic LIÊN QUAN TỚI LIÊN HỆ
                *----------------------------------------*/                       
                    case 'lien-he-1':  
                        $_GET['breadCrumb'] = "Lien he"; 
                        include_once _myTheme."lien-he.php"; break;

                /*------------------------------------------------------
                * KHI $urlAnalytic LIÊN QUAN TỚI CÁC TRƯỜNG HỢP ĐẶC BIỆT
                *------------------------------------------------------*/    
                    case 'an-tri-gp': // đường dẫn thân thiện của trang đặc biệt  
                        include_once _myTheme."productDetailANTRIGPHOPNHO.php"; break;       
                    case 've-chung-toi': // đường dẫn thân thiện của trang đặc biệt  
                        $_GET['breadCrumb'] = "Ve chung toi";   
                        include_once _myTheme."ve-chung-toi.php"; 
                        
                        break;  
                /*------------------------------------------------------
                * KHI $urlAnalytic LIÊN QUAN TdỚI CÁC CHỌN TEMPLATE
                *------------------------------------------------------*/  
                    // Thêm một trường hợp phần tích đường dẫn nếu page là thành phần của template thì include...
                    // Nếu Phân tích mà là thành phần của template cat thì include
                    // Neu la chon-template:
                    case 'chon-template': 
                        // echo $_GET['template']; echo $_GET['trang']; echo $_GET['page'];
                        // if (isset($_GET['template']))
                        //     include_once _template.$_GET['trang']."/".$_GET['template'].".php"; break;
                        // if (isset($_GET['trang']))
                        //     include_once _template.$_GET['trang']."/"."select".$_GET['trang']."template.php"; break;
                        // if (isset($_GET['page']))
                            include_once _template."selectTemplate.php"; break;
                    case 'login':
                            include_once _myTheme."login.php"; break;

                    case 'logout':
                            include_once _myTheme."logout.php"; break;

                    case 'register':
                            include_once _myTheme."register.php"; break;

                    case 'list-user':
                            include_once _myTheme.'list-user.php';break;

                    case 'demo':
                            include_once _myTheme . 'demo.php';break;
                default:
                    include_once _myTheme."home.php"; break;

                }
            }  
            else include_once _myTheme."home.php";
        ?> 
    
        <!--Hiển thị footer-->
        <?php include_once _myTheme."footer.php"; ?> 