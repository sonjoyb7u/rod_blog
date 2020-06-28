<?php 
include_once ("inc/head.php");
?>

<?php
    adminUserLoginConfirm();
?>
<?php
//if(!isset($_SESSION['UserId'])) {
//    redirect_to("index.php");
//}
?>

<?php

global $conn;
$UserId = $_SESSION['UserId'];

$sql = "SELECT * FROM `tbl_users` WHERE `user_id` = '$UserId'";
$stmt = $conn->query($sql);

while($DataRow = $stmt->fetch()) {
    $UserId = $DataRow['user_id'];
    $UserFullName = html_entity_decode($DataRow['full_name'], ENT_QUOTES);
    $UserUserName = html_entity_decode($DataRow['user_name'], ENT_QUOTES);
    $UserEmail = html_entity_decode($DataRow['user_email'], ENT_QUOTES);
    $UserQualification = html_entity_decode($DataRow['user_qualification'], ENT_QUOTES);
    $UserImage = html_entity_decode($DataRow['user_image'], ENT_QUOTES);
    $UserRole = html_entity_decode($DataRow['role'], ENT_QUOTES);
    $DateTime = html_entity_decode($DataRow['datetime'], ENT_QUOTES);

}
?>

    <div class="page-header">
        <!-- LEFTSIDE header -->
        <div class="leftside-header">
            <div class="logo">
                <a href="dashboard.php" class="on-click">
                    <h3>ROD-BLOG</h3>
                </a>
            </div>
            <div id="menu-toggle" class="visible-xs toggle-left-sidebar" data-toggle-class="left-sidebar-open" data-target="html">
                <i class="fa fa-bars" aria-label="Toggle sidebar"></i>
            </div>
        </div>
        <!-- RIGHTSIDE header -->
        <div class="rightside-header">
            <div class="header-middle"></div>
            <!--SEARCH HEADERBOX-->
            <div class="header-section" id="search-headerbox">
                <input type="text" name="search" id="search" placeholder="Search...">
                <i class="fa fa-search search" id="search-icon" aria-hidden="true"></i>
                <div class="header-separator"></div>
            </div>
            <!--USER HEADERBOX -->
            <div class="header-section" id="user-headerbox">
                <div class="user-header-wrap">
                    <div class="user-photo">
                        <img alt="profile photo" src="uploads/admin-image/<?= $UserImage; ?>" />
                    </div>
                    <div class="user-info">
                        <span class="user-name"><?= isset($UserFullName) ? $UserFullName : 'ADMIN NAME'?></span>
                        <span class="user-profile">
                            <?php
                                if($UserRole == 1) { ?>
                                    <span>Super Admin</span>
                            <?php
                                } elseif($UserRole == 2) { ?>
                                    <span>Admin</span>
                            <?php
                                } elseif($UserRole == 3) {?>
                                    <span>User</span>
                            <?php
                                }
                            ?>
                        </span>
                    </div>
                    <i class="fa fa-plus icon-open" aria-hidden="true"></i>
                    <i class="fa fa-minus icon-close" aria-hidden="true"></i>
                </div>
                <div class="user-options dropdown-box">
                    <div class="drop-content basic">
                        <ul>
                            <li class="<?= $page == 'admin-profile' ? 'active-item' : '' ?>"><a href="dashboard.php?page=user-profile">Profile</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="header-separator"></div>
            <!--Log out -->
            <div class="header-section">
                <a href="dashboard.php?page=admin-logout&logout=<?= base64_encode($UserId); ?>" data-toggle="tooltip" data-placement="left" title="Logout"><i class="fa fa-sign-out log-out" aria-hidden="true"></i></a>
            </div>
        </div>
    </div>



<?php include_once ("inc/left-sidebar.php"); ?>



