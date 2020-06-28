<div class="content">
    <div class="content-header">
        <!-- leftside content header -->
        <div class="leftside-content-header">
            <ul class="breadcrumbs">
                <li><i class="fa fa-home" aria-hidden="true"></i><a href="user-dashboard.php">Dashboard</a></li>
            </ul>
        </div>
    </div>

    <?php
        if(isset($_SESSION['UserId'])) { ?>
            <div style="margin-top: 80px;"><?= successMessage(); ?></div>
    <?php
        } else { ?>
           <div style="margin-top: 80px;"><?= errorMessage(); ?></div>
    <?php
        }

    ?>

    <div class="row animated fadeInUp" style="margin-top: 60px;">
       <h2 class="text-center">WelCome, <b><?= $_SESSION['FullName']; ?></b></h2>
    </div>

</div>