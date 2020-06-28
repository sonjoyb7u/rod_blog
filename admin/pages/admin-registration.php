<?php
//Using Globally Database Connection-variable previous PHP version - 5.6...
global $conn;

extract($_POST);
extract($_FILES);

if(isset($UserRegister)) {
    $FullName = htmlentities($UserFullName, ENT_QUOTES);
    $Username = strtolower(htmlentities($Username, ENT_QUOTES));
    $UserEmail = strtolower(htmlentities($UserEmail, ENT_QUOTES));
    $UserQualification = htmlentities($UserQualification, ENT_QUOTES);
    $UserPassword = htmlentities($UserPassword, ENT_QUOTES);
    $UserConfirmPassword = htmlentities($UserConfirmPassword, ENT_QUOTES);
    $UserMobile = htmlentities($UserMobile, ENT_QUOTES);

    $UserPhotoName = $UserPhoto['name'];
    $SourceDir = $UserPhoto['tmp_name'];
    $UserPhotoSize = $UserPhoto['size'];
    $NewUserPhotoName = rand(100, 2000) . '-' . $Username . '-' . $UserPhotoName;
    $UploadImageDir = "uploads/admin-image/" . $NewUserPhotoName;

    $UserAddress = htmlentities($UserAddress, ENT_QUOTES);
    $UserRole = htmlentities($UserRole, ENT_QUOTES);

    date_default_timezone_set("Asia/Dhaka");
    $DateTime =  date("Y-M-d h:i:sA");

    if(empty($FullName) || empty($Username) || empty($UserEmail) || empty($UserQualification) || empty($UserPassword) || empty($UserConfirmPassword) || empty($UserMobile) || empty($UserPhotoName) || empty($UserAddress) || empty($UserRole)) {
        $_SESSION['ErrorMsg'] = "All field must be filled out!";

    } elseif(!preg_match("/^[a-zA-Zক-য়অ-ঔৎংঃ ঁ. ]+$/", $FullName)) {
        $_SESSION['ErrorMsg'] = "Full Name used - only Eng/Ban-letter, White-spaces, Dotted are allowed!";

    } elseif(strlen($FullName) > 25) {
        $_SESSION['ErrorMsg'] = "Full Name - Should be less than 25 characters!";

    } elseif(!preg_match("/^[a-zA-Zক-য়অ-ঔৎংঃ ঁ০-৯._0-9 ]+$/", $Username)) {
        $_SESSION['ErrorMsg'] = "User Name used - only Eng/Ban-small letter, White-spaces, Dotted, Dashed, Eg/Ban-numbers are allowed!";

    } elseif(strlen($Username) > 15) {
        $_SESSION['ErrorMsg'] = "User Name - Should be less than 15 characters!";

    } elseif(!preg_match("/^[A-Za-z._0-9]+@[A-Za-z._0-9]+[.]{1}[A-Za-z._0-9]+$/", $UserEmail)) {
        $_SESSION['ErrorMsg'] = "Please Enter valid Email Address!";

    } elseif(!preg_match("/^[A-Za-zক-য়অ-ঔৎংঃ ঁ.\-০-৯0-9\W\(\) ]+$/", $UserQualification)) {
        $_SESSION['ErrorMsg'] = "Qualification used - only Eng/Ban-small letter, White-spaces, Dotted, Dashed, Eng/Ban-numbers are allowed!";

    } elseif(strlen($UserQualification) > 20) {
        $_SESSION['ErrorMsg'] = "Qualification Name - Should be less than 20 characters!";

    } elseif(!preg_match("/^[A-Za-z0-9._@#$%&*!]+$/", $UserPassword)) {
        $_SESSION['ErrorMsg'] = "Please Enter valid Password!";

    } elseif(strlen($UserPassword) < 5) {
        $_SESSION['ErrorMsg'] = "Password - should be greater than 5 character's!";

    } elseif(!preg_match("/^[A-Za-z0-9._@#$%&*!]+$/", $UserConfirmPassword)) {
        $_SESSION['ErrorMsg'] = "Please Enter valid Confirm Password!";

    } elseif(strlen($UserConfirmPassword) < 5) {
        $_SESSION['ErrorMsg'] = "Confirm Password - should be greater than 5 character's!";

    } elseif($UserPassword !== $UserConfirmPassword) {
        $_SESSION['ErrorMsg'] = "Password and Confirm Password - not Matched!";

    } elseif(!preg_match("/^[0-9০-৯\-\+ ]+$/", $UserMobile)) {
        $_SESSION['ErrorMsg'] = "Mobile number must be Number, dashed are allowed!";

    } elseif($UserPhotoSize > 256000) {
        $_SESSION['ErrorMsg'] = "Your Photo size - should be less than 220kb!";

    } elseif(!preg_match("/^[a-zA-Zক-য়অ-ঔৎংঃ ঁ০-৯.,\-0-9\/\W ]+$/", $UserAddress)) {
        $_SESSION['ErrorMsg'] = "Address used - only Eng/Ban-small letter, White-spaces, Dotted, Dashed, Comma, Eng/Ban-numbers are allowed!";

    }
    else {
        // Query to Insert Admin Data in Database...
        if(checkUserNameExists($Username)) {
            $_SESSION['ErrorMsg'] = "User Name already exists!";

        } elseif (checkUserEmailExists($UserEmail)) {
            $_SESSION['ErrorMsg'] = "User Email already exists!";

        } else {
            $StrToken = "qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM1234567890!$/()*";
            $StrToken = str_shuffle($StrToken);
            $StrToken = substr($StrToken, 0, 15);

            $UserPasswordHash = password_hash($UserPassword, PASSWORD_BCRYPT);
            $UserConfirmPasswordHash = password_hash($UserConfirmPassword, PASSWORD_BCRYPT);

            $sql1 = "INSERT INTO `tbl_users`(`full_name`, `user_name`, `user_email`, `user_qualification`, `user_password`, `user_confirm_password`, `user_mobile`, `user_image`, `user_address`, `role`, `datetime`) VALUES (:fullName, :userName, :userEmail, :userQualification, :userPassword, :userConfirmPassword, :userMobile, :userImage, :userAddress, :rolE, :dateTime)";

//            require_once 'PHPMailer/PHPMailerAutoload.php';
////            require_once 'SendMailProcess.php';
//
//            $mail = new PHPMailer();
//
//            $mail->SMTPDebug = 4;                               // Enable verbose debug output
//
//            $mail->isSMTP();                                      // Set mailer to use SMTP
//            $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
//            $mail->SMTPAuth = true;                               // Enable SMTP authentication
//            $mail->Username = 'piyal.john@gmail.com';                 // SMTP username
//            $mail->Password = 'SBJ$2911198261450286';                           // SMTP password
//            $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
//            $mail->Port = 587;                                    // TCP port to connect to
//
//            $mail->setFrom('piyal.john@gmail.com', 'Sonjoy-WebAppDev');
//            $mail->addAddress($UserEmail, $FullName);     // Add a recipient
////            $mail->addAddress('ellen@example.com');               // Name is optional
//            $mail->Subject = 'Please verify your Email!';
//            $mail->addReplyTo('piyal.john@gmail.com');
////
//            $mail->isHTML(true);
//            $Url = 'http://' . $_SERVER['SERVER_NAME'] . '/rod-blog/index.php?page=confirm-email&email='.$UserEmail.'&token='.$StrToken;
//            $mail->Body    = "<div style='border: 2px solid rebeccapurple'>
//                                Please click on the link below : <br><br>
//                                <a href=$Url>Click Here</a>
//
//                              </div>";
//
//            $mail->send();

            $stmt1 = $conn->prepare($sql1);

            $stmt1->bindValue(':fullName', $FullName);
            $stmt1->bindValue(':userName', $Username);
            $stmt1->bindValue(':userEmail', $UserEmail);
            $stmt1->bindValue(':userQualification', $UserQualification);
            $stmt1->bindValue(':userPassword', $UserPasswordHash);
            $stmt1->bindValue(':userConfirmPassword', $UserConfirmPasswordHash);
            $stmt1->bindValue(':userMobile', $UserMobile);
            $stmt1->bindValue(':userImage', $NewUserPhotoName);
            $stmt1->bindValue(':userAddress', $UserAddress);
            $stmt1->bindValue(':rolE', $UserRole);
            $stmt1->bindValue(':dateTime', $DateTime);

            move_uploaded_file($SourceDir, $UploadImageDir);

            $InsertData = $stmt1->execute();

            if($InsertData) {
//                $_SESSION['SuccessMsg'] = "Success, You have been registered, Please verify your email";
                $_SESSION['SuccessMsg'] = "Success, You registration successfully done, Please verify your email Or Contact to Administrator for Login Approval!";
                redirect_to("index.php?page=admin-login");

            } else {
                $_SESSION['ErrorMsg'] = "Something wrong, Registration failed and contact to the Administrator!";

            }

        }




    }

}

?>

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="blog-banner">
            <div class="admin-login">
                <img src="./../img/banner/RodImage-4.png" alt="" class="img-responsive">
                <div class="banner-overlay"></div>
            </div>
            <!-- <div  id="lib-std"></div> -->
            <div id="particles-banner"></div>
            <div class="wrap lib-login">
<!--                <div class="col-md-12">-->
            <!-- page BODY -->
            <!-- ========================================================= -->
            <div class="page-body animated slideInDown">
                <div class="UserRegBox">
                    <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->

                    <!--LOGO-->
                    <div class="logo lib-logo">
                        <h2 class="text-center" style="font-weight: bold">ROD<>BLOG</h2>
                        <h3 class="text-center" style="font-weight: bold"> ADMIN REGISTRATION </h3>
                    </div>

                <div class="box col-md-4 col-lg-4 col-md-offset-4 col-lg-offset-4 admin-login-box">
                    <?php

                    if(isset($_SESSION['SuccessMsg'])) { ?>
                        <div><?= successMessage(); ?></div>
                        <?php
                    } else { ?>
                        <div><?= errorMessage(); ?></div>
                        <?php
                    }

                    ?>
                    <!--SIGN IN FORM-->
                    <div class="panel mb-none">
                        <div class="panel-content bg-scale-0">
                            <form action="<?= htmlspecialchars($_SERVER['PHP_SELF'] . '?page=admin-registration')?>" method="post" enctype="multipart/form-data">
                                <div class="form-group mt-md">
                                    <span class="input-with-icon">
                                        <input type="text" class="form-control" id="UserFullName" name="UserFullName" placeholder="Enter Your Full Name" value="<?= isset($FullName) ? $FullName : ''; ?>">
                                        <i class="fa fa-user"></i>
                                    </span>
                                </div>
                                <div class="form-group mt-md">
                                    <span class="input-with-icon">
                                        <input type="text" class="form-control" id="Username" name="Username" placeholder="Enter Your User Name" value="<?= isset($Username) ? $Username : ''; ?>">
                                        <i class="fa fa-user"></i>
                                    </span>
                                </div>
                                <div class="form-group mt-md">
                                    <span class="input-with-icon">
                                        <input type="text" class="form-control" id="Email" name="UserEmail" placeholder="Enter Your Email Address" value="<?= isset($UserEmail) ? $UserEmail : ''; ?>">
                                        <i class="fa fa-envelope"></i>
                                    </span>
                                </div>
                                <div class="form-group mt-md">
                                    <span class="input-with-icon">
                                        <input type="text" class="form-control" id="UserQualification" name="UserQualification" placeholder="Enter Your User Qualification" value="<?= isset($UserQualification) ? $UserQualification : ''; ?>">
                                        <i class="fa fa-user"></i>
                                    </span>
                                </div>
                                <div class="form-group">
                                    <span class="input-with-icon">
                                        <input type="password" class="form-control" id="UserPassword" name="UserPassword" placeholder="Enter Your Password">
                                        <i class="fa fa-key"></i>
                                    </span>
                                </div>
                                <div class="form-group">
                                    <span class="input-with-icon">
                                        <input type="password" class="form-control" id="UserConfirmPassword" name="UserConfirmPassword" placeholder="Enter Your Confirm Password">
                                        <i class="fa fa-key"></i>
                                    </span>
                                </div>
                                <div class="form-group">
                                    <span class="input-with-icon">
                                        <input type="text" class="form-control" id="UserMobile" name="UserMobile" placeholder="Enter Your Mobile Number" value="<?= isset($UserMobile) ? $UserMobile : ''; ?>">
                                        <i class="fa fa-phone"></i>
                                    </span>
                                </div>
                                <div class="form-group">
                                    <span class="input-with-icon">
                                        <input type="file" class="form-control" id="UserPhoto" name="UserPhoto" placeholder="Enter Your Photo">
                                        <i class="fa fa-file"></i>
                                    </span>
                                </div>
                                <div class="form-group">
                                    <span class="input-with-icon">
                                        <input type="text" class="form-control" id="UserAddress" name="UserAddress" placeholder="Enter Your Address" value="<?= isset($UserAddress) ? $UserAddress : ''; ?>">
                                        <i class="fa fa-book"></i>
                                    </span>
                                </div>
                                <div class="form-group">
                                    <span class="input-with-icon">
                                        <select name="UserRole" id="UserRole" class="form-control">
                                            <option disabled>Select Role</option>
                                            <option value="2">Admin</option>
                                            <option value="3">Visitor User</option>
                                        </select>
<!--                                        <i class="fa fa-user" style="margin-right: 10px"></i>-->
                                    </span>
                                </div>
                                <div class="form-group">
                                    <div class="checkbox-custom checkbox-primary LogForPassRegBtn">
                                        <input type="checkbox" id="terms" value="option1">
                                        <label class="check" for="terms">I agree </label>  to the <a href="#">Terms and Conditions</a>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="submit" name="UserRegister" class="btn btn-primary form-control RegisterBtn" value="Register">
<!--                                    <a href="" class="btn btn-primary btn-block RegisterBtn">Register</a>-->
                                </div>
                                <div class="form-group text-center LogForPassRegBtn">
                                    Have an account ? Please <a href="<?= htmlspecialchars($_SERVER['PHP_SELF'] . '?page=admin-login')?>">Log In</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
                </div>
                </div>
<!--            </div>-->
            </div>

        </div>
        </div>
    </div>
</div>
