<?php
if($_SESSION['Role'] == '2' || $_SESSION['Role'] == '3') {
    redirect_to('dashboard.php');
}

?>

    <!-- CONTENT -->
    <!-- ========================================================= -->
    <div class="content">
        <!-- content HEADER -->
        <!-- ========================================================= -->
        <div class="content-header">
            <!-- leftside content header -->
            <div class="leftside-content-header">
                <ul class="breadcrumbs">
                    <li><i class="fa fa-home" aria-hidden="true"></i><a href="#">Dashboard</a></li>
                    <li><a href="javascript:avoid(0)">Manage Category</a></li>
                </ul>
            </div>
        </div>
        <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
<?php
echo errorMessage();
echo successMessage();
?>
        <div class="row animated fadeInUp" style="margin-top: 40px;">
            <div class="col-sm-12 col-lg-12">
                <!-- <div class="row"> -->
                        <h4 class="section-subtitle"><b>All Category Manage : </b></h4>
                        <div class="panel">
                            <div class="panel-content">
                                <div class="table-responsive">
                                    <table class="data-table table table-striped table-hover table-bordered text-center" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>Sl No.</th>
                                                <th>Category Title</th>
                                                <th>Author</th>
                                                <th>Date & Time</th>
                                                <th style="width: 100px;">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>


    <?php

    global $conn;
    $sql = "SELECT * FROM `tbl_categories` ORDER BY `id` DESC";
    $stmt = $conn->query($sql);

    $sl = 0;

    while($DataRows = $stmt->fetch()) {
    $sl++;
    $CatId = $DataRows['id'];
    $CatTitle = html_entity_decode($DataRows['title'], ENT_QUOTES);
    $Author = html_entity_decode($DataRows['author'], ENT_QUOTES);
    $DateTime = html_entity_decode($DataRows['datetime'], ENT_QUOTES);

    ?>
                                            <tr>
                                                <td><?= $sl; ?></td>
                                                <td><?= $CatTitle; ?></td>
                                                <td>
                                                    <?php
                                                        if(strlen($Author) > 3) {
                                                                $Author = substr($Author, 0, 8)."..";
                                                                echo $Author;
                                                            }
                                                    ?>
                                                </td>
                                                <td><?= $DateTime; ?></td>
                                                <td>
                                                    <div class="btn-group btn-group-md">
                                                        <a href="dashboard.php?page=edit-cat&EditCatId=<?= base64_encode($CatId); ?>" type="submit" class="btn btn-primary" style="margin-right: 3px;"><i class="fa fa-pencil"></i>
                                                        </a>
                                                        <a href="dashboard.php?page=delete-cat&DeleteCatId=<?= base64_encode($CatId); ?>" type="submit" class="btn btn-danger"><i class="fa fa-trash"></i>
                                                        </a>
                                                    </div>
                                                </td>

                                            </tr>
    <?php } ?>
                                        </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                <!-- </div> -->

            </div>
        </div>
        <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
    </div>
