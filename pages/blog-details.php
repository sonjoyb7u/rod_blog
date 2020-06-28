
  <!--================ Hero sm Banner start =================-->
  <section class="mb-30px">
    <div class="container">
      <div class="hero-banner hero-banner--sm">
        <div class="hero-banner__content">
          <h1>Blog details</h1>
          <nav aria-label="breadcrumb" class="banner-breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="index.php?page=blog-post">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Blog Details</li>
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

<?php

global $conn;

extract($_GET);

if(isset($FullPostId)) {
  $FullPostId = base64_decode($FullPostId);
  // echo $FullPostId;

extract($_POST);
if(isset($Search)) {
  $SearchPost = htmlentities($SearchPost, ENT_QUOTES);

    $sql = "SELECT `tbl_posts`.`id`, `tbl_posts`.`cat_id`, `tbl_posts`.`post_title`, `tbl_posts`.`post_desc`, `tbl_posts`.`post_image`, `tbl_posts`.`status`, `tbl_posts`.`datetime`, `tbl_categories`.`title`, `tbl_users`.`full_name`, `tbl_users`.`user_name`, `tbl_users`.`user_image`, `tbl_users`.`role` FROM `tbl_posts`
            LEFT JOIN `tbl_categories` ON `tbl_posts`.`cat_id` = `tbl_categories`.`id`
            LEFT JOIN `tbl_users` ON `tbl_posts`.`u_id` = `tbl_users`.`user_id`
            WHERE `tbl_posts`.`datetime` LIKE :searcH OR `tbl_posts`.`post_title` LIKE :searcH OR `tbl_posts`.`post_desc` LIKE :searcH OR `tbl_categories`.`title` LIKE :searcH OR `tbl_users`.`full_name` LIKE :searcH OR `tbl_users`.`user_name` LIKE :searcH";
  $stmt = $conn->prepare($sql);

  $stmt->bindValue(':searcH', '%'.$SearchPost.'%');
  $stmt->execute();

} elseif (!isset($FullPostId)) {
      $_SESSION['ErrorMsg'] = "Error, Input Bad URL Request - please Don't try this!";
      redirect_to("blog-post.php");

  } else {
        $sql = "SELECT `tbl_posts`.`id`, `tbl_posts`.`u_id`, `tbl_posts`.`cat_id`, `tbl_posts`.`post_title`, `tbl_posts`.`post_desc`, `tbl_posts`.`post_image`, `tbl_posts`.`status`, `tbl_posts`.`datetime`, `tbl_categories`.`title`, `tbl_users`.`full_name`, `tbl_users`.`user_image`, `tbl_users`.`role` FROM `tbl_posts`
                    LEFT JOIN `tbl_categories` ON `tbl_posts`.`cat_id` = `tbl_categories`.`id`
                    LEFT JOIN `tbl_users` ON `tbl_posts`.`u_id` = `tbl_users`.`user_id` WHERE `tbl_posts`.`id` = $FullPostId";

        $stmt = $conn->query($sql);

    }

        while($DataRow = $stmt->fetch()) {

            $PostId = $DataRow['id'];
            $CatId = html_entity_decode($DataRow['cat_id'], ENT_QUOTES);
            $PostTitle = html_entity_decode($DataRow['post_title'], ENT_QUOTES);
            $PostDesc = html_entity_decode($DataRow['post_desc'], ENT_QUOTES);
            $PostImage = html_entity_decode($DataRow['post_image'], ENT_QUOTES);
            $PostStatus = html_entity_decode($DataRow['status'], ENT_QUOTES);
            $DateTime = html_entity_decode($DataRow['datetime'], ENT_QUOTES);
            $CatTitle = html_entity_decode($DataRow['title'], ENT_QUOTES);
            $UserRole = html_entity_decode($DataRow['role'], ENT_QUOTES);
            $UserAuthor = html_entity_decode($DataRow['full_name'], ENT_QUOTES);
            $UserImage = html_entity_decode($DataRow['user_image'], ENT_QUOTES);


?>

           <div class="main_blog_details">
               <img class="img-fluid" src="admin/uploads/post-image/<?= $PostImage; ?>" alt="<?= $PostImage; ?>">
               <a href="#"><h4><?= $PostTitle; ?></h4></a>
               <div class="user_details">
                 <div class="float-left">
                   <a href="#"><?= $CatTitle; ?></a>
                 </div>
                 <div class="float-right mt-sm-0 mt-3">
                   <div class="media">
                     <div class="media-body">
                       <h5><?= $UserAuthor; ?></h5>
                     <?php
                        if($UserRole == '1') { ?>
                            <p style="margin-right: 17px !important;">(Super Admin)</p>
                    <?php
                        } elseif ($UserRole == '2') { ?>
                            <p style="margin-right: 17px !important;">(Admin)</p>
                    <?php
                        } elseif ($UserRole == '3') { ?>
                            <p style="margin-right: 17px !important;">(Visitor)</p>
                    <?php
                        }
                     ?>
                       <p><?= $DateTime; ?></p>
                     </div>
                       <?php
//                            $sql = "SELECT * FROM `tbl_posts` INNER JOIN `tbl_users` ON `tbl_posts`.`u_id`=`tbl_users`.`user_id` WHERE `id` = '$FullPostId'";

                       ?>
                     <div class="d-flex">
                       <img width="55" height="55" src="admin/uploads/admin-image/<?= $UserImage; ?>" alt="<?= $UserImage; ?>">
                     </div>
                   </div>
                 </div>
               </div>

               <?= html_entity_decode($PostDesc, ENT_QUOTES); ?>

              <div class="news_d_footer flex-column flex-sm-row">
<!--                <a href="#"><span class="align-middle mr-2"><i class="ti-heart"></i></span>Lily and 4 people like this</a>-->
<!--                <a class="justify-content-sm-center ml-sm-auto mt-sm-0 mt-2" href="#">-->
<!--                    <span class="align-middle mr-2"><i class="ti-themify-favicon"></i>-->
<!--                    </span>--><?//= approveCommentsByPost($Id); ?><!-- Comments-->
<!--                </a>-->
                  <a class="mt-sm-0 mt-2" href="#">
                    <span class="align-middle mr-2"><i class="ti-themify-favicon"></i>
                    </span><?= approveCommentsByPost($PostId); ?> Comments
                  </a>
                <div class="news_socail ml-sm-auto mt-sm-0 mt-2">
                    <a href="https://www.facebook.com/sonjoy.john"><i class="ti-facebook"></i></a>
                    <a href="#"><i class="ti-twitter-alt"></i></a>
                    <a href="#"><i class="ti-skype"></i></a>
                </div>
              </div>
          </div>
<?php


?>

<!--           <div class="navigation-area">-->
<!--             <div class="row">-->
<!--               <div class="col-lg-6 col-md-6 col-12 nav-left flex-row d-flex justify-content-start align-items-center">-->
<!--                   <div class="thumb">-->
<!--                       <a href="#"><img width="60px" height="50px" class="img-fluid" src="img/blog/author-image/avatar2.png" alt=""></a>-->
<!--                   </div>-->
<!--                   <div class="arrow">-->
<!--                       <a href="#"><span class="lnr text-white lnr-arrow-left"></span></a>-->
<!--                   </div>-->
<!--                   <div class="detials">-->
<!--                       <p>Prev Post</p>-->
<!--                       <a href="#"><h4>Blog Post Title - 2</h4></a>-->
<!--                   </div>-->
<!--               </div>-->
<!--               <div class="col-lg-6 col-md-6 col-12 nav-right flex-row d-flex justify-content-end align-items-center">-->
<!--                   <div class="detials">-->
<!--                       <p>Next Post</p>-->
<!--                       <a href="#"><h4>Blog Post Title - 3</h4></a>-->
<!--                   </div>-->
<!--                   <div class="arrow">-->
<!--                       <a href="#"><span class="lnr text-white lnr-arrow-right"></span></a>-->
<!--                   </div>-->
<!--                   <div class="thumb">-->
<!--                       <a href="#"><img width="60px" height="60px" class="" src="img/blog/author-image/avatar04.png" alt=""></a>-->
<!--                   </div>-->
<!--               </div>-->
<!--             </div>-->
<!--           </div>-->


             <div class="comments-area">
                 <h4>(<?= approveCommentsByPost($PostId); ?>) Comments : </h4>
                    <?php

                    $sql = "SELECT * FROM `tbl_comments` WHERE `post_id` = $FullPostId AND `status` = 1";
                    $stmt = $conn->query($sql);

                      while($DataRows = $stmt->fetch()) {
                        $CommenterId = $DataRows['id'];
                        $CommenterName = html_entity_decode($DataRows['name'], ENT_QUOTES);
                        // $CommenterEmail = html_entity_decode($DataRows['email'], ENT_QUOTES);
                        $Comments = html_entity_decode($DataRows['comments'], ENT_QUOTES);
                        $DateTime = $DataRows['datetime'];


                    ?>


                 <div class="comment-list">
                     <div class="single-comment justify-content-between d-flex">
                         <div class="user justify-content-between d-flex">
                             <div class="thumb">
                                 <img width="60px" height="50px" src="img/blog/author-image/avatar5.png" alt="">
                             </div>
                             <div class="desc">
                                 <h5><a href="#"><?= $CommenterName; ?></a></h5>
                                 <p class="date"><?= $DateTime; ?></p>
                                 <p class="comment">
                                     <?= $Comments; ?>
                                 </p>
                             </div>
                         </div>
                         <div class="reply-btn">
                                 <a href="#" class="btn-reply text-uppercase">reply</a>
                         </div>
                     </div>
                 </div>

                    <?php
                      }
                    ?>

<!--                 <div class="comment-list left-padding">-->
<!--                     <div class="single-comment justify-content-between d-flex">-->
<!--                         <div class="user justify-content-between d-flex">-->
<!--                             <div class="thumb">-->
<!--                                 <img width="60px" height="50px" src="img/blog/author-image/avatar3.png" alt="">-->
<!--                             </div>-->
<!--                             <div class="desc">-->
<!--                                 <h5><a href="#">Sonjoy</a></h5>-->
<!--                                 <p class="date">December 4, 2019 at 3:12 pm </p>-->
<!--                                 <p class="comment">-->
<!--                                     Never say goodbye till the end comes!-->
<!--                                 </p>-->
<!--                             </div>-->
<!--                         </div>-->
<!--                         <div class="reply-btn">-->
<!--                                 <a href="" class="btn-reply text-uppercase">reply</a>-->
<!--                         </div>-->
<!--                     </div>-->
<!--                 </div>-->
<!--                 <div class="comment-list left-padding">-->
<!--                     <div class="single-comment justify-content-between d-flex">-->
<!--                         <div class="user justify-content-between d-flex">-->
<!--                             <div class="thumb">-->
<!--                                 <img width="60px" height="50px" src="img/blog/author-image/avatar.png" alt="">-->
<!--                             </div>-->
<!--                             <div class="desc">-->
<!--                                 <h5><a href="#">Md. Ali</a></h5>-->
<!--                                 <p class="date">December 4, 2019 at 3:12 pm </p>-->
<!--                                 <p class="comment">-->
<!--                                     Never say goodbye till the end comes!-->
<!--                                 </p>-->
<!--                             </div>-->
<!--                         </div>-->
<!--                         <div class="reply-btn">-->
<!--                                 <a href="" class="btn-reply text-uppercase">reply</a>-->
<!--                         </div>-->
<!--                     </div>-->
<!--                 </div>-->
                 
              </div>

<?php

extract($_POST);

if(isset($PostComment)) {

  $FullPostId = htmlentities($FullPostId, ENT_QUOTES);
  $CommenterName = htmlentities(userInput($CommenterName), ENT_QUOTES);
  $CommenterEmail = htmlentities(userInput($CommenterEmail), ENT_QUOTES);
  $CommenterMessage = htmlentities(userInput($CommenterMessage), ENT_QUOTES);

  date_default_timezone_set("Asia/Dhaka");
  $DateTime =  date("Y-M-d h:i:sA");

  if(empty($CommenterName)) {
    $_SESSION['ErrorMsg'] = "Name field - can't be empty!";

  } elseif(!preg_match("/^[ক-য়অ-ঔৎংঃ ঁA-Za-z.\- ]+$/", $CommenterName)) {
      $_SESSION['ErrorMsg'] = "Name - only Letter, White-spaces are allowed!";

  } elseif(strlen($CommenterName) > 21) {
      $_SESSION['ErrorMsg'] = "Name - Should be less than 20 characters!";

  } elseif(empty($CommenterEmail)) {
      $_SESSION['ErrorMsg'] = "Email Address - can't be empty!";

  } elseif(!preg_match("/^[A-Za-z._0-9]+@[A-Za-z._0-9]+[.]{1}[A-Za-z._0-9]+$/", $CommenterEmail)) {
      $_SESSION['ErrorMsg'] = "Please enter valid Email Address!";

  } elseif(empty($CommenterMessage)) {
      $_SESSION['ErrorMsg'] = "Comments text - can't be empty!";

  } elseif(!preg_match("/^[০-৯ক-য়অ-ঔৎংঃ ঁ।,.a-zA-Z0-9-' ]+$/", $CommenterMessage)) {
      $_SESSION['ErrorMsg'] = "Comments text used - only English/Bengali Letter, English/Bengali Number, White-spaces, Dashed, Commas, Dotted, are allowed!";

  } elseif(strlen($CommenterMessage) > 600) {
      $_SESSION['ErrorMsg'] = "Comments text - Should be less than 500 characters!";

  } else {

        // Query to Insert Comments Data in Database...
        //Using Globally Database Connection-variable previous PHP version - 5.6...

        $sql = "INSERT INTO `tbl_comments` (`name`, `email`, `comments`, `approved_by`, `post_id`, `datetime`) VALUES (:namE, :emaiL, :commentS, 'Pending', :posTiDfroMurL, :datetimE)";
        $stmt = $conn->prepare($sql);

        $stmt->bindValue(':namE', $CommenterName);
        $stmt->bindValue(':emaiL', $CommenterEmail);
        $stmt->bindValue(':commentS', $CommenterMessage);
        $stmt->bindValue(':posTiDfroMurL', $FullPostId);
        $stmt->bindValue(':datetimE', $DateTime);

        $ExecuteData = $stmt->execute();
        // var_dump($ExecuteData);

        if($ExecuteData) {
            $_SESSION['SuccessMsg'] = "Success, Comment Submitted Successfully Done, Please Wait For Admin Approval!";

        } else {
            $_SESSION['ErrorMsg'] = "Something went wrong, Comment Data not inserted!";
           
        }
    }

  }

?>

            <?php

                if(isset($_SESSION['SuccessMsg'])) { ?>

                    <div><?= successMessage(); ?></div>

                    <?php
                } else { ?>

                    <div><?= errorMessage(); ?></div>

                    <?php
                }

            ?>


             <div class="comment-form">
                 <h4>Leave a Reply</h4>
                 <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
                     <div class="form-group form-inline">
                       <div class="form-group col-lg-6 col-md-6 name">
                         <input type="text" class="form-control" id="name" name="CommenterName" placeholder="Enter Your Name" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Your Name'">
                       </div>
                       <div class="form-group col-lg-6 col-md-6 email">
                         <input type="text" class="form-control" id="email" name="CommenterEmail" placeholder="Enter email address" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter email address'">
                       </div>
                     </div>
                     <div class="form-group">
                         <textarea class="form-control mb-10" rows="5" name="CommenterMessage" placeholder="Enter Your Message" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Your Message'"></textarea>
                     </div>
                     <!-- <a href="#" class="button submit_btn">Post Comment</a> -->

                     <div class="form-group">
                          <input type="hidden" name="FullPostId" value="<?= $FullPostId; ?>">
                          <button type="submit" name="PostComment" class="button submit_btn">Post Comment</button>
                      </div>
                 </form>
              </div>

<?php
            }

        } else {
            echo "<h2 class='text-center' style='color: #ff9907;'>No Record Found!</h2>";
        }



?>

          </div>

             <?php include_once ("inc/right-sidebar.php"); ?>

        </div>
      <!-- End Blog Post Siddebar -->
    </div>
</section>


