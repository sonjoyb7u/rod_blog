<?php
if($_SESSION['Role'] == '2' || $_SESSION['Role'] == '3') {
    redirect_to('dashboard.php');
}

?>

<?php include_once("inc/head.php"); ?>

<?php

extract($_GET);

$DeleteCommentId = base64_decode($DeleteCommentId);

if(isset($DeleteCommentId)) {
    global $conn;

    $sql = "DELETE FROM `tbl_comments` WHERE `id` = '$DeleteCommentId'";
    $ExecuteData = $conn->query($sql);

    if($ExecuteData) {
        $_SESSION['SuccessMsg'] = "Comment Deleted Successfully";
        redirect_to("manage-comments.php");

    } else {
        $_SESSION['ErrorMsg'] = "Something wrong, Try Again";
        redirect_to("manage-comments.php");
    }

}



?>