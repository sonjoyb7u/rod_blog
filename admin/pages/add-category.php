<?php
if($_SESSION['Role'] == '2' || $_SESSION['Role'] == '3') {
    redirect_to('dashboard.php');
}

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
                    <li><i class="fa fa-home" aria-hidden="true"></i><a href="#">Dashboard</a></li>
                    <li><a href="javascript:avoid(0)">Add Category</a></li>
                </ul>
            </div>
        </div>
        <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->

        <div class="row animated fadeInUp" style="margin-top: 40px;">
            <div class="col-lg-2"></div>
            <div class="col-sm-12 col-lg-7">
                <h4 class="section-subtitle"><b>Add Categories : </b></h4>
                <div class="row">
                    <div class="panel">
                        <div class="panel-content">
                            <div class="row">
                                <div class="col-md-12">

<?php

extract($_POST);

if(isset($AddCat)) {

$CatTitle = htmlentities($CatTitle, ENT_QUOTES);
$AdminName = htmlentities($_SESSION['FullName'], ENT_QUOTES);

date_default_timezone_set("Asia/Dhaka");
$DateTime =  date("Y-M-d h:i:sA");

if(empty($CatTitle)) {
$_SESSION['ErrorMsg'] = "Category Title name field must be filled out!";

} else {
$CatTitle = userInput($CatTitle);

if(!preg_match("/^[A-Za-z\- ]+$/", $CatTitle)) {
    $_SESSION['ErrorMsg'] = "Category title name - Only Letter, White-spaces, Dashed are allowed!";

} elseif(strlen($CatTitle) < 3) {
    $_SESSION['ErrorMsg'] = "Category title name - should be greater than 3 character's!";

} elseif(strlen($CatTitle) > 29) {
    $_SESSION['ErrorMsg'] = "Category Title name - should be less than 30 character's!";

} else {

    // Query to Insert category title Data in Database...

    global $conn; //Using Globaly Database Connection-variable previous PHP version - 5.6...

    $sql = "INSERT INTO tbl_categories(title, author, datetime) VALUES (:catTitle, :adminName, :dateTime)";
    $stmt = $conn->prepare($sql);

    $stmt->bindValue(':catTitle', $CatTitle);
    $stmt->bindValue(':adminName', $AdminName);
    $stmt->bindValue(':dateTime', $DateTime);

    $ExecuteData = $stmt->execute();

    if($ExecuteData) {
        $_SESSION['SuccessMsg'] = "Success, Category Title Name with id - {$conn->lastInsertId()} inserted";
         redirect_to("dashboard.php?page=manage-category");

    } else {
        $_SESSION['ErrorMsg'] = "Something went wrong, Category Title Name not inserted!";

    }
}
}

}


?>

<?php
echo errorMessage();
echo successMessage();
?>
                                    <form action="<?php $_SERVER['PHP_SELF']?>" method="post">
                                        <h5 class="mb-md ">To enjoy more!</h5>
                                        <div class="form-group">
                                            <label for="CatTitle">Category Title : </label>
                                            <input type="text" class="form-control" id="CatTitle" name="CatTitle" placeholder="Enter Category Title Name" value="<?= isset($CatTitle) ? $CatTitle:''?>">
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" name="AddCat" class="btn btn-primary">Add Category</button>
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

