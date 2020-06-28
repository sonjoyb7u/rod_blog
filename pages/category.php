
<!--================ Hero sm Banner start =================-->
  <section class="mb-30px">
    <div class="container">
      <div class="hero-banner hero-banner--sm">
        <div class="hero-banner__content">
          <h1>Category Page</h1>
          <nav aria-label="breadcrumb" class="banner-breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="../index.php?page=blog-post">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Category Page</li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
  </section>
  <!--================ Hero sm Banner end =================-->

  <!--================ Start Blog Post Area =================-->
  <section class="blog-post-area section-margin">
    <div class="container">
      <div class="row">
        <div class="col-lg-8">
          <div class="row">

              <?php

                if(isset($_SESSION['SuccessMsg'])) { ?>

                  <div><?= successMessage(); ?></div>

              <?php
                } else { ?>

                  <div><?= errorMessage(); ?></div>

              <?php
                }

              ?>

              <?php

              global $conn;

              extract($_GET);

              extract($_POST);
              // echo $SearchPost;


              if(isset($Page)) {
                  $Page = base64_decode($Page);
                  $Page = htmlentities($Page, ENT_QUOTES);

              } else {
                  $Page = 1;
              }
              $LimitPosts = 4;
              $OffSet = ($Page - 1) * $LimitPosts;


              //SQL Query When search button is Active...
              if(isset($Search)) {
                  $SearchPost = htmlentities($SearchPost, ENT_QUOTES);

                  $sql = "SELECT `tbl_posts`.`id`, `tbl_posts`.`cat_id`, `tbl_posts`.`post_title`, `tbl_posts`.`post_desc`, `tbl_posts`.`post_image`, `tbl_posts`.`status`, `tbl_posts`.`datetime`, `tbl_categories`.`title`, `tbl_users`.`full_name`, `tbl_users`.`user_name` FROM `tbl_posts`
            LEFT JOIN `tbl_categories` ON `tbl_posts`.`cat_id` = `tbl_categories`.`id`
            LEFT JOIN `tbl_users` ON `tbl_posts`.`u_id` = `tbl_users`.`user_id`
            WHERE `tbl_posts`.`datetime` LIKE :searcH OR `tbl_posts`.`post_title` LIKE :searcH OR `tbl_posts`.`post_desc` LIKE :searcH OR `tbl_categories`.`title` LIKE :searcH OR `tbl_users`.`full_name` LIKE :searcH OR `tbl_users`.`user_name` LIKE :searcH";
                  $stmt = $conn->prepare($sql);

                  $stmt->bindValue(':searcH', '%'.$SearchPost.'%');
                  $stmt->execute();

              } elseif(isset($CatTitle)) {
                  $CatTitle = htmlentities($CatTitle, ENT_QUOTES);

                  $sql = "SELECT `tbl_posts`.`id`, `tbl_posts`.`cat_id`, `tbl_posts`.`post_title`, `tbl_posts`.`post_desc`, `tbl_posts`.`post_image`, `tbl_posts`.`status`, `tbl_posts`.`datetime`, `tbl_categories`.`title`, `tbl_users`.`full_name`, `tbl_users`.`role` FROM `tbl_posts`
            LEFT JOIN `tbl_categories` ON `tbl_posts`.`cat_id` = `tbl_categories`.`id`
            LEFT JOIN `tbl_users` ON `tbl_posts`.`u_id` = `tbl_users`.`user_id` 
            WHERE `tbl_categories`.`title` = '$CatTitle' AND `tbl_posts`.`status` = 1 
            ORDER BY `tbl_posts`.`id` DESC LIMIT {$OffSet}, {$LimitPosts}";
                  $stmt = $conn->query($sql);

              } else {

                  $sql = "SELECT `tbl_posts`.`id`, `tbl_posts`.`cat_id`, `tbl_posts`.`post_title`, `tbl_posts`.`post_desc`, `tbl_posts`.`post_image`, `tbl_posts`.`status`, `tbl_posts`.`datetime`, `tbl_categories`.`title`, `tbl_users`.`full_name`, `tbl_users`.`role` FROM `tbl_posts`
            LEFT JOIN `tbl_categories` ON `tbl_posts`.`cat_id` = `tbl_categories`.`id`
            LEFT JOIN `tbl_users` ON `tbl_posts`.`u_id` = `tbl_users`.`user_id`
            WHERE `tbl_posts`.`status` = 1 
            ORDER BY `tbl_posts`.`id` DESC LIMIT {$OffSet}, {$LimitPosts}";
                  $stmt = $conn->query($sql);

              }

              while($DataRows = $stmt->fetch()) {

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

            <div class="col-md-6">
              <div class="single-recent-blog-post card-view">
                <div class="thumb">
                  <img class="card-img rounded-0" src="admin/uploads/post-image/<?= htmlentities($PostImage); ?>" alt="<?= $PostImage; ?>">
                  <ul class="thumb-info">
                    <li><a href="#"><i class="ti-user"></i><?= htmlentities($UserAuthor); ?></a></li>
                    <li><a href="index.php?page=blog-details&FullPostId=<?= base64_encode($PostId); ?>"><i class="ti-themify-favicon"></i><?= approveCommentsByPost($PostId); ?> Comments</a></li>
                  </ul>
                </div>
                <div class="details mt-20">
                  <a href="blog-single.html">
                    <h3><?= htmlentities($PostTitle); ?></h3>
                  </a>
                  <p>
                    <?php
                      if(strlen($PostDesc) > 200) {
                        $PostDesc = substr($PostDesc, 0, 200) . " ... ...";
                        echo html_entity_decode($PostDesc, ENT_QUOTES);
                      }

                    ?>
                  </p>
                  <a class="button" href="index.php?page=blog-details&FullPostId=<?= base64_encode($PostId); ?>">Read More <i class="ti-arrow-right"></i></a>
                </div>
              </div>
            </div>

<?php } ?>

          </div>


            <div class="row">
                <div class="col-lg-12">
                    <nav class="blog-pagination justify-content-center d-flex">

                        <?php

                        $sql1 = "SELECT * from `tbl_posts`";
                        $stmt = $conn->query($sql1) or die("Query Failed!");

                        $TotalRecords = $stmt->rowCount();
                        //                        echo $TotalRecords;

                        if($TotalRecords > 0) {
                            $TotalPages = ceil($TotalRecords / $LimitPosts);
//                            echo $TotalPages;


                            ?>

                            <ul class="pagination">

                                <?php
                                if($Page > 1) {

                                    ?>
                                    <li class="page-item">
                                        <a href="index.php?page=category&Page=<?= base64_encode(($Page-1)); ?>" class="page-link" aria-label="Previous">
                                <span aria-hidden="true">
                                    <i class="ti-angle-left"></i>
                                </span>
                                        </a>
                                    </li>

                                    <?php
                                }

                                ?>

                                <?php
                                for($StartPage = 1; $StartPage <= $TotalPages; $StartPage++) {
                                    if($StartPage == $Page) {
                                        $active = "active";

                                    } else {
                                        $active = "";

                                    }

                                    ?>

                                    <li class="page-item <?= $active; ?>"><a href="index.php?page=category&Page=<?= base64_encode($StartPage); ?>" class="page-link"><?= $StartPage; ?></a></li>


                                    <?php
                                }
                                ?>

                                <?php
                                if($TotalPages > $Page) {
                                    ?>
                                    <li class="page-item">
                                        <a href="index.php?page=category&Page=<?= base64_encode(($Page+1)); ?>" class="page-link" aria-label="Next">
                                <span aria-hidden="true">
                                    <i class="ti-angle-right"></i>
                                </span>
                                        </a>
                                    </li>

                                    <?php

                                }

                                ?>


                            </ul>

                            <?php
                        }
                        ?>

                    </nav>
                </div>
            </div>

        </div>

        <!-- Start Blog Post Siddebar -->

          <?php include_once ("inc/right-sidebar.php"); ?>


      </div>
        <!-- End Blog Post Sidebar -->
    </div>
  </section>

