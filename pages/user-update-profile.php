

<?php
global $conn;

$UserId = $_SESSION['UserId'];

$sql = "SELECT * FROM `tbl_users` WHERE `user_id` = '$UserId'";
$stmt = $conn->query($sql);

while($DataRow = $stmt->fetch()) {
    $UserId = $DataRow['user_id'];
    $UserFullName = html_entity_decode($DataRow['full_name'], ENT_QUOTES);
    $UserName = html_entity_decode($DataRow['user_name'], ENT_QUOTES);
    $UserEmail = html_entity_decode($DataRow['user_email'], ENT_QUOTES);
    $UserQualification = html_entity_decode($DataRow['user_qualification'], ENT_QUOTES);
    $UserBio = html_entity_decode($DataRow['user_bio'], ENT_QUOTES);
    $UserImage = html_entity_decode($DataRow['user_image'], ENT_QUOTES);
    $UserPassword1 = html_entity_decode($DataRow['user_password'], ENT_QUOTES);
    $UserConfirmPassword = html_entity_decode($DataRow['user_confirm_password'], ENT_QUOTES);
    $UserMobile = html_entity_decode($DataRow['user_mobile'], ENT_QUOTES);
    $UserAddress = html_entity_decode($DataRow['user_address'], ENT_QUOTES);
    $DateTime = html_entity_decode($DataRow['datetime'], ENT_QUOTES);

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
                <li><i class="fa fa-home" aria-hidden="true"></i><a href="user-dashboard.php">Dashboard</a></li>
                <li><a href="javascript:avoid(0)">User Profile</a></li>
            </ul>
        </div>
    </div>
    <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->

    <div class="row animated fadeInUp" style="margin-top: 100px;">
        <div class="col-sm-6 col-md-6 col-lg-6 col-md-offset-3 col-lg-offset-3">
            <h4 class="section-subtitle"><b>Update Your Info : </b></h4>
            <div class="row">
                <div class="panel">
                    <div class="panel-content">
                        <div class="row">
                            <div class="col-md-12">

                                <?php
                                extract($_POST);

                                if(isset($UpdateUser)) {
                                    $UserId = htmlentities($UserId, ENT_QUOTES);
                                    $FullName = htmlentities($FullName, ENT_QUOTES);
                                    $UserName = htmlentities($username, ENT_QUOTES);
                                    $UserEmail = htmlentities($UserEmail, ENT_QUOTES);
                                    $UserQualification = htmlentities($UserQualification, ENT_QUOTES);
                                    $UserBio = htmlentities($UserBio, ENT_QUOTES);
                                    $UserPassword = htmlentities($UserPassword, ENT_QUOTES);
                                    $UserMobile = htmlentities($UserMobile, ENT_QUOTES);

        //    $UserImage = $_FILES['UserImage'];
        //    print_r($UserImage);
                                    $UserImageName = $_FILES['UserImage']['name'];
                                    $NewUserImageName = rand(100, 2000) . '-' . $UserName . '-' . $UserImageName;
                                    $SourceDir = $_FILES['UserImage']['tmp_name'];
                                    $UploadImageDir = "./admin/uploads/admin-image/" . $NewUserImageName;

                                    $UserAddress = htmlentities($UserAddress, ENT_QUOTES);
                                    // echo $UploadImageDir;
                                    // exit();

                                    date_default_timezone_set("Asia/Dhaka");
                                    $DateTime =  date("Y-M-d h:i:sA");


                                    if(empty($FullName) || empty($UserName) || empty($UserEmail) || empty($UserBio) || empty($UserMobile) || empty($UserAddress)) {
                                        $_SESSION['ErrorMsg'] = "All field must be filled out!";

                                    } else {

                                        if(!preg_match("/^[a-zA-Zক-য়অ-ঔৎংঃ ঁ. ]+$/", $FullName)) {
                                            $_SESSION['ErrorMsg'] = "Full Name used - only Eng/Ban-letter, White-spaces, Dotted are allowed!";

                                        } elseif(strlen($FullName) > 25) {
                                            $_SESSION['ErrorMsg'] = "Full Name - Should be less than 25 characters!";

                                        } elseif(!preg_match("/^[a-zA-Zক-য়অ-ঔৎংঃ ঁ০-৯._0-9 ]+$/", $UserName)) {
                                            $_SESSION['ErrorMsg'] = "User Name used - only Eng/Ban-small letter, White-spaces, Dotted, Dashed, Eg/Ban-numbers are allowed!";

                                        } elseif(strlen($UserName) > 15) {
                                            $_SESSION['ErrorMsg'] = "User Name - Should be less than 15 characters!";

                                        } elseif(!preg_match("/^[A-Za-z._0-9]+@[A-Za-z._0-9]+[.]{1}[A-Za-z._0-9]+$/", $UserEmail)) {
                                            $_SESSION['ErrorMsg'] = "Please Enter valid Email Address!";

                                        } elseif(!preg_match("/^[A-Za-zক-য়অ-ঔৎংঃ ঁ.\-০-৯0-9\W\(\) ]+$/", $UserQualification)) {
                                            $_SESSION['ErrorMsg'] = "Qualification used - only Eng/Ban-small letter, White-spaces, Dotted, Dashed, Eng/Ban-numbers are allowed!";

                                        } elseif(strlen($UserQualification) > 20) {
                                            $_SESSION['ErrorMsg'] = "Qualification Name - Should be less than 20 characters!";

                                        } elseif(!preg_match("/^[0-9০-৯\-\+]+$/", $UserMobile)) {
                                            $_SESSION['ErrorMsg'] = "Mobile number must be Number, dashed are allowed!";

                                        } elseif(!preg_match("/^[a-zA-Zক-য়অ-ঔৎংঃ ঁ০-৯.,\-0-9\/\W ]+$/", $UserAddress)) {
                                            $_SESSION['ErrorMsg'] = "Address used - only Eng/Ban-small letter, White-spaces, Dotted, Dashed, Comma, Eng/Ban-numbers are allowed!";

                                        } else {

                                            // Query to Insert Admin Data in Database...
                                            //Using Globally Database Connection-variable previous PHP version - 5.6...

                                            if(isset($UserImageName) && !empty($UserImageName)) {

                                                $TargetDir = "./admin/uploads/admin-image/" . $UserImage;
                                                unlink($TargetDir);



                                                $sql = "UPDATE `tbl_users` SET `full_name`=:fullName, `user_name`=:userName, `user_email`=:userEmail, `user_qualification`=:userQualification, `user_bio` =:userBio, `user_mobile`=:userMobile, `user_image`=:userImage, `user_address`=:userAddress, `datetime`=:dateTime WHERE `user_id` = '$UserId'";
                                                $stmt = $conn->prepare($sql);

                                                $stmt->bindValue(':fullName', $FullName);
                                                $stmt->bindValue(':userName', $username);
                                                $stmt->bindValue(':userEmail', $UserEmail);
                                                $stmt->bindValue(':userQualification', $UserQualification);
                                                $stmt->bindValue(':userBio', $UserBio);
                                                $stmt->bindValue(':userMobile', $UserMobile);
                                                $stmt->bindValue(':userImage', $NewUserImageName);
                                                $stmt->bindValue(':userAddress', $UserAddress);
                                                $stmt->bindValue(':dateTime', $DateTime);

                                                move_uploaded_file($SourceDir, $UploadImageDir);
                                                $ExecuteData = $stmt->execute();


                                                if($ExecuteData) {
                                                    $_SESSION['SuccessMsg'] = "Success, User Image Updated.";
                                                    redirect_to("user-dashboard.php?page=user-profile");

                                                } else {
                                                    $_SESSION['ErrorMsg'] = "Something wrong, User Image not Updated!";

                                                }


                                            } elseif(isset($UserPassword) && !empty($UserPassword)) {
                                                $PasswordHash = password_hash($UserPassword, PASSWORD_BCRYPT);
                                                //                                                    $ConfirmPasswordHash = password_hash($ConfirmPassword, PASSWORD_BCRYPT);

                                                $sql = "UPDATE `tbl_users` SET `full_name`=:fullName, `user_name`=:userName, `user_email`=:userEmail, `user_qualification`=:userQualification, `user_bio`=:userBio, `user_password`=:userPassword, `user_mobile`=:userMobile, `user_address`=:userAddress, `datetime`=:dateTime WHERE `user_id` = '$UserId'";

                                                $stmt = $conn->prepare($sql);

                                                $stmt->bindValue(':fullName', $FullName);
                                                $stmt->bindValue(':userName', $username);
                                                $stmt->bindValue(':userEmail', $UserEmail);
                                                $stmt->bindValue(':userQualification', $UserQualification);
                                                $stmt->bindValue(':userBio', $UserBio);
                                                $stmt->bindValue(':userPassword', $UserPassword == '' ? $UserPassword1 : $PasswordHash);
                                                $stmt->bindValue(':userMobile', $UserMobile);
                                                $stmt->bindValue(':userAddress', $UserAddress);
                                                $stmt->bindValue(':dateTime', $DateTime);

                                                $ExecuteData = $stmt->execute();

                                                if($ExecuteData) {
                                                    $_SESSION['SuccessMsg'] = "Success, Your Password has been Updated.";
                                                    redirect_to("user-dashboard.php?page=user-profile");

                                                } else {
                                                    $_SESSION['ErrorMsg'] = "Something wrong, Your Password not Updated!";

                                                }


                                            } else {

                                                $sql = "UPDATE `tbl_users` SET `full_name`=:fullName,`user_name`=:userName, `user_email`=:userEmail,`user_qualification`=:userQualification,`user_bio`=:userBio, `user_mobile`=:userMobile, `user_address`=:userAddress, `datetime`=:dateTime WHERE `user_id` = '$UserId'";

                                                $stmt = $conn->prepare($sql);

                                                $stmt->bindValue(':fullName', $FullName);
                                                $stmt->bindValue(':userName', $username);
                                                $stmt->bindValue(':userEmail', $UserEmail);
                                                $stmt->bindValue(':userQualification', $UserQualification);
                                                $stmt->bindValue(':userBio', $UserBio);
                                                $stmt->bindValue(':userMobile', $UserMobile);
                                                $stmt->bindValue(':userAddress', $UserAddress);
                                                $stmt->bindValue(':dateTime', $DateTime);

                                                $ExecuteData = $stmt->execute();


                                                if($ExecuteData) {
                                                    $_SESSION['SuccessMsg'] = "Success, Your Other Information has been Updated.";
                                                    redirect_to("user-dashboard.php?page=user-profile");

                                                } else {
                                                    $_SESSION['ErrorMsg'] = "Something wrong, Your Other Information not Updated!";

                                                }
                                            }
                                        }
                                    }

                                }


                                ?>


                                <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
                                    <h5 class="mb-md ">To enjoy more!</h5>
                                    <div class="form-group">
                                        <label for="FullName">Full Name : </label>
                                        <input type="text" class="form-control" id="FullName" name="FullName" placeholder="Enter Full Name" value="<?= $UserFullName; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="username">User Name : </label>
                                        <input type="text" class="form-control" id="username" name="username" placeholder="Enter User Name" value="<?= $UserName; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="UserEmail">Email Address : </label>
                                        <input type="text" class="form-control" id="UserEmail" name="UserEmail" placeholder="Enter Email Address" value="<?= $UserEmail; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="UserQualification">User Qualification : </label>
                                        <input type="text" class="form-control" id="UserQualification" name="UserQualification" placeholder="Enter Your Qualification" value="<?= $UserQualification; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="textareaMaxLength" class="control-label">User Biography : </label>
                                        <textarea class="form-control" name="UserBio" rows="5" id="textareaMaxLength" placeholder="Enter Your Bio" maxlength="500"><?= $UserBio; ?></textarea>
                                        <span class="help-block"><i class="fa fa-info-circle mr-xs"></i>Max characters set to <span class="code">500</span></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="UserPassword">Password : </label>
                                        <input type="password" class="form-control" id="UserPassword" name="UserPassword" placeholder="Enter Password" value="">
                                    </div>
                                    <div class="form-group">
                                        <label for="UserMobile">User Mobile : </label>
                                        <input type="text" class="form-control" id="UserMobile" name="UserMobile" placeholder="Enter Your Mobile" value="<?= $UserMobile; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="UserImage">Choose Image : </label>
                                        <span style="color: red;">Max Length : (300x300)px</span>
                                        <input type="file" name="UserImage" class="form-control" id="UserImage">
                                        <span><b>Existing Image :</b> <?= "Image Name : " . $UserImage . " & Image : "; ?></span>
                                        <img style="margin-top: 10px;" width="100px" height="70px" src="./admin/uploads/admin-image/<?= $UserImage; ?>" alt="<?= $UserImage; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="textareaMaxLength" class="control-label">User Address: </label>
                                        <textarea class="form-control" name="UserAddress" rows="5" id="textareaMaxLength" placeholder="Enter Your Address" maxlength="120"><?= isset($UserAddress) ? $UserAddress : ''?></textarea>
                                        <span class="help-block"><i class="fa fa-info-circle mr-xs"></i>Max characters set to <span class="code">120</span></span>
                                    </div>

                                    <div class="form-group">
                                        <input type="hidden" name="UserId" value="<?= $UserId; ?>">
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

</div>