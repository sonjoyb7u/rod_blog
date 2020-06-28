
  <!--================ Hero sm banner start =================-->
  <section class="mb-30px">
    <div class="container">
      <div class="hero-banner hero-banner--sm">
        <div class="hero-banner__content">
          <h1>Contact Us</h1>
          <nav aria-label="breadcrumb" class="banner-breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="index.php?page=blog-post">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Contact Us</li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
  </section>
  <!--================ Hero sm banner end =================-->


  <!-- ================ contact section start ================= -->
  <section class="section-margin--small section-margin">
    <div class="container">

      <!-- <div class="d-none d-sm-block mb-5 pb-4">
        <div id="map" style="height: 420px;"></div>
        <script>
          function initMap() {
            var uluru = {lat: -25.363, lng: 131.044};
            var grayStyles = [
              {
                featureType: "all",
                stylers: [
                  { saturation: -90 },
                  { lightness: 50 }
                ]
              },
              {elementType: 'labels.text.fill', stylers: [{color: '#A3A3A3'}]}
            ];
            var map = new google.maps.Map(document.getElementById('map'), {
              center: {lat: -31.197, lng: 150.744},
              zoom: 9,
              styles: grayStyles,
              scrollwheel:  false
            });
          }

        </script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDpfS1oRGreGSBU5HHjMmQ3o5NLw7VdJ6I&callback=initMap"></script>

      </div> -->


      <div class="row">
        <div class="col-md-4 col-lg-3 mb-4 mb-md-0">
          <div class="media contact-info">
            <span class="contact-info__icon"><i class="ti-home"></i></span>
            <div class="media-body">
              <h3>Chittagong, Bangladesh</h3>
              <p>93/A, Chawttashawri Road</p>
            </div>
          </div>
          <div class="media contact-info">
            <span class="contact-info__icon"><i class="ti-headphone"></i></span>
            <div class="media-body">
              <h3><a href="#">+88(01915) 464958</a></h3>
              <p>Mon to Fri 9am to 6pm</p>
            </div>
          </div>
          <div class="media contact-info">
            <span class="contact-info__icon"><i class="ti-email"></i></span>
            <div class="media-body">
              <h3><a href="#">support@webappdev.com</a></h3>
              <p>Send us your query anytime!</p>
            </div>
          </div>
        </div>

        <div class="col-md-8 col-lg-9">

          <?php

              // $FullNameErrorMsg = "";
              // $EmailErrorMsg = "";
              // $WebsiteErrorMsg = "";
              // $SubjectErrorMsg = "";


              extract($_POST);

              if(isset($sendMsg)) {

                $FullName = htmlspecialchars(userInput($fullname), ENT_QUOTES);
                $Email = htmlspecialchars(userInput($email), ENT_QUOTES);
                $Subject = htmlspecialchars(userInput($subject), ENT_QUOTES);
                $Website = htmlspecialchars(userInput($website), ENT_QUOTES);
                $Message = htmlspecialchars(userInput($message), ENT_QUOTES);

                date_default_timezone_set("Asia/Dhaka");
                $DateTime =  date("Y-M-d h:i:sA");
                
              	if(empty($FullName) || empty($Email) || empty($Subject) || empty($Website) || empty($Message)) {
              		$_SESSION['ErrorMsg'] = "All field must be filled out!";

              	} elseif(!preg_match("/^[A-Za-z. ]*$/", $FullName)) {
                    $_SESSION['ErrorMsg'] = "Only Letter, White-spaces, Dotted are allowed!";

                } elseif (!preg_match("/[A-Za-z\-._0-9]+@[A-Za-z\-._0-9]+[.]{1}[A-Za-z\-._0-9]+$/", $Email)) {
                    $_SESSION['ErrorMsg'] = "Please Enter valid format of Email address!";

              	} elseif (!preg_match("/^[A-Za-z.,\-\W ]+$/", $Subject)) {
                    $_SESSION['ErrorMsg'] = "Only Letter, White-spaces, Dotted, Comma, Dashed are allowed!";

                } elseif (!preg_match("/^(https:|ftp:)\/\/[a-zA-Z0-9.\-_\/?\$=\&\#\~`!+]+\.[a-zA-Z0-9.\-_\/?\$=                                                       \&\#\~`!]*/", $Website)) {
                    $_SESSION['ErrorMsg'] = "Enter Valid format of website URl address!";

              	} else {

                    require_once 'PHPMailer/PHPMailerAutoload.php';
        //            require_once 'SendMailProcess.php';

                    $mail = new PHPMailer();

//                    $mail->SMTPDebug = 4;                               // Enable verbose debug output

                    $mail->isSMTP();                                      // Set mailer to use SMTP
                    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
                    $mail->SMTPAuth = true;                               // Enable SMTP authentication
                    $mail->Username = 'piyal.john@gmail.com';                 // SMTP username
                    $mail->Password = 'SBJ$2911198261450286';                           // SMTP password
                    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
                    $mail->Port = 587;                                    // TCP port to connect to

                    $mail->setFrom('piyal.john@gmail.com', 'Sonjoy - WebAppDev');
                    $mail->addAddress($Email, $FullName);     // Add a recipient
        //            $mail->addAddress('ellen@example.com');               // Name is optional
                    $mail->Subject = $Subject;
                    $mail->addReplyTo('piyal.john@gmail.com');
        //
                    $mail->isHTML(true);
//                    $Url = 'http://' . $_SERVER['SERVER_NAME'] . '/rod-blog/index.php?page=confirm-email&email='.$UserEmail.'&token='.$StrToken;
                    $mail->Body    = "<div style='border: 2px solid rebeccapurple'>
                                        Hello Friend, Thank You So Much For, Contact With Us. <br><br>
                                      </div>";

                    $ConfirmMail = $mail->send();

                    if($ConfirmMail) {
                        global $conn;

                        $_SESSION['SuccessMsg'] = "Success, Message Sent to your mail, Please Check your mail";
                        $sql = "INSERT INTO `tbl_contact` (`full_name`, `email`, `website`, `message`, `datetime`) VALUES (:fullName, :emaiL, :websitE, :messagE, :dateTime)";
                        $stmt = $conn->prepare($sql);

                        $stmt->bindValue(':fullName', $FullName);
                        $stmt->bindValue(':emaiL', $Email);
                        $stmt->bindValue(':websitE', $Website);
                        $stmt->bindValue(':messagE', $Message);
                        $stmt->bindValue(':dateTime', $DateTime);

                        $ExecutedContact = $stmt->execute();

                        if($ExecutedContact) {
                            $_SESSION['SuccessMsg'] = "Success, Message Sent to your mail, Please Check your mail.";
                        } else {
                            $_SESSION['ErrorMsg'] = "Failed, Your Message was not Inserted, Try Again!";
                        }

                    } else {
                        $_SESSION['ErrorMsg'] = "Failed, Message Not Sent, Try Again!";
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

          <form action="" class="form-contact contact_form" method="post" id="contactForm" novalidate="novalidate">
            <div class="row">
              <div class="col-lg-5">
                <div class="form-group">
                  <input class="form-control" name="fullname" id="name" type="text" placeholder="Enter your Full name">
                </div>
                <div class="form-group">
                  <input class="form-control" name="email" id="email" type="text" placeholder="Enter your email address">
                </div>
                <div class="form-group">
                  <input class="form-control" name="subject" id="subject" type="text" placeholder="Enter your Subject">
                </div>
                <div class="form-group">
                  <input class="form-control" name="website" id="website" type="text" placeholder="Enter your Website">
                </div>
              </div>
              <div class="col-lg-7">
                <div class="form-group">
                    <textarea class="form-control different-control w-100" name="message" id="message" cols="30" rows="5" placeholder="Enter your Message"></textarea>
                </div>
              </div>
            </div>
            <div class="form-group text-center text-md-right mt-3">
              <button type="submit" class="button button--active button-contactForm" name="sendMsg">Send Message</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
	<!-- ================ contact section end ================= -->




  <!--================ Start Footer Area =================-->

  <!--================ End Footer Area =================-->
