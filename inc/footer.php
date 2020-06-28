 <footer class="footer-area section-padding">
    <div class="container">
      <div class="row">
        <div class="col-lg-3  col-md-6 col-sm-6">
          <div class="single-footer-widget">
            <h6>About Us</h6>
            <p>
              Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore dolore
              magna aliqua.
            </p>
          </div>
        </div>
        <div class="col-lg-4  col-md-6 col-sm-6">

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

                    $ExecutedData = $stmt1->execute();

                    if($ExecutedData) {
                        $_SESSION['SuccessMsg'] = "Success, Your Subscription has been Completed, Check Your Email for Confirm Subscription!";
                        redirect_to("index.php");

                    } else {
                        $_SESSION['ErrorMsg'] = "Something wrong, Your Subscription was not Completed!";

                    }

                }

            }

            ?>


          <div class="single-footer-widget">
            <h6>Newsletter</h6>
            <p>Stay update with our latest</p>
              <form novalidate="true" action="<?= $_SERVER['PHP_SELF']; ?>"
                    method="post">
                <div class="" id="mc_embed_signup">
                    <div class="d-flex flex-row">

                      <input class="form-control" name="Useremail" placeholder="Enter Your Email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Yur Email'"
                        required="" type="text">


                      <button type="submit" name="EmailSend" class="click-btn btn btn-default"><span class="lnr lnr-arrow-right"></span></button>

                    </div>
                </div>
              </form>
          </div>
        </div>
        <div class="col-lg-3  col-md-6 col-sm-6">
          <div class="single-footer-widget mail-chimp">
            <h6 class="mb-20">Instragram Feed</h6>
            <ul class="instafeed d-flex flex-wrap">
              <li><img src="img/instagram/i1.jpg" alt=""></li>
              <li><img src="img/instagram/i2.jpg" alt=""></li>
              <li><img src="img/instagram/i3.jpg" alt=""></li>
              <li><img src="img/instagram/i4.jpg" alt=""></li>
              <li><img src="img/instagram/i5.jpg" alt=""></li>
              <li><img src="img/instagram/i6.jpg" alt=""></li>
              <li><img src="img/instagram/i7.jpg" alt=""></li>
              <li><img src="img/instagram/i8.jpg" alt=""></li>
            </ul>
          </div>
        </div>
        <div class="col-lg-2 col-md-6 col-sm-6">
          <div class="single-footer-widget">
            <h6>Follow Us</h6>
            <p>Let us be social</p>
            <div class="footer-social d-flex align-items-center">
              <a href="#">
                <i class="fab fa-facebook-f"></i>
              </a>
              <a href="#">
                <i class="fab fa-twitter"></i>
              </a>
              <a href="#">
                <i class="fab fa-linkedin"></i>
              </a>
              <a href="#">
                <i class="fab fa-behance"></i>
              </a>
            </div>
          </div>
        </div>
      </div>
      <div class="footer-bottom d-flex justify-content-center align-items-center flex-wrap">
        <p class="footer-text m-0"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart" aria-hidden="true"></i> by <a href="http://webappdev.epizy.com" target="_blank">Sonjoy-WebAppDev</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
      </div>
    </div>
</footer>
