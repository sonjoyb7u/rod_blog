<?php
global $conn;
extract($_GET);
$EditUserId = base64_decode($EditUserId);

$sql = "SELECT * FROM `tbl_users` WHERE `user_id` = '$EditUserId'";
$stmt = $conn->query($sql);

while($DataRow = $stmt->fetch()) {
    $UserId = $DataRow['user_id'];
    $UserFullName = html_entity_decode($DataRow['full_name'], ENT_QUOTES);
    $UserName = html_entity_decode($DataRow['user_name'], ENT_QUOTES);
    $UserEmail = html_entity_decode($DataRow['user_email'], ENT_QUOTES);
    $UserQualification = html_entity_decode($DataRow['user_qualification'], ENT_QUOTES);
    $UserBio = html_entity_decode($DataRow['user_bio'], ENT_QUOTES);
    $UserPassword = html_entity_decode($DataRow['user_password'], ENT_QUOTES);
    $UserMobile = html_entity_decode($DataRow['user_mobile'], ENT_QUOTES);
    $UserImage = html_entity_decode($DataRow['user_image'], ENT_QUOTES);
    $UserAddress = html_entity_decode($DataRow['user_address'], ENT_QUOTES);
    $UserRole = html_entity_decode($DataRow['role'], ENT_QUOTES);
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
                <li><i class="fa fa-home" aria-hidden="true"></i><a href="#">Dashboard</a></li>
                <li><a href="javascript:avoid(0)">User Profile</a></li>
            </ul>
        </div>
    </div>
    <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->

    <!--PROFILE-->
    <div class="row animated fadeInUp" style="margin-top: 80px;">
        <div class="col-sm-6 col-md-6 col-lg-6 col-md-offset-3 col-lg-offset-3">
            <h3 class="text-bold" style="margin-bottom: 30px; ">User Full Details : </h3>
            <div class="profile-photo">
                <img alt="User photo" src="uploads/admin-image/<?= $UserImage; ?>">
            </div>
            <div class="user-header-info">
                <h2 class="user-name"><?= isset($UserFullName) ? $UserFullName : 'ADMIN NAME'; ?></h2>
                <h5 class="user-position">
                    <?php
                        if($UserRole == 1) { ?>
                            <span>Super Admin</span>
                    <?php
                        } elseif($UserRole == 2) { ?>
                            <span>Admin</span>
                    <?php
                        } elseif($UserRole == 3) { ?>
                            <span>User</span>
                    <?php
                        }
                    ?>
                </h5>
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
                        <li><b><i class="color-primary mr-sm fa fa-phone"></i></b> +8801915-464958</li>
                        <li><b><i class="color-primary mr-sm fa fa-globe"></i></b> Chawttashari Road, Chittagong, BD</li>
                    </ul>
                    <p><?= $UserBio; ?></p>
                    <h5 class="btn" style="background: #189279; padding: 10px; border-radius: 5px;"><a href="dashboard.php?page=edit-user&EditUserId=<?= base64_encode($UserId); ?>" style="color: #fff; font-weight: bold;">Edit Profile</a></h5>
                </div>
            </div>
            <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->


        </div>

    </div>



</div>
