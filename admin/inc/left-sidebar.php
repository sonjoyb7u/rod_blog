
        <div class="left-sidebar">
            <!-- left sidebar HEADER -->
            <div class="left-sidebar-header">
                <div class="left-sidebar-title">Left Sidebar</div>
                <div class="left-sidebar-toggle c-hamburger c-hamburger--htla hidden-xs" data-toggle-class="left-sidebar-collapsed" data-target="html">
                    <span></span>
                </div>
            </div>
            <!-- NAVIGATION -->
            <!-- ========================================================= -->
            <div id="left-nav" class="nano">
                <div class="nano-content">
                    <nav>
                        <ul class="nav nav-left-lines" id="main-nav">
                            <!--HOME-->
                            <li class="<?= 'dashboard.php' ? 'active-item' : ''?>"><a href="dashboard.php"><i class="fa fa-home" aria-hidden="true"></i><span>Dashboard</span></a></li>
                            <!--CHARTS-->
                            <?php
                                if($_SESSION['Role'] == '1') { ?>

                                    <li class="has-child-item close-item <?= $page == 'add-category' ? 'open-item':''?><?= $page == 'manage-category' ? 'open-item' : '' ?>">
                                        <a><i class="fa fa-sitemap" aria-hidden="true"></i><span>Category Section</span> </a>
                                        <ul class="nav child-nav level-1">
                                            <li class="<?= $page == 'add-category' ? 'active-item' : '' ?>"><a href="dashboard.php?page=add-category">Add Category</a></li>
                                            <li class="<?= $page == 'manage-category' ? 'active-item' : '' ?>"><a href="dashboard.php?page=manage-category">Manage Category</a></li>
                                        </ul>
                                    </li>
                                    <li class="has-child-item close-item <?= $page == 'add-post' ? 'open-item':''?><?= $page == 'manage-post' ? 'open-item' : '' ?>">
                                        <a><i class="fa fa-sitemap" aria-hidden="true"></i><span>Post Section</span> </a>
                                        <ul class="nav child-nav level-1">
                                            <li class="<?= $page == 'add-post' ? 'active-item' : '' ?>"><a href="dashboard.php?page=add-post">Add Post</a></li>
                                            <li class="<?= $page == 'manage-post' ? 'active-item' : '' ?>"><a href="dashboard.php?page=manage-post">Manage Post</a></li>
                                        </ul>
                                    </li>
                                    <li class="has-child-item close-item <?= $page == 'add-comment' ? 'open-item':''?><?= $page == 'manage-comments' ? 'open-item' : '' ?> <?= $page == 'approve-comment' ? 'open-item' : '' ?>">
                                        <a><i class="fa fa-sitemap" aria-hidden="true"></i><span>Comment Section</span> </a>
                                        <ul class="nav child-nav level-1">
                                            <li class="<?= $page == 'add-comment' ? 'active-item' : '' ?>"><a href="dashboard.php?page=add-comment">Add Comment</a></li>
                                            <li class="<?= $page == 'manage-comments' ? 'active-item' : '' ?>"><a href="dashboard.php?page=manage-comments">Manage Comments</a></li>
                                        </ul>
                                    </li>
                                    <li class="has-child-item close-item <?= $page == 'add-user' ? 'open-item':''?><?= $page == 'manage-users' ? 'open-item' : '' ?> ">
                                        <a><i class="fa fa-sitemap" aria-hidden="true"></i><span>User Section</span> </a>
                                        <ul class="nav child-nav level-1">
                                            <li class="<?= $page == 'add-user' ? 'active-item' : '' ?>"><a href="dashboard.php?page=add-user">Add User</a></li>
                                            <li class="<?= $page == 'manage-users' ? 'active-item' : '' ?>"><a href="dashboard.php?page=manage-users">Manage Users</a></li>
                                        </ul>
                                    </li>
<!--                                    <li class="--><?//= $page == 'all-users' ? 'active-item' : '' ?><!--"><a href="dashboard.php?page=all-users"><i class="fa fa-sitemap" aria-hidden="true"></i><span>All Users</span></a></li>-->

                            <?php
                                } else { ?>

                                    <li class="has-child-item close-item <?= $page == 'add-post' ? 'open-item':''?><?= $page == 'manage-post' ? 'open-item' : '' ?>">
                                        <a><i class="fa fa-sitemap" aria-hidden="true"></i><span>Post</span> </a>
                                        <ul class="nav child-nav level-1">
                                            <li class="<?= $page == 'add-post' ? 'active-item' : '' ?>"><a href="dashboard.php?page=add-post">Add Post</a></li>
                                            <li class="<?= $page == 'manage-post' ? 'active-item' : '' ?>"><a href="dashboard.php?page=manage-post">Manage Post</a></li>
                                        </ul>
                                    </li>

                            <?php

                                }
                            ?>


                        </ul>
                    </nav>
                </div>
            </div>
        </div>

        <!--scroll to top-->
        <a href="#" class="scroll-to-top"><i class="fa fa-angle-double-up"></i></a>
    </div>
