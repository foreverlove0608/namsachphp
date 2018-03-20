<?php 
    if (isset($_POST['send_edit_sertag'])) {
        $servicetag_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
        $name = ($_POST['servicetag_name']==NULL) ? '' : $_POST['servicetag_name'];
        $des = ($_POST['servicetag_des']==NULL) ? '' : $_POST['servicetag_des'];
        $title_seo = ($_POST['title_seo']==NULL) ? '' : $_POST['title_seo'];
        $des_seo = ($_POST['des_seo']==NULL) ? '' : $_POST['des_seo'];
        $keyword = ($_POST['keyword']==NULL) ? '' : $_POST['keyword'];
        $url = ($_POST['friendly_url']==NULL) ? '' : $_POST['friendly_url'];
        $state = ($_POST['state']==NULL) ? 0 : (int)$_POST['state'];
        $date = date('Y-m-d H:m:s');

        $sql_main = "UPDATE servicetag SET servicetag_name = '$name', servicetag_des = '$des', servicetag_update_date = '$date', title_seo = '$title_seo', des_seo = '$des_seo', keyword = '$keyword', friendly_url = '$url', state = $state Where servicetag_id = $servicetag_id";
        $result_main = mysqli_query($conn_vn, $sql_main);

        $sql_vn = "UPDATE servicetag_languages SET lang_servicetag_name = '$name', lang_servicetag_des = '$des', title_seo = '$title_seo', des_seo = '$des_seo', keyword = '$keyword', friendly_url = '$url', state = $state Where servicetag_id = $servicetag_id And languages_code = 'vn'";
        $result_vn = mysqli_query($conn_vn, $sql_vn);
        echo '<script type="text/javascript">alert(\'Sửa thành công.\')</script>';
    }
?>
<?php 
    if (isset($_POST['send_del_sertag'])) {
        $servicetag_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
        $sql_del_main = "DELETE FROM servicetag Where servicetag_id = $servicetag_id";
        $result_del_main = mysqli_query($conn_vn, $sql_del_main);

        $sql_del_lang = "DELETE FROM servicetag_languages Where servicetag_id = $servicetag_id";
        $result_del_lang = mysqli_query($conn_vn, $sql_del_lang);
        header('location: index.php?page=loai-dich-vu');
    }
?>
<?php
    if (isset($_POST['send_edit_lang'])) {
        // echo '<pre>';var_dump($_POST);die();
        $servicetag_id = $_POST['servicetag_id'];
        $lang_vn_name = $_POST['lang']['vn']['lang_servicetag_name'];
        $lang_vn_des = $_POST['lang']['vn']['lang_servicetag_des'];
        $sql_lang_vn = "UPDATE servicetag_languages SET lang_servicetag_name = '$lang_vn_name', lang_servicetag_des = '$lang_vn_des' WHERE languages_code = 'vn' And servicetag_id = $servicetag_id";
        $result_lang_vn = mysqli_query($conn_vn, $sql_lang_vn);

        $lang_en_name = $_POST['lang']['en']['lang_servicetag_name'];
        $lang_en_des = $_POST['lang']['en']['lang_servicetag_des'];
        $sql_lang_en = "UPDATE servicetag_languages SET lang_servicetag_name = '$lang_en_name', lang_servicetag_des = '$lang_en_des' WHERE languages_code = 'en' And servicetag_id = $servicetag_id";
        $result_lang_en = mysqli_query($conn_vn, $sql_lang_en);

        echo '<script type="text/javascript">alert(\'Cập nhật ngôn ngữ thành công.\')</script>';
    }
?>
<?php

    $servicetag_id = isset($_GET['id']) ? $_GET['id'] : '';

    $row = $action->getDetail_New('servicetag', array('servicetag_id'), array(&$servicetag_id), 'i');

    if ($row == '') {

        header('location: index.php?page=loai-dich-vu');

    }

    $list = $action->getList('servicecat','','','servicecat_id','desc','','','');
    $list_tag = $action->getList('servicetag','','','servicetag_id','desc','','','');

    $languages = $action->getListLanguages();



    $action_showMain = new action_page('VN');

    $lang_showMain = "vn";

    $row_showMain = $action_showMain->getDetail_New('servicetag_languages',array('servicetag_id','languages_code'),array(&$row['servicetag_id'], &$lang_showMain),'is');

?>



<form action="" id="updateLangServiceTag" method="post">

    <input type="hidden" name="action" value="updateLangServiceTag">

    <input type="hidden" name="servicetag_id" value="<?= $row['servicetag_id']?>">

    <div class="modal fade" id="modal-id">

        <div class="modal-dialog">

            <div class="modal-content">

                <div class="modal-header">

                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                    <h4 class="modal-title">Chỉnh sửa ngôn ngữ</h4>

                </div>

                <div class="modal-body">

                    <div role="tabpanel">

                        <!-- Nav tabs -->

                        <ul class="nav nav-tabs" role="tablist">

                            <?php 

                                foreach ($languages as $key => $lang) {

                                ?>

                                    <li role="presentation" class="<?= $key == 0 ? 'active' : ''?>">

                                        <a href="#<?= $lang['languages_code']?>" aria-controls="home" role="tab" data-toggle="tab"><?= $lang['languages_name']?></a>

                                    </li>

                                <?php

                                }

                            ?>

                        </ul>

                    

                        <!-- Tab panes -->

                        <div class="tab-content">

                            <?php 

                                foreach ($languages as $key => $lang) {

                                    $action1 = new action_page();

                                    $rowDetailLang = $action1->getDetail_New('servicetag_languages',array('servicetag_id','languages_code'),array(&$row['servicetag_id'], &$lang['languages_code']),'is');

                                    

                                ?>

                                    <div role="tabpanel" class="tab-pane <?= $key == 0 ? 'active' : ''?>" id="<?= $lang['languages_code']?>">

                                        <input type="hidden" name="lang[<?= $lang['languages_code']?>][lang_servicetag_content]" value="1">

                                        <input type="hidden" name="lang[<?= $lang['languages_code']?>][lang_servicetag_sub_info1]" value="">

                                        <input type="hidden" name="lang[<?= $lang['languages_code']?>][lang_servicetag_sub_info2]" value="">

                                        <input type="hidden" name="lang[<?= $lang['languages_code']?>][lang_servicetag_sub_info3]" value="">

                                        <input type="hidden" name="lang[<?= $lang['languages_code']?>][lang_servicetag_sub_info4]" value="">

                                        <input type="hidden" name="lang[<?= $lang['languages_code']?>][lang_servicetag_sub_info5]" value="">

                                        <p class="titleRightNCP">Tiêu đề</p>

                                        <input type="text" class="txtNCP1" value="<?= $rowDetailLang['lang_servicetag_name'];?>" name="lang[<?= $lang['languages_code']?>][lang_servicetag_name]"/>

                                        <p class="titleRightNCP">Mô tả ngắn</p> 

                                        <p style="width:100%;margin-top:5px;"><textarea class="longtxtNCP1 ckeditor" id="editor1<?= $lang['languages_code']?>" name="lang[<?= $lang['languages_code']?>][lang_servicetag_des]" ><?= $rowDetailLang['lang_servicetag_des'];?></textarea></p>

                                    </div>

                                <?php

                                }

                            ?>

                        </div>

                    </div>

                </div>

                <div class="modal-footer">

                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                    <button type="submit" name="send_edit_lang" class="btn btn-primary">Save changes</button>

                </div>

            </div>

        </div>

    </div>

</form>



<form action="" method="post" accept-charset="utf-8" id="updateServiceTag">

    <button class="btnAddTop" type="submit" style="position: fixed;top: 0;right: 220px;z-index: 9;<?php echo ($_SESSION['admin_role']==2)?'display: none;':'';?>">Lưu</button>

    <a class="btnAddTop" data-toggle="modal" href='#modal-id' style="position: fixed;top: 0;right: 285px;z-index: 9;<?php echo ($hidden_multi_lang=='hidden')?'display: none;':'';?>">Chỉnh sửa ngôn ngữ</a>

    <input type="hidden" name="servicetag_id" value="<?php echo $servicetag_id;?>"/>

    <input type="hidden" name="action" value="updateServiceTag">

    <div class="rowNodeContentPage">

        <div class="leftNCP">

            <span class="titLeftNCP">Nội dung trang</span>

            <p class="subLeftNCP">Nhập tiêu đề và nội dung cho trang</p>      

            <p class="titleRightNCP">Chọn ảnh</p>

            <div id="wrapper">

                <input id="fileUpload" type="file" name="fileUpload1"/>

                <br />

                <div id="image-holder">

                    <?php 

                        if ($row['servicetag_img'] != '') {

                        ?>

                            <img src="../images/<?= $row['servicetag_img']?>" class="img-responsive" alt="Image">

                            <input type="hidden" name="servicetag_img" value="<?= $row['servicetag_img']?>">

                        <?php

                        }

                    ?>

                </div>

            </div> 

        </div>

        <div class="boxNodeContentPage">

            <p class="titleRightNCP">Tiêu đề</p>

            <input type="text" class="txtNCP1" id="title" onchange="ChangeToSlug()" value="<?= $row_showMain['lang_servicetag_name'];?>" name="servicetag_name" required />

            <p class="titleRightNCP">Mô tả</p>

            <p style="width:100%;margin-top:5px;"><textarea class="longtxtNCP1 ckeditor" id="editor1" name="servicetag_des" ><?= $row_showMain['lang_servicetag_des'];?></textarea></p>

            <!-- <div class="subColContent">

                <p class="titleRightNCP">Danh mục cha</p>

                <select class="sltBV" name="servicecat_parent" size="10">

                    <option value="0" <?= $row['servicecat_parent'] == 0 ? 'selected' : ''?>>Cấp cha</option>

                    <?php $action->showCategoriesSelect($list, 'servicecat_parent', 0, $row['servicecat_parent'], 'servicecat_id', 'servicecat_name', 0); ?>

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

                <p class="subRightNCP">Số ký tự đã dùng: <strong class="text-character">0</strong>/70</p>

                <input type="text" class="txtNCP1" value="<?php echo $row_showMain['title_seo'];?>" id="title_seo" name="title_seo" onkeyup="countChar(this)"/>

            </div>

            <p class="titleRightNCP">Thẻ mô tả</p>

            <p class="subRightNCP">Số ký tự đã dùng: <strong class="text-character">0</strong>/160</p>

            <textarea class="longtxtNCP2" name="des_seo"  onkeyup="countChar(this)"><?php echo $row_showMain['des_seo'];?></textarea>

            <p class="titleRightNCP">Keyword</p>

            <input type="text" class="txtNCP1"  name="keyword" value="<?php echo $row_showMain['keyword']?>"/>

            <p class="titleRightNCP">Đường dẫn</p>

            <div class="coverLinkNCP">

                <div  id="slug">

                    <input type="text" id="slug1" class="txtLinkNCP" name="friendly_url" value="<?php echo $row_showMain['friendly_url']?>"/> 

                </div>    

            </div>

        </div>

    </div><!--end rowNodeContentPage-->

   

    <div class="rowNodeContentPage">

        <div class="leftNCP">

            <span class="titLeftNCP">Trạng thái</span>

        </div>

        <div class="boxNodeContentPage">

            <div>

                <label class="selectTag">

                    <input type="checkbox" value="1" name="state" <?= $row['state'] == 1 ? 'checked' : '' ?>>Trạng thái hiển thị

                </label>

            </div>

            

        </div>

    </div><!--end rowNodeContentPage-->

    

    <button type="submit" name="send_edit_sertag" class="btn btnSave" <?php echo ($_SESSION['admin_role']==2)?'style="display: none;"':'';?>>Lưu</button>

    <button type="submit" name="send_del_sertag" class="btn btnDelete" id="deleteServiceTag" data-id="<?= $servicetag_id?>" data-action="deleteServiceTag" <?php echo ($_SESSION['admin_role']==2)?'style="display: none;"':'';?>>Xóa</button>

</form>





