<?php
include_once("inc/user-head.php");
?>

    <div class="wrap">
        <!-- page HEADER -->
        <!-- ========================================================= -->
        <?php include_once("inc/user-header.php"); ?>
        <!-- page BODY -->
        <!-- ========================================================= -->
        <div class="page-body">
            <!-- LEFT SIDEBAR -->
            <!-- ========================================================= -->
            <?php include_once("inc/user-left-sidebar.php"); ?>
            <!-- CONTENT -->
            <!-- ========================================================= -->

            <?php
            $PageDir = "pages";

            //print_r($PageFolder);

            extract($_GET);

            if(!empty($page)) {

                $page = htmlentities($page, ENT_QUOTES);

                $PageFolder = scandir($PageDir);
                $PageFolder = array_diff($PageFolder, array('.', '..'));

                if(in_array($page . '.php', $PageFolder)) {
                    include_once ($PageDir . '/' . $page.'.php');

                } else {
                    include_once ($PageDir . '/error-page.php');
                }


            } else {
                include_once ($PageDir . '/user-home.php');
            }

            ?>

            <!--scroll to top-->
            <a href="#" class="scroll-to-top"><i class="fa fa-angle-double-up"></i></a>
        </div>

    </div>


<?php
include_once("inc/user-footer.php");
?>