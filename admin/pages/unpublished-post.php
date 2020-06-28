<?php
if($_SESSION['Role'] == '2' || $_SESSION['Role'] == '3') {
    redirect_to('dashboard.php');
}

?>

<?php
global $conn;
extract($_GET);
$UnpublishedPostId = base64_decode($UnpublishedPostId);
$UnpublishedPostStatus = 0;

$sql = "UPDATE `tbl_posts` SET `status`=:statuS WHERE `id` = '$UnpublishedPostId'";
$stmt = $conn->prepare($sql);

$stmt->bindValue(':statuS', $UnpublishedPostStatus);
$ExecuteData = $stmt->execute();

if($ExecuteData) {
    $_SESSION['SuccessMsg'] = "Success, Post has been Unpublished.";
    redirect_to('dashboard.php?page=manage-post');
}else {
    $_SESSION['ErrorMsg'] = "Something wrong, Post has not Unpublished.";

}

?>