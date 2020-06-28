<?php
//if($_SESSION['Role'] == '2' || $_SESSION['Role'] == '3') {
//    redirect_to('dashboard.php');
//}

?>

<?php
include_once("inc/head.php");

extract($_GET);

$DeletePostId = base64_decode($DeletePostId);
$PostImage = $ImageName;
$CategoryId = base64_decode($CatId);

// echo $PostImage;

if($DeletePostId) {

    $TargetDir = "./uploads/post-image/" . $PostImage;
    unlink($TargetDir);

    $sql = "DELETE FROM `tbl_posts` WHERE `id` = :DeletePostId;";
    $sql .= "UPDATE `tbl_categories` SET `total_posts` = `total_posts` - 1 WHERE `id` = :CategoryId";

    $stmt = $conn->prepare($sql);

    $stmt->bindValue(':DeletePostId', $DeletePostId);
    $stmt->bindValue(':CategoryId', $CategoryId);

    $stmt->execute();

    $DeleteData = $stmt->rowCount();

    if($DeleteData > 0) {
        $_SESSION['SuccessMsg'] = "Success, Post has been deleted";
        // echo "<script>alert('Are you sure want to delete this post!');</script>";
        redirect_to('dashboard.php?page=manage-post');

    } else {
        $_SESSION['ErrorMsg'] = "Something wrong, Post Data not Deleted!";

    }

}



?>