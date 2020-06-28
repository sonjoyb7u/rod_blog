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
                <li><a href="javascript:avoid(0)">Manage All-Users</a></li>
            </ul>
        </div>
    </div>
    <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
    <div class="row animated fadeInUp" style="margin-top: 50px">
        <?php

            if(isset($_SESSION['SuccessMsg'])) { ?>
                <div class="container"><?= successMessage(); ?></div>
                <?php
            } else { ?>
                <div class="container"><?= errorMessage(); ?></div>
                <?php
            }

        ?>
        <div class="col-sm-12 col-lg-12">
            <!-- <div class="row"> -->
            <h4 class="section-subtitle" style="margin-top: 40px;"><b>All Users Manage : </b></h4>
            <div class="panel">
                <div class="panel-content">
                    <div class="table-responsive">
                        <?php
                        global $conn;

                        $sql = "SELECT * FROM `tbl_users` ORDER BY `user_id` DESC";
                        $stmt = $conn->query($sql);

                        $sl = 0;

                        ?>
                        <table class="data-table table table-striped table-hover table-bordered text-center" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>Sl No.</th>
                                <th>Full Name</th>
                                <th>User Name</th>
                                <th>User Email</th>
                                <th>User Qualification</th>
                                <th>User Biography</th>
                                <th>User Mobile</th>
                                <th>User Image</th>
                                <th>User Address</th>
                                <th>User Role</th>
                                <th>User Status</th>
                                <th>Date & Time</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>


                            <?php

                            while($DataRows = $stmt->fetch()) {
                                $sl++;
                                $UserId = html_entity_decode($DataRows['user_id'], ENT_QUOTES);
                                $FullName = html_entity_decode($DataRows['full_name'], ENT_QUOTES);
                                $UserName = html_entity_decode($DataRows['user_name'], ENT_QUOTES);
                                $UserEmail = html_entity_decode($DataRows['user_email'], ENT_QUOTES);
                                $UserQualification = html_entity_decode($DataRows['user_qualification'], ENT_QUOTES);
                                $UserBio = html_entity_decode($DataRows['user_bio'], ENT_QUOTES);
                                $UserMobile = $DataRows['user_mobile'];
                                $UserImage = html_entity_decode($DataRows['user_image'], ENT_QUOTES);
                                $UserAddress = html_entity_decode($DataRows['user_address'], ENT_QUOTES);
                                $UserRole = html_entity_decode($DataRows['role'], ENT_QUOTES);
                                $UserStatus = html_entity_decode($DataRows['status'], ENT_QUOTES);
                                $DateTime = html_entity_decode($DataRows['datetime'], ENT_QUOTES);

                                ?>
                                <tr>
                                    <td><?= $sl; ?></td>
                                    <td><?= $FullName; ?></td>
                                    <td><?= $UserName; ?></td>
                                    <td style="width: 50px;"><?= $UserEmail; ?></td>
                                    <td><?= $UserQualification; ?></td>
                                    <td><?= $UserBio; ?></td>
                                    <td><?= $UserMobile; ?></td>
                                    <td><img style="margin-top: 10px;" width="60px" height="50px" src="../admin/uploads/admin-image/<?= $UserImage; ?>" alt="<?= $UserImage; ?>"></td>
                                    <!--                                                        <td>--><?//= $Password; ?><!--</td>-->
                                    <!--                                                        <td>--><?//= $ConfirmPassword; ?><!--</td>-->
                                    <td><?= $UserAddress; ?></td>
                                    <td>
                                        <?php
                                        if($UserRole == '1') { ?>
                                            <span>Super Admin</span>
                                            <?php
                                        } elseif ($UserRole == '2') { ?>
                                            <span>Admin</span>
                                            <?php
                                        } elseif ($UserRole == '3') { ?>
                                            <span>Visitor User</span>
                                            <?php
                                        }
                                        ?>
                                    </td>
                                    <td><?= $UserStatus == 1 ? 'Active' : 'Inactive'; ?></td>
                                    <td><?= $DateTime; ?></td>
                                    <td>
                                        <div class="btn-group btn-group-md">
                                            <a href="dashboard.php?page=full-user-details&EditUserId=<?= base64_encode($UserId); ?>" type="submit" class="btn btn-info" style=""><i class="fa fa-eye"></i>
                                            </a>
                                            <a href="dashboard.php?page=edit-user&EditUserId=<?= base64_encode($UserId); ?>" type="submit" class="btn btn-primary" style=""><i class="fa fa-pencil"></i>
                                            </a>
                                            <a href="dashboard.php?page=delete-user&DeleteUserId=<?= base64_encode($UserId); ?>" type="submit" class="btn btn-danger"><i class="fa fa-trash"></i>
                                            </a>
                                            <?php
                                            if($UserStatus == 1) { ?>
                                                <a href="dashboard.php?page=inactive-user&InactiveUserId=<?= base64_encode($UserId); ?>" type="submit" class="btn btn-success"><i class="fa fa-arrow-circle-up"></i>
                                                </a>
                                                <?php
                                            } else { ?>
                                                <a href="dashboard.php?page=active-user&ActiveUserId=<?= base64_encode($UserId); ?>" type="submit" class="btn btn-warning"><i class="fa fa-arrow-circle-down"></i>
                                                </a>
                                                <?php
                                            }
                                            ?>

                                        </div>
                                    </td>

                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- </div> -->

        </div>
    </div>
</div>

