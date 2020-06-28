<?php
if($_SESSION['Role'] == '2' || $_SESSION['Role'] == '3') {
    redirect_to('dashboard.php');
}

?>
    <div class="content">
        <!-- content HEADER -->
        <!-- ========================================================= -->
        <div class="content-header">
            <!-- leftside content header -->
            <div class="leftside-content-header">
                <ul class="breadcrumbs">
                    <li><i class="fa fa-home" aria-hidden="true"></i><a href="#">Dashboard</a></li>
                    <li><a href="javascript:avoid(0)">Add User</a></li>
                </ul>
            </div>
        </div>
        <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->

        <div class="row animated fadeInUp" style="margin-top: 70px;">
            <div class="col-lg-2"></div>
            <div class="col-sm-12 col-lg-7">
                <h4 class="section-subtitle"><b>Add New User : </b></h4>
                <div class="row">
                    <div class="panel">
                        <div class="panel-content">
                            <div class="row">
                                <div class="col-md-12">

                                    <?php
                                    //Using Globally Database Connection-variable previous PHP version - 5.6...
                                    global $conn;

                                    extract($_POST);
//                                    extract($_FILES);

                                    if(isset($AddUser)) {
                                        $FName = htmlentities(userInput($FName), ENT_QUOTES);
                                        $UName = strtolower(htmlentities(userInput($UName), ENT_QUOTES));
                                        $UEmail = strtolower(htmlentities(userInput($UEmail), ENT_QUOTES));
                                        $UQualification = htmlentities(userInput($UQualification), ENT_QUOTES);
                                        $UBio = htmlentities(userInput($UBio), ENT_QUOTES);
                                        $Password = htmlentities(userInput($Password), ENT_QUOTES);
                                        $CPassword = htmlentities($CPassword, ENT_QUOTES);
//                                        $UserAddedBy = htmlentities(userInput($UserAddedBy), ENT_QUOTES);
                                        $UMobile = htmlentities(userInput($UMobile), ENT_QUOTES);

                                        $UImageName = $_FILES['UImage']['name'];
                                        $SourceDir = $_FILES['UImage']['tmp_name'];
                                        $UImageSize = $_FILES['UImage']['size'];
                                        $NewUImageName = rand(100, 2000) . '-' . $UImageName . '-' . $UImageName;
                                        $UploadImageDir = "../admin/uploads/admin-image/" . $NewUImageName;

                                        $UAddress = htmlentities(userInput($UAddress), ENT_QUOTES);
                                        $Role = htmlentities(userInput($Role), ENT_QUOTES);

                                        date_default_timezone_set("Asia/Dhaka");
                                        $DateTime =  date("Y-M-d h:i:sA");

                                        if(empty($FName) || empty($UName) || empty($UEmail) || empty($UQualification) || empty($UBio) || empty($Password) || empty($CPassword) || empty($UMobile) || empty($UImageName) || empty($UAddress) || empty($Role)) {
                                            $_SESSION['ErrorMsg'] = "All field must be filled out!";

                                        } elseif(!preg_match("/^[a-zA-Zক-য়অ-ঔৎংঃ ঁ. ]+$/", $FName)) {
                                            $_SESSION['ErrorMsg'] = "Full Name used - only Eng/Ban-letter, White-spaces, Dotted are allowed!";

                                        } elseif(strlen($FName) > 25) {
                                            $_SESSION['ErrorMsg'] = "Full Name - Should be less than 25 characters!";

                                        } elseif(!preg_match("/^[a-zA-Zক-য়অ-ঔৎংঃ ঁ০-৯._0-9 ]+$/", $UName)) {
                                            $_SESSION['ErrorMsg'] = "User Name used - only Eng/Ban-small letter, White-spaces, Dotted, Dashed, Eg/Ban-numbers are allowed!";

                                        } elseif(strlen($UName) > 15) {
                                            $_SESSION['ErrorMsg'] = "User Name - Should be less than 15 characters!";

                                        } elseif(!preg_match("/^[A-Za-z._0-9]+@[A-Za-z._0-9]+[.]{1}[A-Za-z._0-9]+$/", $UEmail)) {
                                            $_SESSION['ErrorMsg'] = "Please Enter valid Email Address!";

                                        } elseif(!preg_match("/^[A-Za-zক-য়অ-ঔৎংঃ ঁ.\-০-৯0-9\W\(\) ]+$/", $UQualification)) {
                                            $_SESSION['ErrorMsg'] = "Qualification used - only Eng/Ban-small letter, White-spaces, Dotted, Dashed, Eng/Ban-numbers are allowed!";

                                        } elseif(strlen($UQualification) > 20) {
                                            $_SESSION['ErrorMsg'] = "Qualification Name - Should be less than 20 characters!";

                                        } elseif(!preg_match("/^[A-Za-z0-9._@#$%&*!]+$/", $Password)) {
                                            $_SESSION['ErrorMsg'] = "Please Enter valid Password!";

                                        } elseif(strlen($Password) < 5) {
                                            $_SESSION['ErrorMsg'] = "Password - should be greater than 5 character's!";

                                        } elseif(!preg_match("/^[A-Za-z0-9._@#$%&*!]+$/", $CPassword)) {
                                            $_SESSION['ErrorMsg'] = "Please Enter valid Confirm Password!";

                                        } elseif(strlen($CPassword) < 5) {
                                            $_SESSION['ErrorMsg'] = "Confirm Password - should be greater than 5 character's!";

                                        } elseif($Password !== $CPassword) {
                                            $_SESSION['ErrorMsg'] = "Password and Confirm Password - not Matched!";

                                        } elseif(!preg_match("/^[0-9০-৯\-\+ ]+$/", $UMobile)) {
                                            $_SESSION['ErrorMsg'] = "Mobile number must be Number, dashed are allowed!";

                                        } elseif($UImageSize > 256000) {
                                            $_SESSION['ErrorMsg'] = "Your Photo size - should be less than 220kb!";

                                        } elseif(!preg_match("/^[a-zA-Zক-য়অ-ঔৎংঃ ঁ০-৯.,\-0-9\/\W ]+$/", $UAddress)) {
                                            $_SESSION['ErrorMsg'] = "Address used - only Eng/Ban-small letter, White-spaces, Dotted, Dashed, Comma, Eng/Ban-numbers are allowed!";

                                        } else {
                                            // Query to Insert Admin Data in Database...
                                            if(checkUserNameExists($UName)) {
                                                $_SESSION['ErrorMsg'] = "User Name already exists!";

                                            } elseif (checkUserEmailExists($UEmail)) {
                                                $_SESSION['ErrorMsg'] = "User Email already exists!";

                                            } else {
                                                $StrToken = "qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM1234567890!$/()*";
                                                $StrToken = str_shuffle($StrToken);
                                                $StrToken = substr($StrToken, 0, 15);

                                                $UPasswordHash = password_hash($Password, PASSWORD_BCRYPT);
                                                $UCPasswordHash = password_hash($CPassword, PASSWORD_BCRYPT);

                                                $sql = "INSERT INTO `tbl_users`(`full_name`, `user_name`, `user_email`, `user_qualification`, `user_bio`, `user_password`, `user_confirm_password`,  `user_mobile`, `user_image`, `user_address`, `role`, `datetime`) VALUES (:fullName, :userName, :userEmail, :userQualification, :userBio, :userPassword, :userConfirmPassword, :userMobile, :userImage, :userAddress, :rolE, :dateTime)";

                                                $stmt = $conn->prepare($sql);

                                                $stmt->bindValue(':fullName', $FName);
                                                $stmt->bindValue(':userName', $UName);
                                                $stmt->bindValue(':userEmail', $UEmail);
                                                $stmt->bindValue(':userQualification', $UQualification);
                                                $stmt->bindValue(':userBio', $UBio);
                                                $stmt->bindValue(':userPassword', $UPasswordHash);
                                                $stmt->bindValue(':userConfirmPassword', $UCPasswordHash);
                                                $stmt->bindValue(':userMobile', $UMobile);
                                                $stmt->bindValue(':userImage', $NewUImageName);
                                                $stmt->bindValue(':userAddress', $UAddress);
                                                $stmt->bindValue(':rolE', $Role);
                                                $stmt->bindValue(':dateTime', $DateTime);

                                                move_uploaded_file($SourceDir, $UploadImageDir);

                                                $InsertData = $stmt->execute();

                                                if($InsertData) {
//                $_SESSION['SuccessMsg'] = "Success, You have been registered, Please verify your email";
                                                    $_SESSION['SuccessMsg'] = "Success, User Added successfully done, Contact to Administrator for Login Approval!";
                                                    redirect_to("dashboard.php?page=manage-users");

                                                } else {
                                                    $_SESSION['ErrorMsg'] = "Something wrong, User Adding failed and contact to the Administrator!";

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

                                    <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
                                        <h5 class="mb-md ">To enjoy more!</h5>
                                        <div class="form-group">
                                            <label for="FName">User Full Name : </label>
                                            <input type="text" class="form-control" id="FName" name="FName" placeholder="Enter Full Name" value="<?= isset($FName) ? $FName:''?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="UName">User Name : </label>
                                            <input type="text" class="form-control" id="UName" name="UName" placeholder="Enter User Name" value="<?= isset($UName) ? $UName:''?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="UEmail">User Email Address : </label>
                                            <input type="text" class="form-control" id="UEmail" name="UEmail" placeholder="Enter Email Address" value="<?= isset($UEmail) ? $UEmail:''?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="UQualification">User Qualification : </label>
                                            <input type="text" class="form-control" id="UQualification" name="UQualification" placeholder="Enter Your Qualification" value="<?= isset($UQualification) ? $UQualification:''?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="textareaMaxLength" class="control-label">User Biography : </label>
                                            <textarea class="form-control" name="UBio" rows="5" id="textareaMaxLength" placeholder="Enter Your Bio" maxlength="500" value="<?= isset($UBio) ? $UBio:''?>"></textarea>
                                            <span class="help-block"><i class="fa fa-info-circle mr-xs"></i>Max characters set to <span class="code">500</span></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="Password">User Password : </label>
                                            <input type="password" class="form-control" id="Password" name="Password" placeholder="Enter your Password">
                                        </div>
                                        <div class="form-group">
                                            <label for="CPassword">User Confirm Password : </label>
                                            <input type="password" class="form-control" id="CPassword" name="CPassword" placeholder="Enter Confirm Password" value="<?= isset($ConfirmPassword) ? $ConfirmPassword:''?>">
                                        </div>
<!--                                        <div class="form-group">-->
<!--                                            <label for="AddedBy">User Added By : </label>-->
<!--                                            <select name="AddedBy" id="AddedBy" class="form-control">-->
<!--                                                <option value="">Select Added By</option>-->
<!--                                                <option value="Normal User">Normal User</option>-->
<!--                                                <option value="Super Admin">Super Admin</option>-->
<!--                                                <option value="Admin">Admin</option>-->
<!--                                            </select>-->
<!--                                        </div>-->
                                        <div class="form-group">
                                            <label for="UMobile">User Mobile : </label>
                                                <input type="text" class="form-control" id="UMobile" name="UMobile" placeholder="Enter Your Mobile" value="<?= isset($UserMobile) ? $UserMobile:''?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="UImage">Choose User Image : </label>
                                            <input type="file" name="UImage" class="form-control" id="UImage">
                                        </div>
                                        <div class="form-group">
                                            <label for="UAddress">User Address : </label>
                                            <input type="text" class="form-control" id="UAddress" name="UAddress" placeholder="Enter Your Address" value="<?= isset($UserAddress) ? $UserAddress:''?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="Role">Select User Role : </label>
                                                <select name="Role" id="Role" class="form-control">
                                                    <option value="">Select Role</option>
                                                    <option value="1">Super Admin</option>
                                                    <option value="2">Admin</option>
                                                    <option value="3">Normal User</option>
                                                </select>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" name="AddUser" class="btn btn-primary">Add User</button>
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
