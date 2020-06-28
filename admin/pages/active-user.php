<?php
if($_SESSION['Role'] == '2' || $_SESSION['Role'] == '3') {
    redirect_to('dashboard.php');
}

?>

<?php
global $conn;
extract($_GET);
$ActiveUserId = base64_decode($ActiveUserId);
$ActiveUserStatus = 1;

$sql = "UPDATE `tbl_users` SET `status`=:statuS WHERE `user_id` = '$ActiveUserId'";
$stmt = $conn->prepare($sql);

$stmt->bindValue(':statuS', $ActiveUserStatus);
$ExecuteData = $stmt->execute();

if($ExecuteData) {
    $_SESSION['SuccessMsg'] = "Success, User has been Active.";
    redirect_to('dashboard.php?page=manage-users');
}else {
    $_SESSION['ErrorMsg'] = "Something wrong, User has not Active.";

}

?>