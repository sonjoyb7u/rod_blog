<?php 
include_once ("inc/head.php"); 
?>

<?php

$PageDir = "pages";

extract($_GET);
if(!empty($page)) {

    $page = htmlentities($page, ENT_QUOTES);
    // echo $page;

//          unset($PagesFolder[0], $PagesFolder[1]);
//          array_shift($PagesFolder);
//          array_shift($PagesFolder);
//          print_r($PagesFolder);

    $PageFolder = scandir($PageDir);
    $PageFolder = array_diff($PageFolder, array('.', '..'));
    // print_r($PagesFolder);

    if(in_array($page . ".php", $PageFolder)) {
        // echo true;
        include_once ($PageDir . "/" . $page.".php");

    } else {
        include_once ($PageDir . "/error-page.php");

    }

} else {
    include_once ($PageDir . "/admin-login.php");
}


?>


<?php 
include_once ("inc/footer.php"); 
?>