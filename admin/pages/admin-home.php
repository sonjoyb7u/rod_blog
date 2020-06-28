<div class="content">
    <div class="content-header">
        <!-- leftside content header -->
        <div class="leftside-content-header">
            <ul class="breadcrumbs">
                <li><i class="fa fa-home" aria-hidden="true"></i><a href="dashboard.php">Dashboard</a></li>
            </ul>
        </div>
    </div>

    <div class="row animated fadeInUp" style="margin-top: 100px;">
        <!-- <h2>Dashboard Goes Here</h2> -->
        <?php

            if(isset($_SESSION['SuccessMsg'])) { ?>

                <div><?= successMessage(); ?></div>

        <?php
            } else { ?>

                <div><?= errorMessage(); ?></div>

        <?php
            }

        ?>
            <div class="col-sm-12 col-lg-3 col-md-3">
                <div class="row">
                    <div class="panel widgetbox wbox-2 bg-lighter-2 color-light">
                        <a href="#">
                            <div class="panel-content">
                                <div class="row">
                                    <div class="col-xs-4">
                                        <span class="icon fa fa-users color-darker-2"></span>
                                    </div>
                                    <div class="col-xs-8">
                                        <h4 class="subtitle color-darker-2">Users</h4>
                                        <h1 class="title color-w">

                                            <?php
                                                echo totalUsersCount();

                                            ?>


                                        </h1>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-sm-12 col-lg-3 col-md-3">
                <div class="row">
                    <div class="panel widgetbox wbox-2 bg-lighter-2 color-light">
                        <a href="#">
                            <div class="panel-content">
                                <div class="row">
                                    <div class="col-xs-4">
                                        <span class="icon fa fa-folder-open color-darker-2"></span>
                                    </div>
                                    <div class="col-xs-8">
                                        <h4 class="subtitle color-darker-2">Categories</h4>
                                        <h1 class="title color-w">

                                            <?php
                                                echo totalCagtegoriesCount();

                                            ?>


                                        </h1>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-sm-12 col-lg-3 col-md-3">
                <div class="row">
                    <div class="panel widgetbox wbox-2 bg-lighter-2 color-light">
                        <a href="#">
                            <div class="panel-content">
                                <div class="row">
                                    <div class="col-xs-4">
                                        <span class="icon fa fa-btc color-darker-2"></span>
                                    </div>
                                    <div class="col-xs-8">
                                        <h4 class="subtitle color-darker-2">Posts</h4>
                                        <h1 class="title color-w">

                                            <?php

                                                echo totalPostsCount();

                                            ?>


                                        </h1>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-sm-12 col-lg-3 col-md-3">
                <div class="row">
                    <div class="panel widgetbox wbox-2 bg-lighter-2 color-light">
                        <a href="#">
                            <div class="panel-content">
                                <div class="row">
                                    <div class="col-xs-4">
                                        <span class="icon fa fa-comments color-darker-2"></span>
                                    </div>
                                    <div class="col-xs-8">
                                        <h4 class="subtitle color-darker-2">Comments</h4>
                                        <h1 class="title color-w">

                                            <?php

                                                echo totalCommentsCount();

                                            ?>


                                        </h1>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

    </div>

    <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
</div>