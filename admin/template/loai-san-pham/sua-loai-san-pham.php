<?php 
    if (isset($_POST['send_edit_protag'])) {
        $name = ($_POST['producttag_name']==NULL) ? '' : $_POST['producttag_name'];
        $des = ($_POST['producttag_des']==NULL) ? '' : $_POST['producttag_des'];
        $content = ($_POST['producttag_content']==NULL) ? '' : $_POST['producttag_content'];
        $title_seo = ($_POST['title_seo']==NULL) ? '' : $_POST['title_seo'];
        $des_seo = ($_POST['des_seo']==NULL) ? '' : $_POST['des_seo'];
        $keyword = ($_POST['keyword']==NULL) ? '' : $_POST['keyword'];
        $url = ($_POST['friendly_url']==NULL) ? '' : $_POST['friendly_url'];
        $state = ($_POST['state']==NULL) ? 0 : (int)$_POST['state'];
        $protag_id = (isset($_GET['id'])) ? (int)$_GET['id'] : 0 ;
        $date = date('Y-m-d H:m:s');

        $sql_update_main = "UPDATE producttag SET producttag_name = '$name', producttag_des = '$des', producttag_content = '$content', producttag_update_date = '$date', title_seo = '$title_seo', des_seo = '$des_seo', keyword = '$keyword', friendly_url = '$url', state = $state  Where producttag_id = $protag_id";
        $result_update_main = mysqli_query($conn_vn, $sql_update_main);

        $sql_updtae_vn = "UPDATE producttag_languages SET lang_producttag_name = '$name', lang_producttag_des = '$des', lang_producttag_content = '$content', title_seo = '$title_seo', des_seo = '$des_seo', keyword = '$keyword', friendly_url = '$url', edit_state = $state Where languages_code = 'vn' And producttag_id = $protag_id";
        $result_update_vn = mysqli_query($conn_vn, $sql_updtae_vn);
        echo '<script type="text/javascript">alert(\'Sửa thành công.\')</script>';
    }
?>
<?php 
    if (isset($_POST['send_del_protag'])) {
        $protag_id = (isset($_GET['id'])) ? (int)$_GET['id'] : 0 ;
        $sql_del_main = "DELETE FROM producttag WHERE producttag_id = $protag_id";
        $result_del_main = mysqli_query($conn_vn, $sql_del_main);

        $sql_del_lang = "DELETE FROM producttag_languages WHERE producttag_id = $protag_id";
        $result_del_lang = mysqli_query($conn_vn, $sql_del_lang);
        header('location: index.php?page=loai-san-pham');
    }
?>
<?php 
    if (isset($_POST['send_edit_lang'])) {
        // echo '<pre>';
        // var_dump($_POST);die();
        $producttag_id = $_POST['producttag_id'];
        $lang_vn_name = $_POST['lang']['vn']['lang_producttag_name'];
        $lang_vn_des = $_POST['lang']['vn']['lang_producttag_des'];
        $lang_vn_content = $_POST['lang']['vn']['lang_producttag_content'];
        $sql_lang_vn = "UPDATE producttag_languages SET lang_producttag_name = '$lang_vn_name', lang_producttag_des = '$lang_vn_des', lang_producttag_content = '$lang_vn_content' WHERE languages_code = 'vn' And producttag_id = $producttag_id";
        $result_lang_vn = mysqli_query($conn_vn, $sql_lang_vn);

        $lang_en_name = $_POST['lang']['en']['lang_producttag_name'];
        $lang_en_des = $_POST['lang']['en']['lang_producttag_des'];
        $lang_en_content = $_POST['lang']['en']['lang_producttag_content'];
        $sql_lang_en = "UPDATE producttag_languages SET lang_producttag_name = '$lang_en_name', lang_producttag_des = '$lang_en_des', lang_producttag_content = '$lang_en_content' WHERE languages_code = 'en' And producttag_id = $producttag_id";
        $result_lang_en = mysqli_query($conn_vn, $sql_lang_en);

        echo '<script type="text/javascript">alert(\'Cập nhật ngôn ngữ thành công.\')</script>';
    }
?>
<?php
    $producttag_id = isset($_GET['id']) ? $_GET['id'] : '';//var_dump($producttag_id);die();
    $row = $action->getDetail_New('producttag', array('producttag_id'), array(&$producttag_id), 'i');
    if ($row == '') {
        header('location: index.php?page=loai-san-pham');
    }
    $list = $action->getList('producttag','','','producttag_id','desc','','','');
    $languages = $action->getListLanguages();

    $action_showMain = new action_page('VN');
    $lang_showMain = "vn";
    $row_showMain = $action_showMain->getDetail_New('producttag_languages',array('producttag_id','languages_code'),array(&$row['producttag_id'], &$lang_showMain),'is');

?>
<script>
// $(document).ready(function(){
//     $("#updateLangProductTag").submit(function(e){
//         e.preventDefault();
//         updateForm(this);
//     });
// });

// var updateForm = function(formSelf){
//         $(formSelf).find('button').prop('disabled', true);
//         $(formSelf).find('button').addClass('btn-loadding');
//         for ( instance in CKEDITOR.instances )
//         {
//             CKEDITOR.instances[instance].updateElement();
//         }
//         var form = $(formSelf);
//         var formdata = false;
//         if (window.FormData){
//             formdata = new FormData(form[0]);
//         }
//         $.ajax({
//             url:"ajax.php",
//             type:"post",
//             data: formdata ? formdata : form.serialize(),
//             cache       : false,
//             contentType : false,
//             processData : false,
//             dataType:"json",
//             success:function(json){
//                 if (json['success']) {
//                     $("#success").html(json['success']);
//                     alert(json['success']);
//                     location.reload();
//                 }
//                 if (json['ok']) {
//                     location.reload();  
//                 }
//                 if(json['error']){
//                     alert(json['error']);
//                     $(formSelf).find('button').removeAttr('disabled');
//                     $(formSelf).find('button').removeClass('btn-loadding');
//                 }
//             },
//             error:function(){
//                 alert('error');
//             }
//         });
//     }
</script>
<form action="" id="updateLangProductTag" method="post">
    <input type="hidden" name="action" value="updateLangProductTag">
    <input type="hidden" name="producttag_id" value="<?= $row['producttag_id']?>">
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
                                    $action1 = new action_page('VN');
                                    $rowDetailLang = $action1->getDetail_New('producttag_languages',array('producttag_id','languages_code'),array(&$row['producttag_id'], &$lang['languages_code']),'is');
                                    
                                ?>
                                    <div role="tabpanel" class="tab-pane <?= $key == 0 ? 'active' : ''?>" id="<?= $lang['languages_code']?>">
                                        
                                        <input type="hidden" name="lang[<?= $lang['languages_code']?>][lang_producttag_sub_info1]" value="">
                                        <input type="hidden" name="lang[<?= $lang['languages_code']?>][lang_producttag_sub_info2]" value="">
                                        <input type="hidden" name="lang[<?= $lang['languages_code']?>][lang_producttat_sub_info3]" value="">
                                        <input type="hidden" name="lang[<?= $lang['languages_code']?>][lang_producttag_sub_info4]" value="">
                                        <input type="hidden" name="lang[<?= $lang['languages_code']?>][lang_producttag_sub_info5]" value="">
                                        <p class="titleRightNCP">Tiêu đề</p>
                                        <input type="text" class="txtNCP1" value="<?= $rowDetailLang['lang_producttag_name'];?>" name="lang[<?= $lang['languages_code']?>][lang_producttag_name]"/>
                                        <p class="titleRightNCP">Mô tả ngắn</p> 
                                        <p style="width:100%;margin-top:5px;"><textarea class="longtxtNCP1 ckeditor" id="editor1" name="lang[<?= $lang['languages_code']?>][lang_producttag_des]" ><?= $rowDetailLang['lang_producttag_des'];?></textarea></p>
                                        <p class="titleRightNCP">Chi tiết</p> 
                                        <p style="width:100%;margin-top:5px;"><textarea class="longtxtNCP1 ckeditor" id="editor2" name="lang[<?= $lang['languages_code']?>][lang_producttag_content]" ><?= $rowDetailLang['lang_producttag_content'];?></textarea></p>
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

<form action="" method="post" accept-charset="utf-8" id="updateProductTag">
    <button class="btnAddTop" type="submit" style="position: fixed;top: 0;right: 220px;z-index: 9;<?php echo ($_SESSION['admin_role']==2)?'display: none;':'';?>">Lưu</button>
    <a class="btnAddTop" data-toggle="modal" href='#modal-id' style="position: fixed;top: 0;right: 285px;z-index: 9;<?php echo ($hidden_multi_lang=='hidden')?'display: none;':'';?>">Chỉnh sửa ngôn ngữ</a>
    <input type="hidden" name="producttag_id" value="<?php echo $producttag_id;?>"/>
    <input type="hidden" name="action" value="updateProductTag">
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
                        if ($row['producttag_img'] != '') {
                        ?>
                            <img src="../images/<?= $row['producttag_img']?>" class="img-responsive" alt="Image">
                            <input type="hidden" name="producttag_img" value="<?= $row['producttag_img']?>">
                        <?php
                        }
                    ?>
                </div>
            </div> 
        </div>
        <div class="boxNodeContentPage">
            <p class="titleRightNCP">Tiêu đề</p>
            <input type="text" class="txtNCP1" id="title" onchange="ChangeToSlug()" value="<?= $row_showMain['lang_producttag_name'];?>" name="producttag_name" required />
            <!-- <div class="subColContent">
                <p class="titleRightNCP">Danh mục cha</p>
                <select class="sltBV" name="producttag_parent" size="10">
                    <option value="0" <?= $row['producttag_parent'] == 0 ? 'selected' : ''?>>Cấp cha</option>
                    <?php $action->showCategoriesSelect($list, 'producttag_parent', 0, $row['producttag_parent'], 'producttag_id', 'producttag_name', 0); ?>
                </select>
            </div> -->
            <p class="titleRightNCP">Mô tả</p>
            <p style="width:100%;margin-top:5px;"><textarea class="longtxtNCP1 ckeditor" id="editor1" name="producttag_des" ><?= $row_showMain['lang_producttag_des'];?></textarea></p>
            <!-- <textarea class="longtxtNCP2" name="producttag_des"><?php echo $row_showMain['lang_producttag_des'];?></textarea> -->
            <p class="titleRightNCP">Chi tiết</p>
            <p style="width:100%;margin-top:5px;"><textarea class="longtxtNCP1 ckeditor" id="editor2" name="producttag_content" ><?= $row_showMain['lang_producttag_content'];?></textarea></p> 
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
    </div><!--  end rowNodeContentPage -->
   
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
    
    <button type="submit" name="send_edit_protag" class="btn btnSave" <?php echo ($_SESSION['admin_role']==2)?'style="display: none;"':'';?> >Lưu</button>
    <button type="submit" name="send_del_protag" class="btn btnDelete" id="deleteProductTag" data-id="<?= $producttag_id?>" data-action="deleteProductTag" <?php echo ($_SESSION['admin_role']==2)?'style="display: none;"':'';?> >Xóa</button>
</form>


