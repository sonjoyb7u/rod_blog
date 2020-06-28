<?php
if($_SESSION['Role'] == '2' || $_SESSION['Role'] == '3') {
    redirect_to('dashboard.php');
}

?>

<?php

global $conn;

extract($_GET);
$EditCatId = base64_decode($EditCatId);


$sql = "SELECT * FROM `tbl_categories` WHERE `id` = '$EditCatId'";
$stmt = $conn->query($sql);

while($DataRow = $stmt->fetch()) {
    $CatId = html_entity_decode($DataRow['id'], ENT_QUOTES);
    $CatTitle = html_entity_decode($DataRow['title'], ENT_QUOTES);
    $AuthorName = html_entity_decode($DataRow['author'], ENT_QUOTES);
    $DateTime = html_entity_decode($DataRow['datetime'], ENT_QUOTES);

}

extract($_POST);

if(isset($UpdateCat)) {
    $Id = $Id;
    $CatTitle = htmlentities(userInput($CatTitle), ENT_QUOTES);
    $AuthorName = htmlentities(userInput($CatAuthor), ENT_QUOTES);

    date_default_timezone_set("Asia/Dhaka");
    $DateTime =  date("Y-M-d h:i:sA");

    if(empty($CatTitle)) {
        $_SESSION['ErrorMsg'] = "Category Title name - can't be empty!";

    } elseif(!preg_match("/^[A-Za-z& ]+$/", $CatTitle)) {
        $_SESSION['ErrorMsg'] = "Category Title used - only Letter, AND-symbol, White-spaces are allowed!";

    } elseif(strlen($CatTitle) > 21) {
        $_SESSION['ErrorMsg'] = "Category Title - Should be less than 20 characters!";

     } elseif(empty($AuthorName)) {
        $_SESSION['ErrorMsg'] = "Author name - can't be empty!";

    } else {
        // Query to Update Category Data into Database...
        $sql = "UPDATE `tbl_categories` SET `title`='$CatTitle',`author`='$AuthorName',`datetime`='$DateTime' WHERE `id` = $Id";

        $ExecuteData = $conn->query($sql);

        if($ExecuteData) {
            $_SESSION['SuccessMsg'] = "Success, Category Data updated";
            redirect_to('dashboard.php?page=manage-category');

        } else {
            $_SESSION['ErrorMsg'] = "Something wrong, Category Data not updated!";
            redirect_to('dashboard.php?page=manage-category');
        }
        

    }

}//End First If Condition...   

?>

    <!-- CONTENT -->
    <!-- ========================================================= -->
    <div class="content">
        <!-- content HEADER -->
        <!-- ========================================================= -->
        <div class="content-header">
            <!-- leftside content header -->
            <div class="leftside-content-header">
                <ul class="breadcrumbs">
                    <li><i class="fa fa-home" aria-hidden="true"></i><a href="../index.php">Dashboard</a></li>
                    <li><a href="javascript:avoid(0)">Edit Category</a></li>
                </ul>
            </div>
        </div>
        <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->

        <div class="row animated fadeInUp">
            <div class="col-lg-2"></div>
            <div class="col-sm-12 col-lg-7">
                <h4 class="section-subtitle"><b>Edit Category : </b></h4>
                <div class="row">
                    <div class="panel">
                        <div class="panel-content">
                            <div class="row">
                                <div class="col-md-12">

<?php
echo errorMessage();
echo successMessage();
?>

                                    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
                                        <h5 class="mb-md ">To enjoy more!</h5>
                                        <div class="form-group">
                                            <label for="CatTitle">Category Title : </label>
                                            <input type="text" class="form-control" id="CatTitle" name="CatTitle" placeholder="Enter Post Title Name" value="<?= $CatTitle; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="PostAuthor">Category Author Name : </label>
                                            <input type="text" class="form-control" id="CatAuthor" name="CatAuthor" placeholder="Enter Post Author Name" value="<?= $AuthorName; ?>">
                                        </div>

                                        <div class="form-group">
                                            <input type="hidden" name="Id" value="<?= $EditCatId; ?>">
                                            <button type="submit" name="UpdateCat" class="btn btn-primary">Update Post</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
    </div>
