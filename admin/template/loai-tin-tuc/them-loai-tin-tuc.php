<?php 
    // $list = $action->getList('newscat','','','newscat_id','desc','','','');
?>
<?php 
    if (isset($_POST['gui_newstag'])) {
        $image = ($_POST['fileUpload1']==NULL) ? '' : $_POST['fileUpload1'];
        $name = ($_POST['newstag_name']==NULL) ? '' : $_POST['newstag_name'];
        $des = ($_POST['newstag_des']==NULL) ? '' : $_POST['newstag_des'];
        $title_seo = ($_POST['title_seo']==NULL) ? '' : $_POST['title_seo'];
        $des_seo = ($_POST['des_seo']==NULL) ? '' : $_POST['des_seo'];
        $keyword = ($_POST['keyword']==NULL) ? '' : $_POST['keyword'];
        $friendly_url = ($_POST['friendly_url']==NULL) ? '' : $_POST['friendly_url'];
        $state = ($_POST['state']==NULL) ? 0 : (int)$_POST['state'];
        $admin_id = $_SESSION['admin_id'];
        $date = date('Y-m-d H:m:s');

        $sql_ins_newstag = "INSERT INTO newstag (newstag_name, newstag_des, newstag_img, newstag_created_date, newstag_update_date, title_seo, des_seo, keyword, friendly_url, state, created_id) VALUES ('$name', '$des', '$image', '$date', '$date', '$title_seo', '$des_seo', '$keyword', '$friendly_url', $state, $admin_id)";
        $result_ins_newstag = mysqli_query($conn_vn, $sql_ins_newstag) or die('error: ' . mysqli_error($conn_vn));

        $sql_sel_newstag = "SELECT * From newstag Where created_id = $admin_id Order By newstag_id DESC Limit 1";
        $result_sel_newstag = mysqli_query($conn_vn, $sql_sel_newstag);
        $row_sel_newstag = mysqli_fetch_assoc($result_sel_newstag);
        $newstag_id = $row_sel_newstag['newstag_id'];

        $sql_ins_newstag_vn = "INSERT INTO newstag_languages (newstag_id, languages_code, lang_newstag_name, lang_newstag_des, title_seo, des_seo, keyword, friendly_url, edit_state) VALUES ($newstag_id, 'vn', '$name', '$des', '$title_seo', '$des_seo', '$keyword', '$friendly_url', $state)";
        $result_ins_newstag_vn = mysqli_query($conn_vn, $sql_ins_newstag_vn);

        $sql_ins_newstag_en = "INSERT INTO newstag_languages (newstag_id, languages_code, lang_newstag_name, lang_newstag_des, title_seo, des_seo, keyword, friendly_url, edit_state) VALUES ($newstag_id, 'en', '$name', '$des', '$title_seo', '$des_seo', '$keyword', '$friendly_url', $state)";
        $result_ins_newstag_en = mysqli_query($conn_vn, $sql_ins_newstag_en) or die('error: ' . mysqli_error($conn_vn));
        echo '<script type="text/javascript">alert(\'Thêm thành công.\')</script>';
    }
    // var_dump($_SESSION);die();
?>
<form action="" method="post" accept-charset="utf-8" id="addNewsTag">
    
    <input type="hidden" name="action" value="addNewsTag">
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
            <input type="text" class="txtNCP1" id="title" onchange="ChangeToSlug()" value="<?= $row['newscat_name'];?>" name="newstag_name" required />
            <p class="titleRightNCP">Mô tả</p>
            <p style="width:100%;margin-top:5px;"><textarea class="longtxtNCP1 ckeditor" id="editor1" name="newstag_des" ><?= $row['newscat_des'];?></textarea></p>
            <!-- <div class="subColContent">
                <p class="titleRightNCP">Danh mục cha</p>
                <select class="sltBV" name="newscat_parent" size="10">
                    <option value="0" selected>Cấp cha</option>
                    <?php $action->showCategoriesSelect($list, 'newscat_parent', 0, '', 'newscat_id', 'newscat_name', 0); ?>
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
            <label class="selectCate">
                <input type="checkbox" value="1" name="state" checked>
                Hoạt động
            </label>
        </div>
    </div><!--end rowNodeContentPage-->
    <button type="submit" name="gui_newstag" class="btn btnSave">Lưu</button>

</form>


