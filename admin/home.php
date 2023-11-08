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
                            <li><a class="dropdown-item custom-bg" href="home.php?logout=<?php echo $user_id; ?>">Logout</a></li>
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
        <div class="row">
            <!-- PHP query start -->
            <?php                
                $sql = "SELECT * FROM `comic`";
                $result = mysqli_query($conn, $sql);

                if($result) {
                    while($row = mysqli_fetch_assoc($result)) {
                        $id = $row['id'];
                        $title = $row['title'];
                        $author = $row['author'];
                        $upload_date = $row['date'];
                        $image = $row['image'];
                        $image_folder = '../assets/comic_images/' . $image;

                        echo '<div class="col-lg3 col-md-3 mb-4 mb-lg-0 mt-3 mb-3">
                                <div class="card h-100">
                                    <img src="'.$image_folder.'" height="300" class="card-img-top" alt="...">
                                    <div class="card-body">
                                        <h5 class="card-title">'.$title.'</h5>
                                        <p class="card-text">Author: '.$author.'</p>
                                        <p class="card-text">Upload Date: '.$upload_date.'</p>
                                        <div class="d-flex justify-content-center">
                                            <a href="detail.php?detailid='.$id.'"><button class="btn btn-primary me-md-2" type="button">Detail</button></a>
                                        </div>
                                    </div>
                                </div>
                            </div>';
                    }
                }
            ?>
            <!-- PHP query end -->
            
            
        </div>
    </div>
<!-- Body End -->

<!-- Footer Start -->
<?php include("../partials/footer_admin.php"); ?>
<!-- Footer End -->