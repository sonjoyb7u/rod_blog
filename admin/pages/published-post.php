<?php
if($_SESSION['Role'] == '2' || $_SESSION['Role'] == '3') {
    redirect_to('dashboard.php');
}

?>

<?php
global $conn;
extract($_GET);
$PublishedPostId = base64_decode($PublishedPostId);
$PublishedPostStatus = 1;

$sql = "UPDATE `tbl_posts` SET `status`=:statuS WHERE `id` = '$PublishedPostId'";
$stmt = $conn->prepare($sql);

$stmt->bindValue(':statuS', $PublishedPostStatus);
$ExecuteData = $stmt->execute();

if($ExecuteData) {
    $_SESSION['SuccessMsg'] = "Success, Post has been Published.";
    redirect_to('dashboard.php?page=manage-post');
}else {
    $_SESSION['ErrorMsg'] = "Something wrong, Post has not Published.";

}

?>