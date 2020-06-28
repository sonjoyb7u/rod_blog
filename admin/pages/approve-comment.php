<?php
if($_SESSION['Role'] == '2' || $_SESSION['Role'] == '3') {
    redirect_to('dashboard.php');
}

?>

<?php include_once("inc/head.php"); ?>

<?php

extract($_GET);

$ApproveCommentId = base64_decode($ApproveCommentId);

if(isset($ApproveCommentId)) {
    global $conn;

    $UserName = $_SESSION['FullName'];

    date_default_timezone_set("Asia/Dhaka");
    $DateTime =  date("Y-M-d h:i:sA");

    $sql = "UPDATE `tbl_comments` SET `approved_by` = '$UserName', `status` = 1,`datetime` = '$DateTime' WHERE `id` = '$ApproveCommentId'";
    $ExecuteData = $conn->query($sql);

    if($ExecuteData) {
        $_SESSION['SuccessMsg'] = "Comment Approved Successfully Done.";
        redirect_to("dashboard.php?page=manage-comments");

    } else {
        $_SESSION['ErrorMsg'] = "Something wrong, Try Again";
        redirect_to("dashboard.php?page=manage-comments");
    }

}



?>