<?php
if($_SESSION['Role'] == '2' || $_SESSION['Role'] == '3') {
    redirect_to('dashboard.php');
}

?>

<?php

global $conn;
extract($_GET);

$InactiveAdminId = base64_decode($InactiveAdminId);
$InactiveAdminStatus = 0;

$sql = "UPDATE `tbl_admins` SET `status`=:statuS WHERE `id` = '$InactiveAdminId'";
$stmt = $conn->prepare($sql);

$stmt->bindValue(':statuS', $InactiveAdminStatus);
$ExecuteData = $stmt->execute();

if($ExecuteData) {
    $_SESSION['SuccessMsg'] = "Success, Admin has been In-Active.";
    redirect_to('dashboard.php?page=manage-admin');

}else {
    $_SESSION['ErrorMsg'] = "Something wrong, Admin has not In-Active.";

}


?>