
<section>
  <div class="container">
    <div class="owl-carousel owl-theme blog-slider">

<?php
    global $conn;

    $sql = "SELECT `tbl_posts`.`id`, `tbl_posts`.`cat_id`, `tbl_posts`.`post_title`, `tbl_posts`.`post_desc`, `tbl_posts`.`post_image`, `tbl_posts`.`status`, `tbl_posts`.`datetime`, `tbl_categories`.`title`, `tbl_users`.`full_name`, `tbl_users`.`role` FROM `tbl_posts`
            LEFT JOIN `tbl_categories` ON `tbl_posts`.`cat_id` = `tbl_categories`.`id`
            LEFT JOIN `tbl_users` ON `tbl_posts`.`u_id` = `tbl_users`.`user_id`
            WHERE `tbl_posts`.`status` = 1 
            ORDER BY `tbl_posts`.`id` DESC";

    $stmt = $conn->query($sql);
    while($DataRows = $stmt->fetch()) {
        $PostId1 = $DataRows['id'];
        $CatTitle1 = $DataRows['title'];
        $PostTitle1 = $DataRows['post_title'];
        $PostImage1 = $DataRows['post_image'];

?>

      <div class="card blog__slide text-center">
        <div class="blog__slide__img">
          <img class="slide-img rounded-0 img-responsive" style="height: 200px" src="admin/uploads/post-image/<?= $PostImage1; ?>" alt="<?= $PostImage1; ?>">
        </div>
        <div class="blog__slide__content">
          <a class="blog__slide__label" href="index.php?page=blog-details&FullPostId=<?= base64_encode($PostId1); ?>"><?= $CatTitle1; ?></a>
          <h3><a href="index.php?page=blog-details&FullPostId=<?= base64_encode($PostId1); ?>"><?= $PostTitle1; ?></a></h3>
<!--          <p>2 days ago</p>-->
        </div>
      </div>

<?php } ?>

    </div>
  </div>
</section>