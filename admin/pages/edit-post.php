<?php
//if($_SESSION['Role'] == '2' || $_SESSION['Role'] == '3') {
//    redirect_to('dashboard.php');
//}

?>

<?php

global $conn;

extract($_GET);
$EditPostId = base64_decode($EditPostId);
// echo $EditPostId;

$sql = "SELECT * FROM `tbl_posts`
            LEFT JOIN `tbl_categories` ON `tbl_posts`.`cat_id` = `tbl_categories`.`id`
            LEFT JOIN `tbl_users` ON `tbl_posts`.`u_id` = `tbl_users`.`user_id`
            WHERE `tbl_posts`.`id` = $EditPostId";
$stmt = $conn->query($sql);

$CheckData = $stmt->rowCount();

if($CheckData > 0) {
    while($DataRow = $stmt->fetch()) {
        $PostId = $DataRow['id'];
        $PostCatId = html_entity_decode($DataRow['cat_id'], ENT_QUOTES);
        $PostTitle = html_entity_decode($DataRow['post_title'], ENT_QUOTES);
        $PostDesc = html_entity_decode($DataRow['post_desc'], ENT_QUOTES);
        $PostImages = $DataRow['post_image'];
        $DateTime = $DataRow['datetime'];
        $CategoryTitle = html_entity_decode($DataRow['title'], ENT_QUOTES);
        $UserAuthor = html_entity_decode($DataRow['full_name'], ENT_QUOTES);


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
                        <li><a href="javascript:avoid(0)">Edit Post</a></li>
                    </ul>
                </div>
            </div>
            <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->

            <div class="row animated fadeInUp" style="margin-top: 70px; ">
                <?php
                    extract($_POST);
                    extract($_FILES);

                    if(isset($UpdatePost)) {

                        updatePost($PostId, $CatTitle, $PostTitle, $PostDesc, $PostImage, $PostImages);

                    }//End First If Condition...

                ?>
                <div class="col-lg-2"></div>
                <div class="col-sm-12 col-lg-7">
                    <h4 class="section-subtitle"><b>Edit Post : </b></h4>
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
                                                <input type="text" class="form-control" id="PostTitle" name="PostTitle" placeholder="Enter Post Title Name" value="<?= $PostTitle; ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="select2-example-basic" class="control-label">Choose Category : </label>
                                                <span>Existing Category : <b><?= $CategoryTitle; ?></b></span>
                                                <br />
                                                <select name="CatTitle" id="select2-example-basic" class="form-control" style="width: 100%">
                                                    <option disabled>Select Category</option>

<?php
global $conn;

$sql = "SELECT `id`, `title` FROM tbl_categories";
$stmt = $conn->query($sql);

$checkData = $stmt->rowCount();
if($checkData > 0) {
    while($DataRows = $stmt->fetch()) {
        $CatId = $DataRows['id'];
        $CatTitle = $DataRows['title'];

        if($PostCatId == $CatId) {
            $Selected = 'selected';
        } else {
            $Selected = '';
        }
?>
                                                    <option <?= $Selected; ?> value="<?= $CatId; ?>"><?= $CatTitle; ?></option>
                                                        
<?php
    }
}
?>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label for="PostImage">Choose Image : </label>
                                                <input type="file" name="PostImage" class="form-control" id="PostImage">
                                                <span><b>Existing Image :</b> <?= "Image Name : " . $PostImages . " & Image : "; ?></span>
                                                <img style="margin-top: 10px;" width="100px" height="70px" src="uploads/post-image/<?= $PostImages; ?>" alt="<?= $PostImages; ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="textareaMaxLength" class="control-label">Post Description : </label>
                                                <textarea class="form-control" name="PostDesc" rows="5" id="textareaMaxLength" placeholder="Enter Post Description" maxlength="9500"><?= $PostDesc; ?></textarea>
                                                <span class="help-block"><i class="fa fa-info-circle mr-xs"></i>Max characters set to <span class="code">9500</span></span>
                                            </div>
<!--                                            <div class="form-group">-->
<!--                                                <label for="UserAuthor">Post Author : </label>-->
<!--                                                <input type="text" class="form-control" id="UserAuthor" placeholder="Enter Post Author Name" value="--><?//= $UserAuthor; ?><!--">-->
<!--                                                <input type="hidden" name="UAuthor" value="--><?//= $_SESSION['UserId']; ?><!--">-->
<!--                                            </div>-->
                                        
                                            <div class="form-group">
                                                <input type="hidden" name="PostId" value="<?= $EditPostId; ?>">
                                                <button type="submit" name="UpdatePost" class="btn btn-primary">Update Post</button>
                                            </div>
                                        </form>

<?php
    }
} else {
    $_SESSION['ErrorMsg'] = "No data Found!";
}
?>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
        </div>



