<?php

function redirect_to($PageName) {
	header("Location: $PageName");
	exit;
}

function userInput($data) {
    return $data;
}

function checkUserNameExists($Username) {
	global $conn;

	$sql = "SELECT `user_name` FROM `tbl_users` WHERE `user_name` = :UserName";
	$stmt = $conn->prepare($sql);

	$stmt->bindValue(':UserName', $Username);
	$stmt->execute();

	$result = $stmt->rowcount();

	if($result == 1) {
		return true;
	} else {
		return false;
	}

}

function checkUserEmailExists($UserEmail) {
	global $conn;

	$sql = "SELECT `user_email` FROM `tbl_users` WHERE `user_email` = :UserEmail";
	$stmt = $conn->prepare($sql);

	$stmt->bindValue(':UserEmail', $UserEmail);
	$stmt->execute();

	$result = $stmt->rowcount();

	if($result == 1) {
		return true;
	} else {
		return false;
	}

}

function adminUserLoginInformation($UserEmail, $Password) {
    global $conn;

    $UserEmail = htmlentities($UserEmail, ENT_QUOTES);
    $Password = htmlentities($Password, ENT_QUOTES);
    $UserStatus = 1;

    $sql1 = "SELECT * FROM `tbl_users` WHERE `user_name` = :UserEmail";

    $stmt1 = $conn->prepare($sql1);

    $stmt1->bindValue(':UserEmail', $UserEmail);

    $stmt1->execute();
    $CheckData = $stmt1->rowcount();
    // var_dump($ExecuteData);
    // exit;

    if($CheckData > 0) {
        // echo "OK";
        // exit;
        while($GetRow = $stmt1->fetch()) {
            $UserId = html_entity_decode($GetRow['user_id'], ENT_QUOTES);
            $FullName = html_entity_decode($GetRow['full_name'], ENT_QUOTES);
            $UserName = html_entity_decode($GetRow['user_name'], ENT_QUOTES);
            $UEmail = html_entity_decode($GetRow['user_email'], ENT_QUOTES);
            $Password1 = html_entity_decode($GetRow['user_password'], ENT_QUOTES);
            $Status = html_entity_decode($GetRow['status'], ENT_QUOTES);
            $Role = html_entity_decode($GetRow['role'], ENT_QUOTES);

            //Syntax is : password_verify($user-input-password, $hash-password);
            $PasswordHashVerify = password_verify($Password, $Password1);

            if($PasswordHashVerify == 1 && $UserName == $UserEmail && $Status == $UserStatus) {
                // return true;
                // echo "Ok";
                $_SESSION['UserId'] = $UserId;
                $_SESSION['FullName'] = $FullName;
                $_SESSION['Role'] = $Role;
                $_SESSION['SuccessMsg'] = "Welcome, Mr. {$_SESSION['FullName']} - You Are Successfully Logged In.";
                redirect_to("dashboard.php");

            } else {
                // return false;
                // echo "Not Ok!";
                $_SESSION['ErrorMsg'] = "Need Admin Approval for Login Access!";

            }

        }

    } else {
        $_SESSION['ErrorMsg'] = "User Information's is Invalid, Please Input Valid Information!";

    }

}

function userLoginInformation($Username, $Password) {
    global $conn;

    $Username = htmlentities($Username, ENT_QUOTES);
    $Password = htmlentities($Password, ENT_QUOTES);
    $UserRole = 3;
    $UserStatus = 1;

    $sql1 = "SELECT * FROM `tbl_users` WHERE `user_name` = :UserName AND `status` = :UserStatus AND `role` = :rolE";


    $stmt1 = $conn->prepare($sql1);

    $stmt1->bindValue(':UserName', $Username);
    $stmt1->bindValue(':rolE', $UserRole);
    $stmt1->bindValue(':UserStatus', $UserStatus);

    $stmt1->execute();
    $CheckData = $stmt1->rowcount();

    if($CheckData > 0) {
        // echo "OK";
        // exit;
        while($GetRow = $stmt1->fetch()) {
            $UserId = html_entity_decode($GetRow['user_id'], ENT_QUOTES);
            $UserFullName = html_entity_decode($GetRow['full_name'], ENT_QUOTES);                       $UserName = html_entity_decode($GetRow['user_name'], ENT_QUOTES);
            $UserEmail = html_entity_decode($GetRow['user_email'], ENT_QUOTES);
            $Password1 = html_entity_decode($GetRow['user_password'], ENT_QUOTES);
            $Status = html_entity_decode($GetRow['status'], ENT_QUOTES);
            $Role = html_entity_decode($GetRow['role'], ENT_QUOTES);
//            $IsEmailConfirmed = html_entity_decode($GetRow['is_email_confirmed'], ENT_QUOTES);

            //Syntax is : password_verify($user-input-password, $hash-password);
            $PasswordHashVerify = password_verify($Password, $Password1);

            if($PasswordHashVerify == 1 && $UserName == $Username && $Status == $UserStatus && $Role == $UserRole) {
                // return true;
                // echo "Ok";
                $_SESSION['UserId'] = $UserId;
                $_SESSION['FullName'] = $UserFullName;
                $_SESSION['UserName'] = $Username;
                $_SESSION['Role'] = $Role;

                $_SESSION['SuccessMsg'] = "Welcome, Mr. {$_SESSION['FullName']} - You Are Successfully Logged In.";
                redirect_to("index.php");

            } else {
                // return false;
                // echo "Not Ok!";
                $_SESSION['ErrorMsg'] = "User Information's is Invalid, Please Input Valid Information!";

            }

        }

    } else {
        $_SESSION['ErrorMsg'] = "Need Admin Approval for Login Access!";

    }

}


function adminUserLoginConfirm() {
    if(!isset($_SESSION['UserId'])) {
        $_SESSION['ErrorMsg'] = "Login Required!";
        redirect_to("index.php");


    } else {
        return true;

    }

}


function userLoginConfirm() {
    if(!isset($_SESSION['UserId'])) {
        $_SESSION['ErrorMsg'] = "Login Required!";
        redirect_to("index.php");


    } else {
        return true;
    }

}


function addPost($UserId, $UserRole, $CatTitle, $PostTitle, $PostDesc, $PostImage) {

    $CatTitle = htmlentities(userInput($CatTitle), ENT_QUOTES);
    $PostTitle = htmlentities(userInput($PostTitle), ENT_QUOTES);
    $PostDesc = htmlentities(userInput($PostDesc), ENT_QUOTES);

    $PostImageName = $PostImage['name'];
    $PostImageSize = $PostImage['size'];
    $PostImageType = $PostImage['type'];
    $PostImageExt = explode('.', $PostImageName);
    $PostImageExt = strtolower(end($PostImageExt));
    $ImageExt = ['jpeg', 'jpg', 'png'];
    $NewPostImageName = rand(100, 1000) . '-' . $UserRole . '-' . $PostImageName;
    $SourceDir = $PostImage['tmp_name'];
    $UploadImageDir = "./admin/uploads/post-image/" . $NewPostImageName;

    date_default_timezone_set("Asia/Dhaka");
    $DateTime =  date("Y-M-d h:i:sA");

    if(empty($CatTitle) || empty($PostTitle) || empty($PostDesc) || empty($PostImage)) {
        $_SESSION['ErrorMsg'] = "All field must be filled out!";

    } elseif (in_array($PostImageExt, $ImageExt) === false) {
        $_SESSION['ErrorMsg'] = "This Extension file not allowed, please choose a JPG, PNG file!";

    } elseif ($PostImageSize > 2097152) {
        $_SESSION['ErrorMsg'] = "Image file size must be less than 2 MB!";

    } elseif(!preg_match("/^[a-zA-Z0-9-,. ]+$/", $PostTitle)) {
        $_SESSION['ErrorMsg'] = "Post Title name used - only Letter, Number, White-spaces, Dashed are allowed!";

    } elseif(strlen($PostTitle) < 6) {
        $_SESSION['ErrorMsg'] = "Post Title name - Should be greater than 6 characters!";

    } elseif(!preg_match("/^[a-zA-Zক-য়অ-ঔৎংঃ ঁ:\-।০-৯0-9,.\'\W ]+$/", $PostDesc)) {
        $_SESSION['ErrorMsg'] = "Post Description used - only English & Bangla Letter, Number, White-spaces, Dashed are allowed!";

    } elseif(strlen($PostDesc) > 10000) {
        $_SESSION['ErrorMsg'] = "Post Description - Should be less than 9500 characters!";

    } else {

        // Query to Insert Post Data in Database...
        global $conn;

        $sql = "INSERT INTO `tbl_posts`(`u_id`, `cat_id`, `post_title`, `post_desc`, `post_image`, `datetime`) VALUES (:UserId, :CatId, :PostTitle, :PostDesc, :NewPostImageName, :DataTime);";
        $sql .= "UPDATE `tbl_categories` SET `total_posts` = `total_posts` + 1 WHERE `id` = :CategoryId";
        $stmt = $conn->prepare($sql);

        $stmt->bindValue(':UserId', $UserId);
        $stmt->bindValue(':CatId', $CatTitle);
        $stmt->bindValue(':PostTitle', $PostTitle);
        $stmt->bindValue(':PostDesc', $PostDesc);
        $stmt->bindValue(':NewPostImageName', $NewPostImageName);
        $stmt->bindValue(':DataTime', $DateTime);

        $stmt->bindValue(':CategoryId', $CatTitle);

        $ExecuteData = $stmt->execute();

        move_uploaded_file($SourceDir, $UploadImageDir);

        if($ExecuteData) {
            $_SESSION['SuccessMsg'] = "Success, Post Data with id - {$conn->lastInsertId()} inserted";
            redirect_to("user-dashboard.php?page=user-manage-post");

        } else {
            $_SESSION['ErrorMsg'] = "Something went wrong, Post Data not inserted!";

        }


    }

}


function addUserPost($UserId, $UserRole, $CatTitle, $PostTitle, $PostDesc, $PostImage) {

    $CatTitle = htmlentities(userInput($CatTitle), ENT_QUOTES);
    $PostTitle = htmlentities(userInput($PostTitle), ENT_QUOTES);
    $PostDesc = htmlentities(userInput($PostDesc), ENT_QUOTES);

    $PostImageName = $PostImage['name'];
    $PostImageSize = $PostImage['size'];
    $PostImageType = $PostImage['type'];
    $PostImageExt = explode('.', $PostImageName);
    $PostImageExt = strtolower(end($PostImageExt));
    $ImageExt = ['jpeg', 'jpg', 'png'];
    $NewPostImageName = rand(100, 1000) . '-' . $UserRole . '-' . $PostImageName;
    $SourceDir = $PostImage['tmp_name'];
    $UploadImageDir = "./admin/uploads/post-image/" . $NewPostImageName;

    date_default_timezone_set("Asia/Dhaka");
    $DateTime =  date("Y-M-d h:i:sA");

    if(empty($CatTitle) || empty($PostTitle) || empty($PostDesc) || empty($PostImage)) {
        $_SESSION['ErrorMsg'] = "All field must be filled out!";

    } elseif (in_array($PostImageExt, $ImageExt) === false) {
        $_SESSION['ErrorMsg'] = "This Extension file not allowed, please choose a JPG, PNG file!";

    } elseif ($PostImageSize > 2097152) {
        $_SESSION['ErrorMsg'] = "Image file size must be less than 2 MB!";

    } elseif(!preg_match("/^[a-zA-Z0-9-,. ]+$/", $PostTitle)) {
        $_SESSION['ErrorMsg'] = "Post Title name used - only Letter, Number, White-spaces, Dashed are allowed!";

    } elseif(strlen($PostTitle) < 6) {
        $_SESSION['ErrorMsg'] = "Post Title name - Should be greater than 6 characters!";

    } elseif(!preg_match("/^[a-zA-Zক-য়অ-ঔৎংঃ ঁ:\-।০-৯0-9,.\'\W ]+$/", $PostDesc)) {
        $_SESSION['ErrorMsg'] = "Post Description used - only English & Bangla Letter, Number, White-spaces, Dashed are allowed!";

    } elseif(strlen($PostDesc) > 10000) {
        $_SESSION['ErrorMsg'] = "Post Description - Should be less than 9500 characters!";

    } else {

        // Query to Insert Post Data in Database...
        global $conn;

        $sql = "INSERT INTO `tbl_posts`(`u_id`, `cat_id`, `post_title`, `post_desc`, `post_image`, `datetime`) VALUES (:UserId, :CatId, :PostTitle, :PostDesc, :NewPostImageName, :DataTime);";
        $sql .= "UPDATE `tbl_categories` SET `total_posts` = `total_posts` + 1 WHERE `id` = :CategoryId";
        $stmt = $conn->prepare($sql);

        $stmt->bindValue(':UserId', $UserId);
        $stmt->bindValue(':CatId', $CatTitle);
        $stmt->bindValue(':PostTitle', $PostTitle);
        $stmt->bindValue(':PostDesc', $PostDesc);
        $stmt->bindValue(':NewPostImageName', $NewPostImageName);
        $stmt->bindValue(':DataTime', $DateTime);

        $stmt->bindValue(':CategoryId', $CatTitle);

        $ExecuteData = $stmt->execute();

        move_uploaded_file($SourceDir, $UploadImageDir);

        if($ExecuteData) {
            $_SESSION['SuccessMsg'] = "Success, Post Data with id - {$conn->lastInsertId()} inserted, Please Need To Admin Approval For Published!";
            redirect_to("user-dashboard.php?page=user-manage-post");

        } else {
            $_SESSION['ErrorMsg'] = "Something went wrong, Post Data not inserted!";

        }


    }
}


function updatePost($PostId, $CatTitle, $PostTitle, $PostDesc, $PostImage, $PostImages) {

    $PostId = htmlentities(userInput($PostId), ENT_QUOTES);
    $CatTitle = htmlentities(userInput($CatTitle), ENT_QUOTES);
//    $UAuthor = htmlentities(userInput($UAuthor), ENT_QUOTES);
    $PostTitle = htmlentities(userInput($PostTitle), ENT_QUOTES);
    $PostDesc = htmlentities(userInput($PostDesc), ENT_QUOTES);

    $PostImageName = $PostImage['name'];
    $PostImageSize = $PostImage['size'];
    $SourceDir = $PostImage['tmp_name'];
    $PostImageType = $PostImage['type'];

    date_default_timezone_set("Asia/Dhaka");
    $DateTime =  date("Y-M-d h:i:sA");

    if(empty($CatTitle) || empty($PostTitle) || empty($PostDesc)) {
        $_SESSION['ErrorMsg'] = "All field must be field out!";

    } elseif(!preg_match("/^[a-zA-Z0-9-,. ]+$/", $PostTitle)) {
        $_SESSION['ErrorMsg'] = "Post Title name used - only Letter, Number, White-spaces, Dashed are allowed!";

    } elseif(strlen($PostTitle) < 6) {
        $_SESSION['ErrorMsg'] = "Post Title name - Should be greater than 6 characters!";

    } elseif(!preg_match("/^[a-zA-Zক-য়অ-ঔৎংঃ ঁ:\-।০-৯0-9,.\'\W ]+$/", $PostDesc)) {
        $_SESSION['ErrorMsg'] = "Post Description used - only English & Bangla Letter, Number, White-spaces, Dashed are allowed!";

    } elseif(strlen($PostDesc) > 10000) {
        $_SESSION['ErrorMsg'] = "Post Description - Should be less than 9500 characters!";

    } else {
        // Query to Insert Post Data in Database...
        global $conn;

        if(isset($PostImageName) && !empty($PostImageName)) {

            $PostImageExt = explode('.', $PostImageName);
            $PostImageExt = end($PostImageExt);
            $ImageExt = ['jpeg', 'jpg', 'png'];
            $NewPostImageName = rand(100, 1000) . '-' . $CatTitle . '-' . $PostImageName;
            $UploadImageDir = "./uploads/post-image/" . $NewPostImageName;

            if (in_array($PostImageExt, $ImageExt) === false) {
                $_SESSION['ErrorMsg'] = "This Extension file not allowed, please choose a JPG, PNG file!";

            } elseif ($PostImageSize > 2097152) {
                $_SESSION['ErrorMsg'] = "Image file size must be less than 2 MB!";

            } else {
                $TargetDir = "./uploads/post-image/" . $PostImages;
                unlink($TargetDir);

                $sql = "UPDATE `tbl_posts` SET `cat_id`=$CatTitle, `post_title`='$PostTitle',`post_desc`='$PostDesc',`post_image`='$NewPostImageName',`datetime`='$DateTime' WHERE `id` = $PostId";

                move_uploaded_file($SourceDir, $UploadImageDir);

                $ExecuteData = $conn->query($sql);

                if($ExecuteData) {
                    $_SESSION['SuccessMsg'] = "Success, Post Data updated";
                    redirect_to('dashboard.php?page=manage-post');

                } else {
                    $_SESSION['ErrorMsg'] = "Something wrong, Post Data not updated!";

                }

            }


        } else {

            // Query to Update Post Data into Database...
            $sql = "UPDATE `tbl_posts` SET `cat_id`=$CatTitle, `post_title`='$PostTitle', `post_desc`='$PostDesc', `post_image`='$PostImages', `datetime`='$DateTime' WHERE `id` = $PostId";

            $ExecuteData = $conn->query($sql);

            if($ExecuteData) {
                $_SESSION['SuccessMsg'] = "Success, Post Data updated";
                redirect_to('dashboard.php?page=manage-post');

            } else {
                $_SESSION['ErrorMsg'] = "Something wrong, Post Data not updated!";
                redirect_to('dashboard.php?page=manage-post');
            }

        }

    }

}


function updateUserProfile() {

}


function totalPostsCount() {
    global $conn;
    $sql = "SELECT count(*) FROM `tbl_posts`";
    $stmt = $conn->query($sql);
    $TotalRows = $stmt->fetch();
//    print_r($TotalRows);

    $TotalPosts = array_shift($TotalRows);
    return $TotalPosts;

}

function totalUsersCount() {
    global $conn;
    $sql = "SELECT count(*) FROM `tbl_users`";
    $stmt = $conn->query($sql);
    $TotalRows = $stmt->fetch();
//     print_r($TotalRows);
//    exit();

    $TotalUsers = array_shift($TotalRows);
    return $TotalUsers;

}

function totalCagtegoriesCount() {
    global $conn;
    $sql = "SELECT count(*) FROM `tbl_categories`";
    $stmt = $conn->query($sql);
    $TotalRows = $stmt->fetch();
//    print_r($TotalRows);

    $TotalCategories = array_shift($TotalRows);
    return $TotalCategories;

}

function totalCommentsCount() {
    global $conn;
    $sql = "SELECT count(*) FROM `tbl_comments`";
    $stmt = $conn->query($sql);
    $TotalRows = $stmt->fetch();
//    print_r($TotalRows);

    $TotalComments = array_shift($TotalRows);
    return $TotalComments;

}

function approveCommentsByPost($PostId) {
    global $conn;

    $sql1 = "SELECT COUNT(*) from `tbl_comments` WHERE `post_id` = '$PostId' AND `status` = 1";
    $stmt1 = $conn->query($sql1);
    $TotalCommentsApprove = $stmt1->fetch();
    $TotalCommentsApproveCount = array_shift($TotalCommentsApprove);

    return $TotalCommentsApproveCount;
}

function disApproveCommentsByPost($PostId) {
    global $conn;

    $sql2 = "SELECT COUNT(*) from `tbl_comments` WHERE `post_id` = '$PostId' AND `status` = 0";
    $stmt2 = $conn->query($sql2);
    $TotalCommentsDisApprove = $stmt2->fetch();
    $TotalCommentsDisApproveCount = array_shift($TotalCommentsDisApprove);

    return $TotalCommentsDisApproveCount;
}




?>