<?php
if($_SESSION['Role'] == '2' || $_SESSION['Role'] == '3') {
    redirect_to('dashboard.php');
}

?>

<?php
include_once("inc/head.php");

global $conn;

extract($_GET);

$DeleteCatId = base64_decode($DeleteCatId);

if($DeleteCatId) {

    $sql = "DELETE FROM `tbl_categories` WHERE `id` = '$DeleteCatId'";

    if($conn->query($sql)) {
        $_SESSION['SuccessMsg'] = "Success, Category has been deleted";
        // echo "<script>alert('Are you sure want to delete this Category!')</script>";
        redirect_to('dashboard.php?page=manage-category');

    }

}



?>