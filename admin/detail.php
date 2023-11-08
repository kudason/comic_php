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
                            <li><a class="dropdown-item custom-bg" href="manage_comic.php?logout=<?php echo $user_id; ?>">Logout</a></li>
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
<div class="container d-flex justify-content-center py-5">
        <div class="card mb-3" style="max-width: 800px;">
            <!-- PHP query start -->
            <?php    
                $id = $_GET['detailid'];
                $sql = "SELECT * FROM `comic` WHERE id=$id";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);            
                $result = mysqli_query($conn, $sql);

                $title = $row['title'];
                $author = $row['author'];
                $upload_date = $row['date'];
                $descript = $row['description'];
                $chap_num = $row['chap_num'];
                $image = $row['image'];
                $image_folder = '../assets/comic_images/' . $image;

                echo '<div class="card" style="max-width: 800px;">
                        <div class="row">
                            <div class="col-md-4 pe-0 ">
                                <img src="'.$image_folder.'" class="img-fluid" alt="...">
                            </div>
                            <div class="col-md-8 ps-0">
                                <div class="card-body">
                                    <h4 class="card-title">'.$title.'</h4>
                                    <p class="card-text">Author: '.$author.'</p>
                                    <p class="card-text">Update date: '.$upload_date.'</p>
                                    <p class="card-text">Description: '.$descript.'</p>
                                    <p class="card-text">No of chapters: '.$chap_num.'</p>
                                </div>
                            </div>
                        </div>
                    </div>';        
                    
                
            ?>
            <!-- PHP query end -->        
            
    </div>
</div>
<!-- Body End -->


<!-- Footer Start -->
<?php include("../partials/footer_admin.php"); ?>
<!-- Footer End -->