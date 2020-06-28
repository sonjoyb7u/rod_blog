<?php
include_once("inc/head.php");

extract($_GET);

$DeleteAdminId = base64_decode($DeleteAdminId);

if($DeleteAdminId) {

    $sql = "DELETE FROM `tbl_admins` WHERE `id` = '$DeleteAdminId'";

    if($conn->query($sql)) {
        $_SESSION['SuccessMsg'] = "Success, Admin Information has been deleted";
        redirect_to('dashboard.php?page=manage-admin');
    }else {
        $_SESSION['ErrorMsg'] = "Something wrong, Admin Information not Deleted!";

    }

}



?>