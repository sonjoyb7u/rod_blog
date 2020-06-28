<?php
include_once("inc/head.php");
?>

<?php

extract($_GET);
$AdminLogout = base64_decode($logout);

if(isset($AdminLogout)) {
    unset($UserId);

    session_destroy();

    redirect_to("index.php");

}


?>