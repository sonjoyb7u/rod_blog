
<?php
    if(isset($_SESSION['UserId'])) {
        redirect_to("user-dashboard.php");
    }
?>

<?php
global $conn;

extract($_POST);

if(isset($UserLogin)) {
    $Username = htmlentities($UserName, ENT_QUOTES);
    $Password = htmlentities($password, ENT_QUOTES);

    if(empty($Username) || empty($Password)) {
        $_SESSION['ErrorMsg'] = "All field must be filled out!";

    } else {
            //Function Calling from Function.php...
            userLoginInformation($Username, $Password);

    }


}

?>
<hr />
<div class="container mb-5">
    <div class="row justify-content-center">
        <div class="col-sm-12 col-md-12 col-lg-12 UserLoginBanner">
<!--            <img src="img/banner/RodImage-4.png" alt="" class="img-responsive">-->
<!--            <div class="LoginBannerOverlay"></div>-->
        </div>

            <div class="wrap UserLoginMainBox">
                <!-- page BODY -->
                <!-- ========================================================= -->
                <div class="page-body animated shake">
                    <div class="UserLoginBox">
                    <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->

                        <!--LOGO-->
                        <h2 class="text-center">ROD<>BLOG</h2>
                        <h3 class="text-center"> USER LOGIN </h3>

                        <hr />
                        <?php

                            if(isset($_SESSION['SuccessMsg'])) { ?>
                                <div><?= successMessage(); ?></div>
                        <?php

                            } else { ?>
                                <div><?= errorMessage(); ?></div>
                        <?php
                            }

                        ?>
                    <div class="box">
                        <!--SIGN IN FORM-->
                        <div class="panel mb-none">
                            <div class="panel-content bg-scale-0">
                                <form action="<?= htmlspecialchars($_SERVER['PHP_SELF'] . '?page=user-login')?>" method="post">
                                    <div class="form-group mt-md">
                                        <span class="input-with-icon">
                                            <input type="text" class="form-control" id="UserName" name="UserName" placeholder="Enter Your User Name" value="<?= isset($Username) ? $Username : ''; ?>">
                                            <i class="fa fa-user"></i>
                                        </span>
                                    </div>
                                    <div class="form-group">
                                        <span class="input-with-icon">
                                            <input type="password" class="form-control" id="password" name="password" placeholder="Enter Your Password">
                                            <i class="fa fa-key"></i>
                                        </span>
                                    </div>
                                    <div class="form-group">
                                        <div class="checkbox-custom checkbox-primary">
                                            <input type="checkbox" id="remember-me" value="option1">
                                            <label class="check" for="remember-me">Remember me</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" name="UserLogin" class="btn btn-primary form-control SignInBtn" value="Log In">
<!--                                        <a href="index.html" name="LogIn" class="btn btn-primary btn-block SignInBtn">Log In</a>-->
                                    </div>
                                    <div class="form-group text-center LogForPassRegBtn">
                                        <a href="pages_forgot-password.html">Forgot password ?</a>
                                        <hr/>
                                        <span>Don't have an account ? Please </span>
                                        <a href="<?= htmlspecialchars($_SERVER['PHP_SELF'] . '?page=user-registration')?>" class="btn btn-block mt-sm RegBtn">Registration</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
                </div>
            </div>
        </div>

    </div>
</div>




