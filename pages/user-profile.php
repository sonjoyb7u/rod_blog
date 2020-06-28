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

    <!--PROFILE-->
    <div class="row animated fadeInUp" style="margin-top: 120px;">
        <?php

            if(isset($_SESSION['SuccessMsg'])) { ?>

                <div><?= successMessage(); ?></div>

        <?php
            } else { ?>

                <div><?= errorMessage(); ?></div>

        <?php
            }
        ?>
        <div class="col-sm-6 col-md-8 col-lg-8 col-lg-offset-2 col-md-offset-2">
            <div class="profile-photo">
                <img alt="User photo" src="admin/uploads/admin-image/<?= $UserImage; ?>">
            </div>
            <div class="user-header-info">
                <h2 class="user-name"><?= isset($UserFullName) ? $UserFullName : 'USER NAME'; ?></h2>
                <h5 class="user-position"><?= $UserQualification; ?></h5>
                <div class="user-social-media">
                    <span class="text-lg"><a href="#" class="fa fa-twitter-square"></a> <a href="#" class="fa fa-facebook-square"></a> <a href="#" class="fa fa-linkedin-square"></a> <a href="#" class="fa fa-google-plus-square"></a></span>
                </div>
            </div>

            <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
            <!--CONTACT INFO-->
            <div class="panel bg-scale-0 b-primary bt-sm mt-xl">
                <div class="panel-content">
                    <h4 class=""><b>Contact Information</b></h4>
                    <ul class="user-contact-info ph-sm">
                        <li><b><i class="color-primary mr-sm fa fa-envelope"></i></b> <?= isset($UserEmail) ? $UserEmail : 'USER EMAIL'?></li>
                        <li><b><i class="color-primary mr-sm fa fa-phone"></i></b> <?= $UserMobile; ?></li>
                        <li><b><i class="color-primary mr-sm fa fa-globe"></i></b> <?= $UserAddress; ?></li>
                        <li class="mt-sm"><?= $UserBio; ?></li>
                    </ul>
                    <h5 class="btn" style="background: #189279; padding: 10px; border-radius: 5px;"><a href="user-dashboard.php?page=user-update-profile" style="color: #fff; font-weight: bold;">Edit Profile</a></h5>
                </div>
            </div>
            <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->


        </div>



    </div>



</div>