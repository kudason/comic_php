<!-- Menu Start -->
<?php include("../partials/menu_admin.php"); ?>

<form class="d-flex me-2" action="" method="post" enctype="multipart/form-data">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-light me-2" type="submit">Search</button>
                    <div class="dropdown me-2">
                        <a href="#" id="imageDropdown" data-bs-toggle="dropdown" data-bs-reference="parent">
                            <!-- <img src="../assets/images/book.png" height="40" width="40" class="rounded-circle border border-1"> -->
                            <!-- Insert image start -->
                            <?php
                                $select = mysqli_query($conn, "SELECT * FROM `user` WHERE id='$user_id'") or die("query failed");

                                if(mysqli_num_rows($select) > 0) {
                                    $fetch = mysqli_fetch_assoc($select);
                                }
                                if($fetch['image'] == '') {
                                    echo '<img src="../assets/default_img/default-avatar.png" height="40" width="40" class="rounded-circle border border-1"/>';
                                }
                                else {
                                    echo '<img src="../assets/images/'.$fetch['image'].'" height="40" width="40" class="rounded-circle border border-1"/>';
                                }
                            ?>
                            <!-- Insert image end -->
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" role="menu" aria-labelledby="imageDropdown">
                            <li><a class="dropdown-item" href="../admin/display.php">Show Profile</a></li>
                            <li><a class="dropdown-item" href="../admin/update.php">Update</a></li>
                            <li><a class="dropdown-item custom-bg" href="dashboard.php?logout=<?php echo $user_id; ?>">Logout</a></li>
                        </ul>
                    </div>
                </form>
                
        </div>
    </nav>

    <!-- Add Bootstrap JavaScript and Popper.js scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- End Menu -->
<!-- Menu End -->

<!-- Body Start -->
<div class="container py-5">
    <div class="row row-cols-1 row-cols-md-2 g-4">
        <!-- PHP query start -->
        <?php
            $user_total_num = mysqli_query($conn, "SELECT COUNT(id) FROM `user`") or die("Query failed!");
            $user_num = mysqli_query($conn, "SELECT COUNT(id) FROM `user` WHERE role='user'") or die("Query failed!");
            $admin_num = mysqli_query($conn, "SELECT COUNT(id) FROM `user` WHERE role='admin'") or die("Query failed!");
            $comic_num = mysqli_query($conn, "SELECT COUNT(id) FROM `comic`") or die("Query failed!");
            
            if($user_total_num) {
                $count_total_user = mysqli_fetch_assoc($user_total_num);
                echo '<div class="col">
                    <div class="card h-100">
                        <div class="card-header text-center bg-success text-white fs-1">Total of users</div>
                        <div class="card-body text-center">
                            <p class="card-text fs-2">'.$count_total_user['COUNT(id)'].'</p>
                        </div>
                    </div>
                </div>';
            }

            if($user_num) {
                $count_user_role = mysqli_fetch_assoc($user_num);
                echo '<div class="col">
                        <div class="card h-100">
                            <div class="card-header text-center bg-secondary text-white fs-1">Number of user</div>
                            <div class="card-body text-center">
                                <p class="card-text fs-2">'.$count_user_role['COUNT(id)'].'</p>
                            </div>
                        </div>
                    </div>';
            }

            if($admin_num) {
                $count_admin_role = mysqli_fetch_assoc($admin_num);
                echo '<div class="col">
                        <div class="card h-100">
                            <div class="card-header text-center bg-primary text-white fs-1">Number of admin</div>
                            <div class="card-body text-center">
                                <p class="card-text fs-2">'.$count_admin_role['COUNT(id)'].'</p>
                            </div>
                        </div>
                    </div>';
            }

            if($comic_num) {
                $count_comic = mysqli_fetch_assoc($comic_num);
                echo '<div class="col">
                        <div class="card h-100">
                            <div class="card-header text-center bg-dark text-white fs-1">Number of comic</div>
                            <div class="card-body text-center">
                                <p class="card-text fs-2">'.$count_comic['COUNT(id)'].'</p>
                            </div>
                        </div>
                    </div>';
            }
            
        ?>
        <!-- PHP query end -->
        
    </div>
</div>
<!-- Body End -->

<!-- Footer Start -->
<?php include("../partials/footer_admin.php"); ?>
<!-- Footer End -->