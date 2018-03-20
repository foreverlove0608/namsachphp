<?php
  $rowConfig = $action->getDetail('config','config_id',1);
?>
<!--SHOW SLIDER-->
<div id="container-slider" class="cf">
    <div id="main" role="main">
        <section class="slider">
            <div class="flexslider" style="direction:rtl">
                <ul class="slides">
                    <?php
                    $array = json_decode($rowConfig['slideshow_home'], true);
                    foreach ($array as $key => $val) {
                        $img = json_decode($val, true);
                        if ($img != '') {
                            ?> 
                            <li style="position: relative;">
                                <div class="img-slider">
                                    <a href="" target="_blank">
                                        <img  src="images/<?= $img['image'] ?>" />
                                    </a>
                                </div>
                                <div class="content-slider-1">
                                    <h3 class="title-welcom">welcome to nấm lý tưởng</h3>
                                    <p class="welcome">Địa chỉ cung cấp nấm sạch và các thực phẩm từ nấm</p>
                                    <p class="welcome">uy tín nhất tại việt nam</p>
                                </div>
                            </li>
                            <?php
                        }
                    }
                    ?>   
                </ul>
            </div>
        </section>
    </div>
</div>

<?php
    $cat = new action_product();
    $rows = $cat->getListProductCat_byOrderASC(5);
?>
<section class="product-below-slider">
    <div class="home-product-category">
        <ul class="product-categories">
            <?php
            foreach ($rows as $row){
            ?>
                <li class="cat-item cat-item-<?php echo $row['productcat_id'];?>">
                    <a href="<?= $row['friendly_url'] ?>">
                        <?php echo $row['productcat_name'];?>
                    </a>
                </li>
            <?php
            }
            ?>
        </ul>
    </div>
</section>
<!-- START WIDGET -->
<section class="">
    <div class="introduction">
        <div id="container">
            <div class="textwidget clearfix">
                <div class="list-icon-2">
                    <div class="item">
                        <div class="item-icon"><i class="fa fa-truck"></i></div>
                        <p>Miễn phí ship trong nội thành Hà Nội với đơn hàng trên 200k</p>
                    </div>
                </div>
                <div class="list-icon-2">
                    <div class="item">
                        <div class="item-icon"><i class="fa fa-trophy"></i></div>
                        <p>Cam kết chỉ cung cấp các loại nấm rõ nguồn gốc đảm bảo vệ sinh an toàn thực phẩm, được các cơ quan quản lý nhà nước chứng nhận nguồn gốc và chất lượng.</p>
                    </div>
                </div>
                <div class="list-icon-2">
                    <div class="item">
                        <div class="item-icon"><i class="fa fa-cubes"></i></div>
                        <p>Cung cấp đa dạng gần 20 sản phẩm nấm tươi và rất nhiều sản phẩm chế biến từ nấm</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END WIDGET -->