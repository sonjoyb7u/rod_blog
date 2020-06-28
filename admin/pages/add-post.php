<?php

global $conn;

extract($_POST);
extract($_FILES);

if(isset($AddPost)) {
    $UserId = htmlentities($_SESSION['UserId'], ENT_QUOTES);
    $UserRole = htmlentities($_SESSION['Role'], ENT_QUOTES);

    addPost($UserId, $UserRole, $CatTitle, $PostTitle, $PostDesc, $PostImage);

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
                    <li><a href="javascript:avoid(0)">Add Post</a></li>
                </ul>
            </div>
        </div>
        <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->

        <div class="row animated fadeInUp" style="margin-top: 70px; ">
            <div class="col-lg-2"></div>
            <div class="col-sm-12 col-lg-7">
                <h4 class="section-subtitle"><b>Add Post : </b></h4>
                <div class="row">
                    <div class="panel">
                        <div class="panel-content">
                            <div class="row">
                                <div class="col-md-12">

                                    <?php

                                        if(isset($_SESSION['SuccessMsg'])) { ?>

                                            <div><?= successMessage(); ?></div>

                                    <?php
                                        } else { ?>

                                            <div><?= errorMessage(); ?></div>

                                    <?php
                                        }
                                    ?>
                                    <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
                                        <h5 class="mb-md ">To enjoy more!</h5>
                                        <div class="form-group">
                                            <label for="PostTitle">Post Title : </label>
                                            <input type="text" class="form-control" id="PostTitle" name="PostTitle" placeholder="Enter Post Title Name" value="<?= isset($PostTitle) ? $PostTitle:''?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="select2-example-basic" class="control-label">Choose Category : </label>
                                            <select name="CatTitle" id="select2-example-basic" class="form-control" style="width: 100%">
                                                <option disabled>Select Category</option>

<?php

$sql = "SELECT * FROM `tbl_categories` ORDER BY `id` ASC";
$stmt = $conn->query($sql);

$stmt->execute();

$CheckData = $stmt->rowCount();

if($CheckData > 0) {
    while($DataRows = $stmt->fetch()) {
        $CatId = $DataRows['id'];
        $CatTitle = $DataRows['title'];


?>

                                                <option value="<?= $CatId; ?>"><?= $CatTitle;?></option>


<?php
    }
}
?>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="PostImage">Choose Image : </label>
                                            <input type="file" name="PostImage" class="form-control" id="PostImage">
                                        </div>
                                        <div class="form-group">
                                            <label for="textareaMaxLength" class="control-label">Post Description : </label>
                                            <textarea class="form-control" name="PostDesc" rows="5" id="textareaMaxLength" placeholder="Enter Post Description" maxlength="9500" value=""><?= isset($PostDesc) ? $PostDesc:''?></textarea>
                                            <span class="help-block"><i class="fa fa-info-circle mr-xs"></i>Max characters set to <span class="code">9500</span></span>
                                        </div>

                                        <div class="form-group">
                                            <button type="submit" name="AddPost" class="btn btn-primary">Add Post</button>
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

