
<!-- CONTENT -->
<!-- ========================================================= -->
<div class="content">
    <!-- content HEADER -->
    <!-- ========================================================= -->
    <div class="content-header">
        <!-- leftside content header -->
        <div class="leftside-content-header">
            <ul class="breadcrumbs">
                <li>
                    <i class="fa fa-table" aria-hidden="true"></i><a href="#">Dashboard</a>
                </li>
                <li><a href="javascript:avoid(0)">Manage Your Post</a></li>
            </ul>
        </div>
    </div>
    <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
    <?php
        if(isset($_SESSION['UserId'])) { ?>
            <div style="margin-top: 80px;"><?= successMessage(); ?></div>
    <?php
        } else { ?>
            <div style="margin-top: 80px;"><?= errorMessage(); ?></div>
    <?php
        }
    ?>

    <div class="row animated fadeInRight" style="margin-top: 80px;">
        <div class="col-sm-12">
            <h4 class="section-subtitle"><b>All Post Manage : </b></h4>
            <div class="panel">
                <div class="panel-content">
                    <div class="table-responsive">
                        <table class="data-table table table-striped table-hover table-bordered text-center" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>Sl No.</th>
                                <th>Category Title</th>
                                <th>Post Title</th>
                                <th>Post Description</th>
                                <th style="width: 90px;">Post Image</th>
                                <th>Author</th>
                                <th>Date & Time</th>
                                <th style="width: 160px;">Action</th>
                            </tr>
                            </thead>
                            <tbody>


                            <?php

                                global $conn;

                                if($_SESSION['Role'] == '1') {
                                    $sql = "SELECT `tbl_posts`.`id`, `tbl_posts`.`cat_id`, `tbl_posts`.`post_title`, `tbl_posts`.`post_desc`, `tbl_posts`.`post_image`, `tbl_posts`.`status`, `tbl_posts`.`datetime`, `tbl_categories`.`title`, `tbl_users`.`full_name`, `tbl_users`.`role` FROM `tbl_posts`
                LEFT JOIN `tbl_categories` ON `tbl_posts`.`cat_id` = `tbl_categories`.`id`
                LEFT JOIN `tbl_users` ON `tbl_posts`.`u_id` = `tbl_users`.`user_id`
                ORDER BY `tbl_posts`.`id` DESC";

                                } elseif ($_SESSION['Role'] == '2' || $_SESSION['Role'] == '3') {
                                    $sql = "SELECT `tbl_posts`.`id`, `tbl_posts`.`cat_id`, `tbl_posts`.`post_title`, `tbl_posts`.`post_desc`, `tbl_posts`.`post_image`,`tbl_posts`.`status`, `tbl_posts`.`datetime`, `tbl_categories`.`title`, `tbl_users`.`full_name`, `tbl_users`.`role` FROM `tbl_posts`
                LEFT JOIN `tbl_categories` ON `tbl_posts`.`cat_id` = `tbl_categories`.`id`
                LEFT JOIN `tbl_users` ON `tbl_posts`.`u_id` = `tbl_users`.`user_id`
                WHERE `tbl_posts`.`u_id` = {$_SESSION['UserId']};
                ORDER BY `tbl_posts`.`id` DESC";

                                }

                                $stmt = $conn->query($sql);

                                $sl = 0;

                                while($DataRows = $stmt->fetch()) {
                                    $sl++;
                                    $PostId = $DataRows['id'];
                                    $CatId = html_entity_decode($DataRows['cat_id'], ENT_QUOTES);
                                    $PostTitle = html_entity_decode($DataRows['post_title'], ENT_QUOTES);
                                    $PostDesc = html_entity_decode($DataRows['post_desc'], ENT_QUOTES);
                                    $PostImage = html_entity_decode($DataRows['post_image'], ENT_QUOTES);
                                    $PostStatus = html_entity_decode($DataRows['status'], ENT_QUOTES);
                                    $DateTime = html_entity_decode($DataRows['datetime'], ENT_QUOTES);
                                    $CatTitle = html_entity_decode($DataRows['title'], ENT_QUOTES);
                                    $UserRole = html_entity_decode($DataRows['role'], ENT_QUOTES);
                                    $UserAuthor = html_entity_decode($DataRows['full_name'], ENT_QUOTES);

                                ?>
                                <tr>
                                    <td><?= $sl; ?></td>
                                    <td><?= $CatTitle; ?></td>
                                    <td><?= $PostTitle; ?></td>
                                    <td>
                                        <?php
                                        if(strlen($PostDesc) > 120) {
                                            $PostDesc = substr($PostDesc, 0, 130) . " ... ...";
                                            echo $PostDesc;
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <img src="admin/uploads/post-image/<?= $PostImage; ?>" alt="<?= $PostImage; ?>" style="width: 100px; height: 70px;">
                                    </td>
                                    <td>
                                        <?php
                                        if(strlen($UserAuthor) > 4) {
                                            $UserAuthor = substr($UserAuthor, 0, 8)."..";
                                            echo $UserAuthor;
                                        }
                                        ?>
                                    </td>
                                    <td><?= $DateTime; ?></td>
                                    <td>
                                        <div class="btn-group btn-group-md">
<!--                                            <a href="./index.php?page=blog-details&FullPostId=--><?//= base64_encode($PostId); ?><!--" type="submit" target="_blank" class="btn btn-info" style="margin-right: 3px;"><i class="fa fa-eye"></i>-->
<!--                                            </a>-->
                                            <a href="user-dashboard.php?page=user-edit-post&EditUserPostId=<?= base64_encode($PostId); ?>" type="submit" class="btn btn-primary" style="margin-right: 3px;"><i class="fa fa-pencil"></i>
                                            </a>
                                        </div>
                                    </td>

                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
