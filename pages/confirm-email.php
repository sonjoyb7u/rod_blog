<?php
global $conn;

$Url = 'http://' . $_SERVER['SERVER_NAME'] . '/rod-blog/';

extract($_GET);

if(!isset($email) || !isset($token)) {
    redirect_to($Url . 'index.php?page=user-registration');
    exit();
} else {
    $Email = htmlentities($email, ENT_QUOTES);
    $Token = htmlentities($token, ENT_QUOTES);

    $sql = "SELECT * FROM `tbl_users` WHERE `user_email` = '$Email' AND `is_email_confirmed` = 0 AND `token` = '$Token'";

    $stmt = $conn->query($sql);

    $CheckRow = $stmt->rowCount();

    if($CheckRow > 0) {
        $IsEmailConfirmed = 1;
        $token = '';

        $sql = "UPDATE `tbl_users` SET `is_email_confirmed`=:isEmailConfirmed,`token`=:tokeN WHERE `user_email` = '$Email'";
        $stmt = $conn->prepare($sql);

        $stmt->bindValue(':isEmailConfirmed', $IsEmailConfirmed);
        $stmt->bindValue(':tokeN', $token);

        $ExecuteData = $stmt->execute();

        if($ExecuteData) {
            $_SESSION['SuccessMsg'] = "Success, Your email has been Verified - Now you are Registered, Please Contact to Administrator for Login Approval!";
            redirect_to($Url . 'index.php?page=user-login');

        } else {
            redirect_to($Url . 'index.php?page=user-registration');
        }


    } else {
        $_SESSION['ErrorMsg'] = "Failed, Your email has not Verified, Please try again!";
        redirect_to($Url . 'index.php?page=user-registration');

    }

}



?>