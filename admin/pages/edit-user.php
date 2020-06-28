<?php
if($_SESSION['Role'] == '2' || $_SESSION['Role'] == '3') {
    redirect_to('dashboard.php');
}

?>

<?php
global $conn;

extract($_GET);
$EditUserId = base64_decode($EditUserId);

$sql = "SELECT * FROM `tbl_users` WHERE `user_id` = '$EditUserId'";
$stmt = $conn->query($sql);

while($GetRow = $stmt->fetch()) {
    $UserId = $GetRow['user_id'];
    $FullName = html_entity_decode($GetRow['full_name'], ENT_QUOTES);
    $Username = html_entity_decode($GetRow['user_name'], ENT_QUOTES);
    $UserEmail = html_entity_decode($GetRow['user_email'], ENT_QUOTES);
    $UserQualification = html_entity_decode($GetRow['user_qualification'], ENT_QUOTES);
    $UserBio = html_entity_decode($GetRow['user_bio'], ENT_QUOTES);
    $UserImage = html_entity_decode($GetRow['user_image'], ENT_QUOTES);
    $Password1 = html_entity_decode($GetRow['user_password'], ENT_QUOTES);         $UserMobile = html_entity_decode($GetRow['user_mobile'], ENT_QUOTES);
    $UserAddress = html_entity_decode($GetRow['user_address'], ENT_QUOTES);
    $UserRole = html_entity_decode($GetRow['role'], ENT_QUOTES);
    $DateTime = html_entity_decode($GetRow['datetime'], ENT_QUOTES);

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
                    <li><a href="javascript:avoid(0)">Edit User</a></li>
                </ul>
            </div>
        </div>
        <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->

        <div class="row animated fadeInUp" style="margin-top: 50px;">
            <div class="col-lg-2"></div>
            <div class="col-sm-12 col-lg-7">
                <h4 class="section-subtitle"><b>Edit User : </b></h4>
                <div class="row">
                    <div class="panel">
                        <div class="panel-content">
                            <div class="row">
                                <div class="col-md-12">

                                    <?php
                                        extract($_POST);
    //                                    extract($_FILES);

                                        if(isset($UpdateUser)) {

                                            $UserId = htmlentities($UserId, ENT_QUOTES);
                                            $FullName = htmlentities(userInput($FullName), ENT_QUOTES);
                                            $username = strtolower(htmlentities(userInput($username), ENT_QUOTES));
                                            $UserEmail = strtolower(htmlentities(userInput($UserEmail), ENT_QUOTES));
                                            $UserQualification = htmlentities(userInput($UserQualification), ENT_QUOTES);
                                            $UserBio = htmlentities(userInput($UserBio), ENT_QUOTES);
                                            $Password = htmlentities(userInput($password), ENT_QUOTES);
                                            $UserMobile = htmlentities(userInput($UserMobile), ENT_QUOTES);
                                            $UserAddress = htmlentities(userInput($UserAddress), ENT_QUOTES);
                                            $UserRole = htmlentities(userInput($UserRole), ENT_QUOTES);
                                            date_default_timezone_set("Asia/Dhaka");
                                            $DateTime =  date("Y-M-d h:i:sA");

                                            $UserImageName = $_FILES['UserImage']['name'];
                                            $NewUserImageName = rand(100, 1000) . '-' . $username . '-' . $UserImageName;
                                            $SourceDir = $_FILES['UserImage']['tmp_name'];
                                            $UploadImageDir = "../admin/uploads/admin-image/" . $NewUserImageName;
                                            // echo $UploadImageDir;
                                            // exit();

                                            if(empty($FullName) || empty($username) || empty($UserEmail) || empty($UserQualification) || empty($UserBio) || empty($UserMobile) || empty($UserAddress) || empty($UserRole)) {
                                                $_SESSION['ErrorMsg'] = "All field must be filled out!";

                                            } else {
                                                if(!preg_match("/^[A-Za-z0-9.\- ]+$/", $FullName)) {
                                                    $_SESSION['ErrorMsg'] = "Full name - Only Letter, White-spaces, Dotted are allowed!";

                                                } elseif(strlen($FullName) < 3) {
                                                    $_SESSION['ErrorMsg'] = "Full Name - should be greater than 3 character's!";

                                                } elseif(strlen($FullName) > 20) {
                                                    $_SESSION['ErrorMsg'] = "Full Name - should be less than 20 character's!";

                                                } elseif(!preg_match("/^[A-Za-z0-9._\-]+$/", $username)) {
                                                    $_SESSION['ErrorMsg'] = "User name - Only Small-Letter, Number, Dotted, Dashed are allowed!";
                                                } elseif(strlen($username) < 6) {
                                                    $_SESSION['ErrorMsg'] = "User Name - should be greater than 6 character's!";

                                                } elseif(strlen($username) > 16) {
                                                    $_SESSION['ErrorMsg'] = "User Name - should be less than 16 character's!";

                                                } elseif(!preg_match("/^[A-Za-z._0-9]+@[A-Za-z._0-9]+[.]{1}[A-Za-z._0-9]+$/", $UserEmail)) {
                                                    $_SESSION['ErrorMsg'] = "Please Enter valid Email Address!";

                                                } elseif(!preg_match("/^[A-Za-z0-9.\- ]+$/", $UserQualification)) {
                                                $_SESSION['ErrorMsg'] = "User Qualification - Only Letter, White-spaces, Dotted are allowed!";

                                                } elseif(strlen($UserQualification) > 25) {
                                                    $_SESSION['ErrorMsg'] = "User Qualification - Should be less than 25 characters!";

                                                } elseif(!preg_match("/^[a-zA-Zক-য়অ-ঔৎংঃ ঁ:\-।০-৯,.' ]+$/", $UserBio)) {
                                                    $_SESSION['ErrorMsg'] = "User Biography used - only English & Bangla Letter, Number, White-spaces, Dashed are allowed!";

                                                }  elseif(strlen($UserBio) > 500) {
                                                    $_SESSION['ErrorMsg'] = "Admin Biography - Should be less than 500 characters!";

                                                }
    //                                            elseif(!preg_match("/^[a-zA-Z0-9]+$/", $Password)) {
    //                                                $_SESSION['ErrorMsg'] = "User Password used - only Capital/Small Letter, Number are allowed!";
    //
    //                                            }
                                                elseif(!preg_match("/^[0-9\+\- ]+$/", $UserMobile)) {
                                                    $_SESSION['ErrorMsg'] = "User Mobile Number used - only Number, White-spaces, Dashed, Plus sign are allowed!";

                                                }  elseif(!preg_match("/^[a-zA-Z0-9ক-য়অ-ঔৎংঃ ঁ:\-।০-৯,.\'\W ]+$/", $UserAddress)) {
                                                    $_SESSION['ErrorMsg'] = "User Address used - only English & Bangla Letter, Number, White-spaces, Dashed, Comma, Dotted are allowed!";

                                                } else {

                                                    // Query to Edit User Data in Database...
                                                    //Using Globally Database Connection-variable previous PHP version - 5.6...

                                                    if(isset($UserImageName) && !empty($UserImageName)) {

                                                        $TargetDir = "../admin/uploads/admin-image/" . $UserImage;
                                                        unlink($TargetDir);



                                                        $sql = "UPDATE `tbl_users` SET `full_name`=:fullName, `user_name`=:userName, `user_email`=:userEmail, `user_qualification`=:userQualification, `user_bio`=:userBio, `user_image`=:userImage, `user_mobile`=:userMobile, `user_address`=:userAddress, `role`=:rolE, `datetime`=:dateTime WHERE `user_id` = '$UserId'";
                                                        $stmt = $conn->prepare($sql);

                                                        $stmt->bindValue(':fullName', $FullName);
                                                        $stmt->bindValue(':userName', $username);
                                                        $stmt->bindValue(':userEmail', $UserEmail);
                                                        $stmt->bindValue(':userQualification', $UserQualification);
                                                        $stmt->bindValue(':userBio', $UserBio);
                                                        $stmt->bindValue(':userImage', $NewUserImageName);
                                                        $stmt->bindValue(':userMobile', $UserMobile);
                                                        $stmt->bindValue(':userAddress', $UserAddress);
                                                        $stmt->bindValue(':rolE', $UserRole);
                                                        $stmt->bindValue(':dateTime', $DateTime);

                                                        move_uploaded_file($SourceDir, $UploadImageDir);
                                                        $ExecuteData = $stmt->execute();


                                                        if($ExecuteData) {
                                                            $_SESSION['SuccessMsg'] = "Success, User Image is Updated.";
                                                            redirect_to("dashboard.php?page=manage-users");

                                                        } else {
                                                            $_SESSION['ErrorMsg'] = "Something wrong, User Image's not Updated!";

                                                        }


                                                    } elseif(isset($Password) && !empty($Password)) {
                                                        $PasswordHash = password_hash($Password, PASSWORD_BCRYPT);


                                                        $sql = "UPDATE `tbl_users` SET `full_name`=:fullName, `user_name`=:userName, `user_email`=:userEmail,`user_qualification`=:userQualification, `user_bio`=:userBio, `user_password`=:passworD, `user_mobile`=:userMobile, `user_address`=:userAddress, `role`=:rolE, `datetime`=:dateTime WHERE `user_id` = '$UserId'";

                                                        $stmt = $conn->prepare($sql);

                                                        $stmt->bindValue(':fullName', $FullName);
                                                        $stmt->bindValue(':userName', $username);
                                                        $stmt->bindValue(':userEmail', $UserEmail);
                                                        $stmt->bindValue(':userQualification', $UserQualification);
                                                        $stmt->bindValue(':userBio', $UserBio);
                                                        $stmt->bindValue(':passworD', $Password == '' ? $Password1 : $PasswordHash);
    //                                                            $stmt->bindValue(':confirmPassword', $ConfirmPassword == '' ? $AdminConfirmPassword : $ConfirmPasswordHash);
                                                        $stmt->bindValue(':userMobile', $UserMobile);
                                                        $stmt->bindValue(':userAddress', $UserAddress);
                                                        $stmt->bindValue(':rolE', $UserRole);
                                                        $stmt->bindValue(':dateTime', $DateTime);

                                                        $ExecuteData = $stmt->execute();

                                                        if($ExecuteData) {
                                                            $_SESSION['SuccessMsg'] = "Success, Admin Password Updated.";
                                                            redirect_to("dashboard.php?page=manage-users");

                                                        } else {
                                                            $_SESSION['ErrorMsg'] = "Something wrong, Admin Password not Updated!";

                                                        }


                                                    } else {

                                                        $sql = "UPDATE `tbl_users` SET `full_name`=:fullName, `user_name`=:userName, `user_email`=:userEmail, `user_qualification`=:userQualification, `user_bio`=:userBio, `user_mobile`=:userMobile, `user_address`=:userAddress, `role`=:rolE, `datetime`=:dateTime WHERE `user_id` = '$UserId'";

                                                        $stmt = $conn->prepare($sql);

                                                        $stmt->bindValue(':fullName', $FullName);
                                                        $stmt->bindValue(':userName', $username);
                                                        $stmt->bindValue(':userEmail', $UserEmail);
                                                        $stmt->bindValue(':userQualification', $UserQualification);
                                                        $stmt->bindValue(':userBio', $UserBio);
    //                                                    $stmt1->bindValue(':passworD', $Password == '' ? $AdminPassword : $PasswordHash);
    //                                                    $stmt1->bindValue(':confirmPassword', $ConfirmPassword == '' ? $AdminConfirmPassword : $ConfirmPasswordHash);
                                                        $stmt->bindValue(':userMobile', $UserMobile);
                                                        $stmt->bindValue(':userAddress', $UserAddress);
                                                        $stmt->bindValue(':rolE', $UserRole);
                                                        $stmt->bindValue(':dateTime', $DateTime);

                                                        $ExecuteData = $stmt->execute();


                                                        if($ExecuteData) {
                                                            $_SESSION['SuccessMsg'] = "Success, Admin Other Information Updated.";
                                                            redirect_to("dashboard.php?page=manage-users");

                                                        } else {
                                                            $_SESSION['ErrorMsg'] = "Something wrong, Admin Other Information not Updated!";

                                                        }
                                                    }
                                                }
                                            }

                                        }


                                    ?>

                                    <?php

                                    if(isset($_SESSION['SuccessMsg'])) { ?>
                                        <div><?= successMessage(); ?></div>
                                        <?php
                                    } else { ?>
                                        <div><?= errorMessage(); ?></div>
                                        <?php
                                    }

                                    ?>

                                    <form action="<?php $_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data">
                                        <h5 class="mb-md ">To enjoy more!</h5>
                                        <div class="form-group">
                                            <label for="FullName">User Full Name : </label>
                                            <input type="text" class="form-control" id="FullName" name="FullName" placeholder="Enter Full Name" value="<?= $FullName; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="username">User Name : </label>
                                            <input type="text" class="form-control" id="username" name="username" placeholder="Enter User Name" value="<?= $Username; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="UserEmail">User Email Address : </label>
                                            <input type="text" class="form-control" id="UserEmail" name="UserEmail" placeholder="Enter Email Address" value="<?= $UserEmail; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="UserQualification">User Qualification : </label>
                                            <input type="text" class="form-control" id="UserQualification" name="UserQualification" placeholder="Enter Your Qualification" value="<?= $UserQualification; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="textareaMaxLength" class="control-label">User Biography : </label>
                                            <textarea class="form-control" name="UserBio" rows="5" id="textareaMaxLength" placeholder="Enter Your Bio" maxlength="500"><?= isset($UserBio) ? $UserBio : ''?> </textarea>
                                            <span class="help-block"><i class="fa fa-info-circle mr-xs"></i>Max characters set to <span class="code">500</span></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="password">User Password : </label>
                                            <input type="password" class="form-control" id="password" name="password" placeholder="Enter new Password">
                                        </div>
                                        <div class="form-group">
                                            <label for="UserMobile">User Mobile : </label>
                                            <input type="text" class="form-control" id="UserMobile" name="UserMobile" placeholder="Enter Mobile Number" value="<?= $UserMobile; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="UserImage">Choose Image : </label>
                                            <input type="file" name="UserImage" class="form-control" id="UserImage">
                                            <span><b>Existing Image :</b> <?= "Image Name : " . $UserImage . " & Image : "; ?></span>
                                            <img style="margin-top: 10px;" width="100px" height="70px" src="../admin/uploads/admin-image/<?= $UserImage; ?>" alt="<?= $UserImage; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="UserAddress">User Address : </label>
                                            <input type="text" class="form-control" id="UserAddress" name="UserAddress" placeholder="Enter Address" value="<?= $UserAddress; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="UserAddress">User Role : </label>
                                            <select class="form-control" name="UserRole" id="UserRole" value="<?= $UserRole; ?>">
                                                <?php
                                                    if($UserRole == 1) { ?>
                                                        <option value="1" selected>Super Admin</option>
                                                        <option value="2">Admin</option>
                                                        <option value="3">Normal User</option>
                                                <?php
                                                    } elseif($UserRole == 2) { ?>
                                                        <option value="1">Super Admin</option>
                                                        <option value="2" selected>Admin</option>
                                                        <option value="3">Normal User</option>
                                                <?php
                                                    } elseif($UserRole == 3) { ?>
                                                        <option value="1">Super Admin</option>
                                                        <option value="2">Admin</option>
                                                        <option value="3" selected>Normal User</option>
                                                <?php
                                                    }
                                                ?>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <input type="hidden" name="UserId" value="<?= $EditUserId; ?>">
                                            <button type="submit" name="UpdateUser" class="btn btn-primary">Update User</button>
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
