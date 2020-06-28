<?php
if($_SESSION['Role'] == '2' || $_SESSION['Role'] == '3') {
    redirect_to('dashboard.php');
}

?>

<?php

global $conn;
extract($_GET);

$InactiveUserId = base64_decode($InactiveUserId);
$InactiveUserStatus = 0;

$sql = "UPDATE `tbl_users` SET `status`=:statuS WHERE `user_id` = '$InactiveUserId'";
$stmt = $conn->prepare($sql);

$stmt->bindValue(':statuS', $InactiveUserStatus);
$ExecuteData = $stmt->execute();

if($ExecuteData) {
    $_SESSION['SuccessMsg'] = "Success, User has been In-Active.";
    redirect_to('dashboard.php?page=manage-users');
}else {
    $_SESSION['ErrorMsg'] = "Something wrong, User has not In-Active.";

}


?>