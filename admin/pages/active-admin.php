<?php
if($_SESSION['Role'] == '2' || $_SESSION['Role'] == '3') {
    redirect_to('dashboard.php');
}

?>

<?php

global $conn;
extract($_GET);

$ActiveAdminId = base64_decode($ActiveAdminId);
$ActiveAdminStatus = 1;

$sql = "UPDATE `tbl_admins` SET `status`=:statuS WHERE `id` = '$ActiveAdminId'";
$stmt = $conn->prepare($sql);

$stmt->bindValue(':statuS', $ActiveAdminStatus);
$ExecuteData = $stmt->execute();

if($ExecuteData) {
    $_SESSION['SuccessMsg'] = "Success, Admin has been Active.";
    redirect_to('dashboard.php?page=manage-admin');

}else {
    $_SESSION['ErrorMsg'] = "Something wrong, Admin has not Active.";

}


?>