
<!-- Start Blog Post Sidebar -->
<div class="col-lg-4 sidebar-widgets">
  <div class="widget-wrap">
      <?php
      //Using Globally Database Connection-variable previous PHP version - 5.6...
      global $conn;

      extract($_POST);

      if(isset($EmailSend)) {
          $UserEmail = strtolower(htmlentities($Useremail, ENT_QUOTES));
          date_default_timezone_set("Asia/Dhaka");
          $DateTime = date("Y-M-d h:i:sA");

          if(empty($UserEmail)) {
              $_SESSION['ErrorMsg'] = "All field must be filled out!";

          } elseif(!preg_match("/^[A-Za-z._0-9]+@[A-Za-z._0-9]+[.]{1}[A-Za-z._0-9]+$/", $UserEmail)) {
              $_SESSION['ErrorMsg'] = "Please Enter valid Email Address!";

          } else {
              require_once 'PHPMailer/PHPMailerAutoload.php';
////            require_once 'SendMailProcess.php';
//
              $mail = new PHPMailer();
//
//            $mail->SMTPDebug = 4;                               // Enable verbose debug output
//
              $mail->isSMTP();                                      // Set mailer to use SMTP
              $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
              $mail->SMTPAuth = true;                               // Enable SMTP authentication
              $mail->Username = 'piyal.john@gmail.com';                 // SMTP username
              $mail->Password = 'SBJ$2911198261450286';                           // SMTP password
              $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
              $mail->Port = 587;                                    // TCP port to connect to
//
              $mail->setFrom('piyal.john@gmail.com', 'Sonjoy-WebAppDev');
              $mail->addAddress($UserEmail);     // Add a recipient
////            $mail->addAddress('ellen@example.com');               // Name is optional
              $mail->Subject = 'Subscribed your Email.';
              $mail->addReplyTo('piyal.john@gmail.com');
////
              $mail->isHTML(true);
              $mail->Body    = "<div style='border: 2px solid rebeccapurple'>
                                Hi - Guys, Thanks to stay touched with Us : <br><br>

                              </div>";

              $mail->send();

              $sql = "INSERT INTO `tbl_newsletter`(`email`, `datetime`) VALUES (:userEmail, :dateTime)";
              $stmt = $conn->prepare($sql);

              $stmt->bindValue(':userEmail', $UserEmail);
              $stmt->bindValue(':dateTime', $DateTime);

              $ExecutedData = $stmt->execute();

              if($ExecutedData) {
                  $_SESSION['SuccessMsg'] = "Success, Your Subscription has been Completed, Check Your Email for Confirm Subscription!";
                  redirect_to("index.php");

              } else {
                  $_SESSION['ErrorMsg'] = "Something wrong, Your Subscription was not Completed!";

              }

          }

      }

      ?>

      <form action="<?= $_SERVER['PHP_SELF']; ?>" method="post">
        <div class="single-sidebar-widget newsletter-widget">
          <h4 class="single-sidebar-widget__title">Newsletter</h4>
          <div class="form-group mt-30">
            <div class="col-autos">
              <input type="text" name="Useremail" class="form-control" id="inlineFormInputGroup" placeholder="Enter email" onfocus="this.placeholder = ''"
                onblur="this.placeholder = 'Enter email'">
            </div>
          </div>
          <button type="submit" name="EmailSend" class="bbtns d-block mt-20 w-100">Subscribe</button>
        </div>
      </form>


    <!-- <div class="single-sidebar-widget post-category-widget">
      <h4 class="single-sidebar-widget__title">All Category : </h4>
      <ul class="cat-list mt-20"> -->

      <div class="single-sidebar-widget tag_cloud_widget p-2">
        <h4 class="single-sidebar-widget__title">All Category : </h4>
        <ul class="list">

<?php

global $conn;
$sql = "SELECT * FROM `tbl_posts`
        LEFT JOIN `tbl_categories` ON `tbl_posts`.`cat_id` = `tbl_categories`.`id`
        WHERE `tbl_categories`.`total_posts` > 0 AND `tbl_posts`.`status` = 1
        ORDER BY `tbl_categories`.`title` ASC";
$stmt = $conn->query($sql);

while($DataRows = $stmt->fetch()) {
  $CatId = $DataRows['id'];
  $CatTitle = $DataRows['title'];
  $TotalPosts = $DataRows['total_posts'];

?> 

        <li>
          <!-- <a href="#" class="d-flex justify-content-between"> -->
          <a href="index.php?page=category&CatTitle=<?= $CatTitle; ?>">
            <p><?= $CatTitle; ?><span style="margin-left: 5px !important;">(<?= $TotalPosts; ?>)</span></p>

          </a>
        </li>

<?php } ?>

      </ul>
    </div>

    <div class="single-sidebar-widget popular-post-widget">
      <h4 class="single-sidebar-widget__title">Recent Post : </h4>
      <div class="popular-post-list">

      <?php
        global $conn;
        $sql = "SELECT `tbl_posts`.`id`, `tbl_posts`.`u_id`, `tbl_posts`.`cat_id`, `tbl_posts`.`post_title`, `tbl_posts`.`post_desc`, `tbl_posts`.`post_image`, `tbl_posts`.`status`, `tbl_posts`.`datetime`, `tbl_categories`.`title`, `tbl_users`.`full_name`, `tbl_users`.`user_image`, `tbl_users`.`role` FROM `tbl_posts`
            LEFT JOIN `tbl_categories` ON `tbl_posts`.`cat_id` = `tbl_categories`.`id`
            LEFT JOIN `tbl_users` ON `tbl_posts`.`u_id` = `tbl_users`.`user_id` ORDER BY `tbl_posts`.`id` DESC LIMIT 0, 3";
        $stmt = $conn->query($sql);

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
            $UserImage = html_entity_decode($DataRows['user_image'], ENT_QUOTES);

      ?>

        <div class="single-post-list">
          <div class="thumb">
            <img width="300px" height="140px" class="card-img rounded-0" src="admin/uploads/post-image/<?= htmlentities($PostImage, ENT_QUOTES); ?>" alt="<?= htmlentities($PostImage, ENT_QUOTES); ?>">
            <ul class="thumb-info">
              <li><a href="index.php?page=blog-details&FullPostId=<?= base64_encode($PostId); ?>"><?= htmlentities($UserAuthor, ENT_QUOTES); ?></a></li>
              <li><a href="index.php?page=blog-details&FullPostId=<?= base64_encode($PostId); ?>" class="small"><?= htmlentities($DateTime, ENT_QUOTES); ?></a></li>
            </ul>
          </div>
          <div class="details">
            <a href="index.php?page=blog-details&FullPostId=<?= base64_encode($PostId); ?>">
              <h6><?= htmlentities($CatTitle, ENT_QUOTES); ?> Related</h6>
            </a>
          </div>
        </div>

         <?php  } ?>

<!--        <div class="single-post-list">-->
<!--          <div class="thumb">-->
<!--            <img width="300px" height="140px" class="card-img rounded-0" src="img/blog/blog-post-image/cat-post-2.jpg" alt="">-->
<!--            <ul class="thumb-info">-->
<!--              <li><a href="#">Md. Ali</a></li>-->
<!--              <li><a href="#">Dec 15</a></li>-->
<!--            </ul>-->
<!--          </div>-->
<!--          <div class="details mt-20">-->
<!--            <a href="#">-->
<!--              <h6>Fasion Related</h6>-->
<!--            </a>-->
<!--          </div>-->
<!--        </div>-->
<!--        <div class="single-post-list">-->
<!--          <div class="thumb">-->
<!--            <img width="300px" height="140px" class="card-img rounded-0" src="img/blog/blog-post-image/cat-post-3.jpg" alt="">-->
<!--            <ul class="thumb-info">-->
<!--              <li><a href="#">Mr. Shudiptho</a></li>-->
<!--              <li><a href="#">Dec 15</a></li>-->
<!--            </ul>-->
<!--          </div>-->
<!--          <div class="details mt-20">-->
<!--            <a href="#">-->
<!--              <h6>Entertainment Related</h6>-->
<!--            </a>-->
<!--          </div>-->
<!--        </div>-->
      </div>
    </div>

      <div class="single-sidebar-widget tag_cloud_widget">
        <h4 class="single-sidebar-widget__title">Post Tags : </h4>
        <ul class="list">

<?php
global $conn;
$sql = "SELECT * FROM `tbl_posts`
        LEFT JOIN `tbl_categories` ON `tbl_posts`.`cat_id` = `tbl_categories`.`id`
        WHERE `tbl_categories`.`total_posts` > 0 AND `tbl_posts`.`status` = 1
        ORDER BY `tbl_categories`.`title` ASC";
$stmt = $conn->query($sql);

while($DataRows = $stmt->fetch()) {
  $CatId = $DataRows['id'];
  $CatTitle = $DataRows['title'];

?>       
          <li>
              <a href="index.php?page=category&CatTitle=<?= $CatTitle; ?>"><?= $CatTitle; ?></a>
          </li>
<?php } ?>
        </ul>
      </div>
    </div>
</div>