
<?php

global $conn;

extract($_GET);
$EditUserPostId = base64_decode($EditUserPostId);
//echo $EditUserPostId;
//exit();
$sql = "SELECT * FROM `tbl_posts`
            LEFT JOIN `tbl_categories` ON `tbl_posts`.`cat_id` = `tbl_categories`.`id`
            LEFT JOIN `tbl_users` ON `tbl_posts`.`u_id` = `tbl_users`.`user_id`
            WHERE `tbl_posts`.`id` = $EditUserPostId";
$stmt = $conn->query($sql);

$CheckData = $stmt->rowCount();

if($CheckData > 0) {
    while ($DataRow = $stmt->fetch()) {
        $PostId = $DataRow['id'];
        $PostCatId = html_entity_decode($DataRow['cat_id'], ENT_QUOTES);
        $PostTitle = html_entity_decode($DataRow['post_title'], ENT_QUOTES);
        $PostDesc = html_entity_decode($DataRow['post_desc'], ENT_QUOTES);
        $PostImages = $DataRow['post_image'];
        $DateTime = $DataRow['datetime'];
        $CategoryTitle = html_entity_decode($DataRow['title'], ENT_QUOTES);
        $UserAuthor = html_entity_decode($DataRow['full_name'], ENT_QUOTES);


extract($_POST);
//extract($_FILES);

if(isset($UpdatePost)) {
    $UserPostId = htmlentities(userInput($UserPostId), ENT_QUOTES);
    $CatTitle = htmlentities(userInput($CatTitle), ENT_QUOTES);
    $PostTitle = htmlentities(userInput($PostTitle), ENT_QUOTES);
    $PostDesc = htmlentities(userInput($PostDesc), ENT_QUOTES);
    $AuthorName = htmlentities($AuthorName,ENT_QUOTES);

    $PostImageName = $_FILES['PostImage']['name'];
    $PostImageSize = $_FILES['PostImage']['size'];
    $SourceDir = $_FILES['PostImage']['tmp_name'];
    $PostImageType = $_FILES['PostImage']['type'];

    date_default_timezone_set("Asia/Dhaka");
    $DateTime =  date("Y-M-d h:i:sA");

    if(empty($CatTitle) || empty($PostTitle) || empty($PostDesc)) {
        $_SESSION['ErrorMsg'] = "All field must be field out!";

    } elseif(!preg_match("/^[a-zA-Z0-9-,. ]+$/", $PostTitle)) {
        $_SESSION['ErrorMsg'] = "Post Title name used - only Letter, Number, White-spaces, Dashed are allowed!";

    } elseif(strlen($PostTitle) < 6) {
        $_SESSION['ErrorMsg'] = "Post Title name - Should be greater than 6 characters!";

    } elseif(!preg_match("/^[a-zA-Zক-য়অ-ঔৎংঃ ঁ:\-।০-৯0-9,.\'\W ]+$/", $PostDesc)) {
        $_SESSION['ErrorMsg'] = "Post Description used - only English & Bangla Letter, Number, White-spaces, Dashed are allowed!";

    } elseif(strlen($PostDesc) > 10000) {
        $_SESSION['ErrorMsg'] = "Post Description - Should be less than 9500 characters!";

    } else {
        // Query to Insert Post Data in Database...
        global $conn;

        if(isset($PostImageName) && !empty($PostImageName)) {

            $PostImageExt = explode('.', $PostImageName);
            $PostImageExt = end($PostImageExt);
            $ImageExt = ['jpeg', 'jpg', 'png'];
            $NewPostImageName = rand(100, 1000) . '-' . $CatTitle . '-' . $PostImageName;
            $UploadImageDir = "./admin/uploads/post-image/" . $NewPostImageName;

            if (in_array($PostImageExt, $ImageExt) === false) {
                $_SESSION['ErrorMsg'] = "This Extension file not allowed, please choose a JPG, PNG file!";

            } elseif ($PostImageSize > 2097152) {
                $_SESSION['ErrorMsg'] = "Image file size must be less than 2 MB!";

            } else {
                $TargetDir = "./admin/uploads/post-image/" . $PostImages;
                unlink($TargetDir);

                $sql = "UPDATE `tbl_posts` SET `cat_id`=$CatTitle, `post_title`='$PostTitle',`post_desc`='$PostDesc',`post_image`='$NewPostImageName',`datetime`='$DateTime' WHERE `id` = $UserPostId";

                move_uploaded_file($SourceDir, $UploadImageDir);

                $ExecuteData = $conn->query($sql);

                if($ExecuteData) {
                    $_SESSION['SuccessMsg'] = "Success, Post Data updated";
                    redirect_to('user-dashboard.php?page=user-manage-post');

                } else {
                    $_SESSION['ErrorMsg'] = "Something wrong, Post Data not updated!";

                }

            }


        } else {

            // Query to Update Post Data into Database...
            $sql = "UPDATE `tbl_posts` SET `cat_id`=$CatTitle, `post_title`='$PostTitle', `post_desc`='$PostDesc', `post_image`='$PostImages', `datetime`='$DateTime' WHERE `id` = $UserPostId";

            $ExecuteData = $conn->query($sql);

            if($ExecuteData) {
                $_SESSION['SuccessMsg'] = "Success, Post Data updated";
                redirect_to('user-dashboard.php?page=user-manage-post');

            } else {
                $_SESSION['ErrorMsg'] = "Something wrong, Post Data not updated!";
                redirect_to('user-dashboard.php?page=user-manage-post');
            }

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
                <li><a href="javascript:avoid(0)">User Profile</a></li>
            </ul>
        </div>
    </div>
    <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->


    <div class="row animated fadeInUp" style="">
        <div class="col-sm-12 col-md-8 col-lg-8 col-md-offset-2 col-lg-offset-2">
            <h4 class="section-subtitle"><b>Your Profile : </b></h4>
            <div class="row">
                <div class="panel">
                    <div class="panel-content">
                        <div class="row">
                            <div class="col-md-12">

                                <?php
                                if(isset($_SESSION['UserId'])) { ?>
                                    <div style=""><?= successMessage(); ?></div>
                                    <?php
                                } else { ?>
                                    <div style=""><?= errorMessage(); ?></div>
                                    <?php
                                }

                                ?>

                                <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
                                    <h5 class="mb-md ">To enjoy more!</h5>
                                    <div class="form-group">
                                        <label for="PostTitle">Post Title : </label>
                                        <input type="text" class="form-control" id="PostTitle" name="PostTitle" placeholder="Enter Post Title Name" value="<?= $PostTitle; ?>">
                                    </div>
                                    <div class="form-group">
                                        <span>Existing Category : <b><?= $CategoryTitle; ?></b></span>
                                        <br>
                                        <label for="select2-example-basic" class="control-label">Choose Category : </label>
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
                                        <img style="margin-top: 10px;" width="100px" height="70px" src="admin/uploads/post-image/<?= $PostImages; ?>" alt="<?= $PostImages; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="textareaMaxLength" class="control-label">Post Description : </label>
                                        <textarea class="form-control" name="PostDesc" rows="5" id="textareaMaxLength" placeholder="Enter Post Description" maxlength="9500" value=""><?= $PostDesc; ?></textarea>
                                        <span class="help-block"><i class="fa fa-info-circle mr-xs"></i>Max characters set to <span class="code">9500</span></span>
                                    </div>
<!--                                    <div class="form-group">-->
<!--                                        <label for="PostAuthor">Post Author : </label>-->
<!--                                        <input disabled type="text" class="form-control" id="PostAuthor" name="PostAuthor" placeholder="Enter Post Author Name" value="--><?//= $AuthorName; ?><!--">-->
<!--                                    </div>-->

                                    <div class="form-group">
                                        <input type="hidden" name="UserPostId" value="<?= $EditUserPostId; ?>">
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



