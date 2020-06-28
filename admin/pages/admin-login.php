<?php
if(isset($_SESSION['UserId'])) {
    redirect_to("dashboard.php");
}
?>

<?php
global $conn;

extract($_POST);

if(isset($SignIn)) {
    $UserEmail = trim(htmlentities($UserEmail, ENT_QUOTES));
    $Password = trim(htmlentities($password, ENT_QUOTES));

    if(empty($UserEmail) || empty($Password)) {
        $_SESSION['ErrorMsg'] = "All field must be filled out!";

    } else {
        //Function Calling from Function.php...
        adminUserLoginInformation($UserEmail, $Password);

    }

}

?>

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="blog-banner">
            <div class="admin-login">
                <img src="./../img/banner/RodImage-4.png" alt="" class="img-responsive">
                <div class="banner-overlay"></div>
            </div>
            <!-- <div  id="lib-std"></div> -->
            <div id="particles-banner"></div>

            <div class="wrap lib-login">
<!--                <div class="col-md-12">-->
                    <!-- page BODY -->
                    <!-- ========================================================= -->
                    <div class="page-body animated slideInDown">
                        <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
                        <!--LOGO-->
                        <div class="logo lib-logo">
                            <!--            <img alt="logo" src="./../assets/images/logo-dark.png" />-->
                            <h2 class="text-center" style="font-weight: bold">ROD<>BLOG</h2>
                            <h3 class="text-center" style="font-weight: bold"> ADMIN LOGIN </h3>

                        </div>
                        <div class="box col-md-4 col-lg-4 col-md-offset-4 col-lg-offset-4 admin-login-box">
                            <?php

                                if(isset($_SESSION['SuccessMsg'])) { ?>
                                    <div><?= successMessage(); ?></div>
                                    <?php
                                } else { ?>
                                    <div><?= errorMessage(); ?></div>
                                    <?php
                                }

                            ?>

                            <!--SIGN IN FORM-->
                            <div class="panel mb-none">
                                <div class="panel-content bg-scale-0">
                                    <form action="<?= $_SERVER['PHP_SELF']; ?>" method="post">
                                        <div class="form-group">
                                        <span class="input-with-icon">
                                            <input type="text" class="form-control" id="UserEmail" placeholder="Enter User Name" name="UserEmail" value="<?= isset($UserEmail) ? $UserEmail : ''?>">
                                            <span class="input-group-prepend" style="">
                                                <span class="input-group-text"><i class="fa fa-user"></i>
                                                </span>
                                                <!-- <span class="input-group-text">
                                                <i class="fa fa-user"></i>
                                                </span> -->
                                            </span>
                                        </span>
                                        </div>
                                        <div class="form-group">
                                    <span class="input-with-icon">
                                        <input type="password" class="form-control" id="password" placeholder="Enter Password" name="password" value="<?= isset($Password) ? $Password : ''; ?>">
                                        <i class="fa fa-key"></i>
                                    </span>
                                        </div>
                                        <div class="form-group">
                                            <div class="checkbox-custom checkbox-primary">
                                                <input type="checkbox" id="remember-me" name="remember" value="remember">
                                                <label class="check" for="remember-me">Remember me</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input type="submit" class="btn btn-primary btn-block" name="SignIn" value="Sign in">
                                        </div>
                                        <div class="form-group text-center LogForPassRegBtn">
                                            <a href="#">Forgot password ?</a>
                                            <hr/>
                                            <span>Don't have an account ? Please </span>
                                            <a href="<?= htmlspecialchars($_SERVER['PHP_SELF'].'?page=admin-registration')?>" class="btn btn-block mt-sm RegBtn">Registration</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
                    </div>
<!--                </div>-->
            </div>

        </div>
    </div>
</div>