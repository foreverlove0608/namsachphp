<?php
include_once('lib/library.php');
include_once('lib/Pagination.php');
class action_config extends library{

/*---- lấy thông tin cấu hình của website ----*/
public function getConfig_byId(){
    global $conn_vn;

    $sql = "SELECT * from $this->nameTable_config where $this->nameColId_config ='1'";
    
    $result = mysqli_query($conn_vn,$sql);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        return $row;
    }

}

/*---- lấy thông tin cấu hình của website đa ngôn ngữ ----*/
public function getConfigLanguageDetail_byId($lang){

    global $conn_vn;
    $sql = "SELECT * from $this->nameTable_configLanguage where config_id ='1' and ($this->nameColType_configLanguage = '".$lang."')";
    $result = mysqli_query($conn_vn,$sql);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        return $row;
    }
}

}   
?>