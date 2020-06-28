
<div class="left-sidebar">
<!--     left sidebar HEADER -->
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
                    <li class="<?= 'user-dashboard.php' ? 'active-item' : ''?>"><a href="user-dashboard.php"><i class="fa fa-home" aria-hidden="true"></i><span>Dashboard</span></a></li>
                    <!--CHARTS-->
                    <li class="has-child-item close-item <?= $page == 'user-add-post' ? 'open-item':''?><?= $page == 'user-manage-post' ? 'open-item' : '' ?>">
                        <a><i class="fa fa-sitemap" aria-hidden="true"></i><span>User Post</span> </a>
                        <ul class="nav child-nav level-1">
                            <li class="<?= $page == 'user-add-post' ? 'active-item' : '' ?>"><a href="user-dashboard.php?page=user-add-post">Add Your Post</a></li>
                            <li class="<?= $page == 'user-manage-post' ? 'active-item' : '' ?>"><a href="user-dashboard.php?page=user-manage-post">Manage Your Post</a></li>
                        </ul>
                    </li>
                    <li class="has-child-item close-item <?= $page == 'user-update-profile' ? 'open-item':''?>">
                        <a><i class="fa fa-sitemap" aria-hidden="true"></i><span>User Profile</span> </a>
                        <ul class="nav child-nav level-1">
                            <li class="<?= $page == 'user-update-profile' ? 'active-item' : '' ?>"><a href="user-dashboard.php?page=user-update-profile">Update Profile</a></li>
<!--                            <li class="--><?//= $page == 'user-manage-post' ? 'active-item' : '' ?><!--"><a href="user-dashboard.php?page=user-manage-post">Manage Your Post</a></li>-->
                        </ul>
                    </li>

                </ul>
            </nav>
        </div>
    </div>
</div>

<!--scroll to top-->
<a href="#" class="scroll-to-top"><i class="fa fa-angle-double-up"></i></a>
</div>
