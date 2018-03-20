<?php
    if (isset($_GET['search']) && $_GET['search'] != '') {
        $rows = $action->getSearchAdmin('producttag',array('producttag_name'), $_GET['search'],'','',$_GET['page']);
        // $rows = $rows['data'];
    }else{
       $rows = $action->getList('producttag','','','producttag_id','desc','','','loai-san-pham');
        //$rows = $showCategoriesTable
    }
?>
    <div class="boxPageContent">
        <div class="searchBox">
            <form action="">
                <input type="hidden" name="page" value="loai-san-pham">
                <button type="submit" class="btnSearchBox" >Tìm kiếm</button>
                <input type="text" class="txtSearchBox" name="search" />                                    
            </form>
        </div>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Tiêu đề</th>
                    <th>Người tạo</th>
                    <!-- <th>Ngày cập nhật</th> -->
                    <th>Trạng thái</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($rows as $row) {?>
                    <tr>
                        <td><a href="index.php?page=sua-loai-san-pham&id=<?php echo $row['producttag_id'];?>"><?php echo $row['producttag_name'];?></a></td>
                        <td><?php echo $row['created_id'];?></td>
                        <td><?php echo $row['state'];?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

        <div class="paging"><?= $rows['paging']?></div>
    </div>
    <p class="footerWeb">Cảm ơn quý khách hàng đã tin dùng dịch vụ của chúng tôi<br />Sản phẩm thuộc Công ty TNHH Truyền Thông Và Công Nghệ GoldBridge Việt Nam</p>