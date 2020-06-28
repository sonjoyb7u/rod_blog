
  <header class="header_area">
    <div class="navbar_fixed main_menu">
      <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container box_1620">
          <!-- Brand and toggle get grouped for better mobile display -->
          <a class="navbar-brand logo_h" href="index.php"><img src="./img/logo/rod-blog-logo-1.png" alt=""></a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
            <ul class="nav navbar-nav menu_nav justify-content-center">
                  <li class="nav-item
                  <?php if($page == 'index'){
                      echo 'active';
                  } else{
                      $page == 'blog-post';
                      echo 'active';
                  }?>"><a class="nav-link" href="index.php?page=blog-post">Home</a></li>
                  <li class="nav-item <?php if($page == 'about-us'){ echo 'active';}?>"><a class="nav-link" href="index.php?page=about-us">About Us</a></li>
                  <li class="nav-item <?php if($page == 'category'){ echo 'active';}?>"><a class="nav-link" href="index.php?page=category">Category</a>
                <li class="nav-item <?php if($page == 'contact'){ echo 'active';}?>"><a class="nav-link" href="index.php?page=contact">Contact</a></li>
                <li class="nav-item <?php if($page == 'user-login'){ echo 'active';} elseif(($page == 'user-registration')){ echo 'active'; }?> submenu dropdown">
                    <?php

                    if(isset($_SESSION['UserId'])) { ?>
                        <a href="<?= htmlspecialchars($_SERVER['PHP_SELF'] . '?page=user-login')?>" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-user"></i>&nbsp;&nbsp;<?= $_SESSION['FullName']; ?>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="nav-item <?php if($page == "user-dashboard"){ echo 'active';}?>"><a target="_blank" class="nav-link" href="user-dashboard.php?page=user-home">DashBoard</a></li>
                            <li class="nav-item <?php if($page == "user-logout"){ echo 'active';}?>"><a class="nav-link" href="index.php?page=user-logout&logout=<?= base64_encode($_SESSION['UserId']); ?>">Logout</a></li>
                        </ul>

                    <?php

                        } else { ?>

                            <a href="<?= htmlspecialchars($_SERVER['PHP_SELF'] . '?page=user-login')?>" class="nav-link" role="button" aria-haspopup="true" aria-expanded="false">
                                Log In
                            </a>

                    <?php

                        }

                    ?>

                </li>

            </ul>
            <ul class="nav navbar-nav navbar-right">
              <form class="form-inline mr-5" action="" method="post">
                <div class="form-group SearchBtn">
                  <input class="form-control" type="text" name="SearchPost" placeholder="Search your blog post" style="height: 31px;">
                  <input type="submit" name="Search" class="btn btn-sm ml-1" value="Go" style="background-color: #ff9907; color: #fff; margin-top: 10px;">
                </div>
              </form>
            </ul>
            <ul class="nav navbar-nav navbar-right navbar-social">
              <li><a href="https://www.facebook.com/sonjoy.john"><i class="ti-facebook"></i></a></li>
              <li><a href="#"><i class="ti-twitter-alt"></i></a></li>
              <li><a href="#"><i class="ti-skype"></i></a></li>
            </ul>
          </div>
        </div>
      </nav>
    </div>

  </header>


  <?php

  if(isset($_SESSION['SuccessMsg'])) { ?>
      <span class=""><?= successMessage(); ?></span>
      <?php
  } else { ?>
      <span class=""><?= errorMessage(); ?></span>
      <?php
  }

  ?>


