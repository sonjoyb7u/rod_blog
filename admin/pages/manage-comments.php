<?php
if($_SESSION['Role'] == '2' || $_SESSION['Role'] == '3') {
    redirect_to('dashboard.php');
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
                    <li><a href="javascript:avoid(0)">Manage Comment</a></li>
                </ul>
            </div>
        </div>
        <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->

        <div class="row animated fadeInUp" style="margin-top: 80px;">
            <?php

                if(isset($_SESSION['SuccessMsg'])) { ?>

                    <div><?= successMessage(); ?></div>

            <?php
                } else { ?>

                    <div><?= errorMessage(); ?></div>

            <?php
                }

            ?>
            <div class="col-sm-12 col-lg-12" style=" ">
                <!-- <div class="row"> -->
                <h4 class="section-subtitle"><b>All Comments Manage : </b></h4>
                <div class="panel">
                    <div class="panel-content">
                        <div class="table-responsive">
                            <table class="data-table table table-striped table-hover table-bordered text-center" cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <th>Sl No.</th>
                                    <th>Name</th>
                                    <th>Comment</th>
                                    <th>Date & Time</th>
                                    <th>Status</th>
                                    <th style="width: 100px;">Action</th>
                                    <th>Details</th>
                                </tr>
                                </thead>
                                <tbody>


                                <?php
                                global $conn;

                                $sql = "SELECT * FROM `tbl_comments`";
                                $stmt = $conn->query($sql);

                                $sl = 0;

                                while($DataRows = $stmt->fetch()) {
                                    $sl++;
                                    $CommenterId = $DataRows['id'];
                                    $CommenterName = html_entity_decode($DataRows['name'], ENT_QUOTES);
                                    $CommenterEmail = html_entity_decode($DataRows['email'], ENT_QUOTES);
                                    $CommenterComment = html_entity_decode($DataRows['comments'], ENT_QUOTES);
                                    $CommenterStatus = html_entity_decode($DataRows['status'], ENT_QUOTES);
                                    $CommenterPostId = $DataRows['post_id'];
                                    $DateTime = $DataRows['datetime'];

                                    ?>
                                    <tr>
                                        <td><?= $sl; ?></td>
                                        <td><?= $CommenterName; ?></td>
                                        <td><?= $CommenterComment; ?></td>
                                        <!--                                                        <td>--><?//= $Password; ?><!--</td>-->
                                        <!--                                                        <td>--><?//= $ConfirmPassword; ?><!--</td>-->
                                        <td><?= $DateTime; ?></td>
                                        <td>
                                            <div class="btn-group btn-group-md">
<!--                                                <a href="dashboard.php?page=approve-comment&ApproveCommentId=--><?//= base64_encode($CommenterId); ?><!--" type="submit" class="btn btn-primary" style="margin-right: 3px;"><i class="fa fa-angellist"></i></i> Approve-->
<!--                                                </a>-->
                                                <?= $CommenterStatus == 1 ? 'Approved' : 'Dis-Approved'; ?>

                                            </div>
                                        </td>
                                        <td>
                                            <div class="btn-group btn-group-md">
                                                <?php
                                                if($_SESSION['Role'] == 1) {

                                                    if($CommenterStatus == 1) { ?>

                                                        <a href="dashboard.php?page=dis-approve-comment&DisApproveCommentId=<?= base64_encode($CommenterId); ?>" type="submit" class="btn btn-success" style="margin-right: 8px;"><i class="fa fa-arrow-circle-up"></i>
                                                        </a>
                                                        <?php
                                                    } else { ?>

                                                        <a href="dashboard.php?page=approve-comment&ApproveCommentId=<?= base64_encode($CommenterId); ?>" type="submit" class="btn btn-warning" style="margin-right: 8px;"><i class="fa fa-arrow-circle-down"></i>
                                                        </a>

                                                        <?php
                                                    }
                                                }
                                                ?>
                                                <a href="dashboard.php?page=delete-comment&DeleteCommentId=<?= base64_encode($CommenterId); ?>" type="submit" class="btn btn-danger"><i class="fa fa-trash"></i>
                                                </a>
                                            </div>
                                        </td>
                                        <td><a href="./../index.php?page=blog-details&FullPostId=<?= base64_encode($CommenterPostId); ?>" type="submit" class="btn btn-info" target="_blank"><i class="fa fa-eye"></i></td>

                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- </div> -->


<!--                <h4 class="section-subtitle"><b>All Approve Comments Manage : </b></h4>-->
<!--                <div class="panel">-->
<!--                    <div class="panel-content">-->
<!--                        <div class="table-responsive">-->
<!--                            <table class="data-table table table-striped table-hover table-bordered text-center" cellspacing="0" width="100%">-->
<!--                                <thead>-->
<!--                                <tr>-->
<!--                                    <th>Sl No.</th>-->
<!--                                    <th>Name</th>-->
<!--                                    <th>Comment</th>-->
<!--                                    <th>Date & Time</th>-->
<!--                                    <th>Revert</th>-->
<!--                                    <th style="width: 100px;">Action</th>-->
<!--                                    <th>Details</th>-->
<!--                                </tr>-->
<!--                                </thead>-->
<!--                                <tbody>-->
<!---->
<!---->
<!--                                --><?php
//                                global $conn;
//
//                                $sql = "SELECT * FROM `tbl_comments` WHERE `status` = 'ON' ORDER BY `id` DESC";
//                                $stmt = $conn->query($sql);
//
//                                $sl = 0;
//
//                                while($DataRows = $stmt->fetch()) {
//                                    $sl++;
//                                    $CommenterId = $DataRows['id'];
//                                    $CommenterName = html_entity_decode($DataRows['name'], ENT_QUOTES);
//                                    $CommenterEmail = html_entity_decode($DataRows['email'], ENT_QUOTES);
//                                    $CommenterComment = html_entity_decode($DataRows['comments'], ENT_QUOTES);
//                                    $CommenterPostId = $DataRows['post_id'];
//                                    $DateTime = $DataRows['datetime'];
//
//                                    ?>
<!--                                    <tr>-->
<!--                                        <td>--><?//= $sl; ?><!--</td>-->
<!--                                        <td>--><?//= $CommenterName; ?><!--</td>-->
<!--                                        <td>--><?//= $CommenterComment; ?><!--</td>-->
<!--                                        <!--                                                        <td>--><?////= $Password; ?><!--<!--</td>-->
<!--                                        <!--                                                        <td>--><?////= $ConfirmPassword; ?><!--<!--</td>-->
<!--                                        <td>--><?//= $DateTime; ?><!--</td>-->
<!--                                        <td>-->
<!--                                            <div class="btn-group btn-group-md">-->
<!--                                                <a href="dashboard.php?page=dis-approve-comment&DisApproveCommentId=--><?//= base64_encode($CommenterId); ?><!--" type="submit" class="btn btn-warning" style="margin-right: 3px;"><i class="fa fa-angellist"></i></i> Dis-Approve-->
<!--                                                </a>-->
<!--                                            </div>-->
<!--                                        </td>-->
<!--                                        <td>-->
<!--                                            <div class="btn-group btn-group-md">-->
<!--                                                <a href="dashboard.php?page=delete-comment&DeleteCommentId=--><?//= base64_encode($CommenterId); ?><!--" type="submit" class="btn btn-danger"><i class="fa fa-trash"></i>-->
<!--                                                </a>-->
<!--                                            </div>-->
<!--                                        </td>-->
<!--                                        <td><a href="./../index.php?page=blog-details&FullPostId=--><?//= base64_encode($CommenterPostId); ?><!--" type="submit" class="btn btn-info" target="_blank"><i class="fa fa-eye"></i></td>-->
<!---->
<!--                                    </tr>-->
<!---->
<?php //} ?>
<!---->
<!--                                </tbody>-->
<!--                            </table>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->



            </div>
        </div>
        <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
    </div>
