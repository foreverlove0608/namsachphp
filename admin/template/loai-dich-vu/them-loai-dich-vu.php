<?php 
    // $list = $action->getList('servicetag','','','servicetag_id','desc','','','');
?>
<?php 
    if (isset($_POST['send_new_sertag'])) {
        $name = ($_POST['servicetag_name']==NULL) ? '' : $_POST['servicetag_name'];
        $des = ($_POST['servicetag_des']==NULL) ? '' : $_POST['servicetag_des'];
        $title_seo = ($_POST['title_seo']==NULL) ? '' : $_POST['title_seo'];
        $des_seo = ($_POST['des_seo']==NULL) ? '' : $_POST['des_seo'];
        $keyword = ($_POST['keyword']==NULL) ? '' : $_POST['keyword'];
        $url = ($_POST['friendly_url']==NULL) ? '' : $_POST['friendly_url'];
        $state = ($_POST['state']==NULL) ? 0 : (int)$_POST['state'];
        $date = date('Y-m-d H:m:s');
        $created_id = (int)$_SESSION['admin_id'];

        $sql_ins_sertag = "INSERT INTO servicetag (servicetag_name, servicetag_des, servicetag_created_date, servicetag_update_date, title_seo, des_seo, keyword, friendly_url, state, created_id) VALUES ('$name', '$des', '$date', '$date', '$title_seo', '$des_seo', '$keyword', '$url', $state, $created_id)";
        $result_ins_sertag = mysqli_query($conn_vn, $sql_ins_sertag);

        $sql_sl_sertag = "SELECT * FROM servicetag Where created_id = $created_id Order By servicetag_id DESC Limit 1";
        $result_sl_sertag = mysqli_query($conn_vn, $sql_sl_sertag);
        $row = mysqli_fetch_assoc($result_sl_sertag);
        $servicetag_id = $row['servicetag_id'];

        $sql_ins_sertag_vn = "INSERT INTO servicetag_languages (servicetag_id, languages_code, lang_servicetag_name, lang_servicetag_des, title_seo, des_seo, keyword, friendly_url, state) VALUES ('$servicetag_id', 'vn', '$name', '$des', '$title_seo', '$des_seo', '$keyword', '$url', $state)";
        $result_ins_sertag_vn = mysqli_query($conn_vn, $sql_ins_sertag_vn);

        $sql_ins_sertag_en = "INSERT INTO servicetag_languages (servicetag_id, languages_code, lang_servicetag_name, lang_servicetag_des, title_seo, des_seo, keyword, friendly_url, state) VALUES ('$servicetag_id', 'en', '$name', '$des', '$title_seo', '$des_seo', '$keyword', '$url', $state)";
        $result_ins_sertag_en = mysqli_query($conn_vn, $sql_ins_sertag_en);
        echo '<script type="text/javascript">alert(\'Thêm thanh công.\')</script>';
    }
?>

<form action="" method="post" accept-charset="utf-8" id="addServiceTag">

    

    <input type="hidden" name="action" value="addServiceTag">

    <div class="rowNodeContentPage">

        <div class="leftNCP">

            <span class="titLeftNCP">Nội dung trang</span>

            <p class="subLeftNCP">Nhập tiêu đề và nội dung cho trang</p>      

            <p class="titleRightNCP">Chọn ảnh</p>

            <div id="wrapper">

                <input id="fileUpload" type="file" name="fileUpload1"/>

                <br />

                <div id="image-holder">

                    

                </div>

            </div> 

        </div>

        <div class="boxNodeContentPage">

            <p class="titleRightNCP">Tiêu đề</p>

            <input type="text" class="txtNCP1" id="title" onchange="ChangeToSlug()" value="<?= $row['servicetag_name'];?>" name="servicetag_name" required />

            <p class="titleRightNCP">Mô tả</p>

            <p style="width:100%;margin-top:5px;"><textarea class="longtxtNCP1 ckeditor" id="editor1" name="servicetag_des" ><?= $row['servicetag_des'];?></textarea></p>

            <!-- <div class="subColContent">

                <p class="titleRightNCP">Danh mục cha</p>

                <select class="sltBV" name="servicecat_parent" size="10">

                    <option value="0" selected>Cấp cha</option>

                    <?php $action->showCategoriesSelect($list, 'servicecat_parent', 0, '', 'servicecat_id', 'servicecat_name', 0); ?>

                </select>

            </div> -->

        </div>

    </div><!--end rowNodeContentPage-->

    <div class="rowNodeContentPage">

        <div class="leftNCP">

            <span class="titLeftNCP">Tối ưu SEO</span>

            <p class="subLeftNCP">Thiết lập thẻ tiêu đề, thẻ mô tả, đường dẫn. Những thông tin này xác định cách danh mục xuất hiện trên công cụ tìm kiếm.</p>                

        </div>

        <div class="boxNodeContentPage">

            <div>

                <p class="titleRightNCP">Tiêu đề trang</p>

                <p class="subRightNCP"> <strong class="text-character">0</strong>/70 ký tự</p>

                <input type="text" class="txtNCP1" placeholder="Điều khoản dịch vụ" name="title_seo" id="title_seo" value="<?php echo $row['title_seo'];?>" onkeyup="countChar(this)"/>

            </div>

            <div>

                <p class="titleRightNCP">Thẻ mô tả</p>

                <p class="subRightNCP"><strong class="text-character">0</strong>/160 ký tự</p>

                <textarea class="longtxtNCP2" name="des_seo" onkeyup="countChar(this)"><?php echo $row['des_seo'];?></textarea>

            </div>

            <p class="titleRightNCP">Keyword</p>

            <input type="text" class="txtNCP1"  name="keyword" value="<?php echo $row['keyword']?>"/>

            <p class="titleRightNCP">Đường dẫn</p>

            <div class="coverLinkNCP">

                <div id="slug">

                    <input type="text" id="slug1" class="txtLinkNCP" name="friendly_url" value="<?php echo $row['friendly_url']?>"/> 

                </div>    

            </div>

        </div>

    </div><!--end rowNodeContentPage-->

    <div class="rowNodeContentPage">

        <div class="leftNCP">

            <span class="titLeftNCP">Trạng thái</span>

            <p class="subLeftNCP">Thiết lập chế độ hiển thị cho trang nội dung</p>                

        </div>

        <div class="boxNodeContentPage">

            <label class="selectTag">

                <input type="checkbox" value="1" name="state" checked>

                Hoạt động

            </label>

        </div>

    </div><!--end rowNodeContentPage-->

    <button type="submit" name="send_new_sertag" class="btn btnSave">Lưu</button>



</form>