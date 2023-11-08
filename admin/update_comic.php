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
                            <li><a class="dropdown-item custom-bg" href="manage_user.php?logout=<?php echo $user_id; ?>">Logout</a></li>
                        </ul>
                    </div>
                </form>
                
        </div>
    </nav>

    <!-- Add Bootstrap JavaScript and Popper.js scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- End Menu -->
<!-- Menu End -->

<!-- PHP Add start -->
<?php
    // GET Method
    $id = $_GET['updateid'];
    $sql = "SELECT * FROM `comic` WHERE id=$id";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    
    $title = $row['title'];
    $author = $row['author'];
    $descrip = $row['description'];
    $chap_num = $row['chap_num'];
    $image = $row['image'];

    if(isset($_POST['submit'])) {
        // Get varuable
		$title_comic = mysqli_real_escape_string($conn, $_POST['title']);
		$author_comic = mysqli_real_escape_string($conn, $_POST['author']);
		$descrip_comic = mysqli_real_escape_string($conn, $_POST['description']);
		$chap_num_comic = mysqli_real_escape_string($conn, $_POST['chap_num']);

		// Get image
		$image_name = $_FILES['comic_image']['name'];
		$image_size = $_FILES['comic_image']['size'];
		$image_tmp_name = $_FILES['comic_image']['tmp_name'];
		$image_folder = '../assets/comic_images/' . $image_name;

		// check if comic already exists
        if(!empty($image_name)) {
            if($image_size > 5000000) {
                $message[] = 'image size is too large!';
            }
            else {
                    // If all condition are pass => insert
                    $update = mysqli_query($conn, "UPDATE `comic` SET id='$id', author='$author_comic', description='$descrip_comic', chap_num='$chap_num_comic', image='$image_name' WHERE id=$id") or die('query failed!');

                    if($update) {
                        move_uploaded_file($image_tmp_name, $image_folder);
                        $message[] = 'Update Comic successfully';
                        header("location: manage_comic.php");
                    }
                    else {
                        $message[] = 'Update comic failed!';
                    }
            }
        }
        else {
            $update = mysqli_query($conn, "UPDATE `comic` SET id='$id', author='$author_comic', description='$descrip_comic', chap_num='$chap_num_comic' WHERE id=$id") or die('query failed!');
            if($update) {
                $message[] = 'Update comic successfully';
                header("location: manage_comic.php");
            }
            else {
                $message[] = 'Update comic failed!';
            }
        }
        
        
    }
?>
<!-- PHP Add end -->



<!-- Body Start -->
<div class="container py-5">
        <form method="post" enctype="multipart/form-data">
            <!-- start echo message to user -->
            <?php
				if(isset($message)) {
					foreach($message as $message) {
						echo '<div class="alert alert-danger" role="alert">
							'.$message.'
						</div>';
					}
				}
			?>
			<!-- end echo mesaage to user -->
            <div class="form-group my-2">
                <label>Title</label>
                <input type="text" class="form-control" value=<?php echo $title; ?> placeholder="Enter title" name="title" autocomplete="off">
            </div>

            <div class="form-group my-2">
                <label>Author</label>
                <input type="text" class="form-control" value=<?php echo $author; ?> placeholder="Enter author name" name="author" autocomplete="off">
            </div>

            <div class="form-group my-2">
                <label>Description</label>
                <textarea rows="5" cols="40" class="form-control" placeholder="Enter description" name="description" autocomplete="off"><?php echo $descrip; ?></textarea>
            </div>

            <div class="form-group my-2">
                <label>Chap_num</label>
                <input type="text" class="form-control" value=<?php echo $chap_num; ?> placeholder="Enter number of chap" name="chap_num" autocomplete="off">
            </div>

            <div class="form-group my-2">
                <label>Upload Comic Image</label>
                <input type="file" class="form-control" name="comic_image" autocomplete="off">
            </div>
            
            <button type="submit" class="btn btn-primary mt-4" name="submit">Update Comic</button>
        </form>
</div>
<!-- Body End -->

<!-- Footer Start -->
<?php include("../partials/footer_admin.php"); ?>
<!-- Footer End -->