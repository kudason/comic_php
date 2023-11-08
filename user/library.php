<!-- Menu Start -->
<?php include("../partials/menu_user.php"); ?>

<form class="d-flex me-2" action="" method="post" enctype="multipart/form-data">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-light me-2" type="submit">Search</button>
                    <div class="dropdown me-2">
                        <a href="#" id="imageDropdown" data-bs-toggle="dropdown" data-bs-reference="parent">
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
                            <li><a class="dropdown-item" href="../user/display.php">Show Profile</a></li>
                            <li><a class="dropdown-item" href="../user/update.php">Update</a></li>
                            <li><a class="dropdown-item custom-bg" href="library.php?logout=<?php echo $user_id; ?>">Logout</a></li>
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
<!-- HTML part -->
<div class="container py-5">
    <div class="row">
        <?php
            // Include your database connection code here

            // Check if the request is to add a comic to the library
            if (isset($_GET['libraryid']) && isset($_GET['userid'])) {
                $comic_id = $_GET['libraryid'];
                $user_id = $_GET['userid'];

                // Check if the value already exists in the library
                $checkSql = "SELECT * FROM `library` WHERE user_id = ? AND comic_id = ?";
                $checkStmt = $conn->prepare($checkSql);
                $checkStmt->bind_param("ii", $user_id, $comic_id);
                $checkStmt->execute();
                $checkResult = $checkStmt->get_result();

                if ($checkResult->num_rows == 0) {
                    // Insert the value into the library
                    $insertSql = "INSERT IGNORE INTO `library` (`user_id`, `comic_id`) VALUES(?, ?)";
                    $insertStmt = $conn->prepare($insertSql);
                    $insertStmt->bind_param("ii", $user_id, $comic_id);

                    if ($insertStmt->execute()) {
                        echo '<div class="alert alert-success" role="alert">Add Success.</div>';
                    } else {
                        echo '<div class="alert alert-danger" role="alert">Add failed.</div>';
                    }
                } else {
                    echo '<div class="alert alert-danger" role="alert">Comic already exists!</div>';
                }
            }

            // Fetch comics from the library
            $selectSql = "SELECT * 
                FROM `comic` 
                INNER JOIN `library` ON comic.id = library.comic_id 
                WHERE library.user_id = ?";
            $selectStmt = $conn->prepare($selectSql);
            $selectStmt->bind_param("i", $user_id);
            $selectStmt->execute();
            $selectResult = $selectStmt->get_result();
            
                while ($row = $selectResult->fetch_assoc()) {
                $id = $row['id'];
                $comic_id = $row['comic_id'];
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
                                            <a href="detail.php?detailid='.$comic_id.'"><button class="btn btn-primary me-md-2" type="button">Detail</button></a>
                                            <a href="delete_library.php?deleteid='.$id.'"><button class="btn btn-danger me-md-2" type="button">Delete from library</button></a>
                                        </div>
                                    </div>
                                </div>
                            </div>';
                }
            
            
        ?>
    </div>
</div>

<!-- Body End -->

<!-- Footer Start -->
<?php include("../partials/footer_user.php"); ?>
<!-- Footer End -->