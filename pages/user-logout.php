<?php
include_once("inc/head.php");
?>

<?php

extract($_GET);
$UserLogout = base64_decode($logout);

if(isset($UserLogout)) {
//    $UserId = null;
    unset($UserId);
//    $_SESSION['FullName'] = null;


    session_destroy();
    redirect_to("index.php");
}


?>