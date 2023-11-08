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
    if(isset($_POST['submit'])) {
        // Get varuable
		$name = mysqli_real_escape_string($conn, $_POST['name']);
		$email = mysqli_real_escape_string($conn, $_POST['email']);
		$pass = mysqli_real_escape_string($conn, md5($_POST['password']));
		$cpass = mysqli_real_escape_string($conn, md5($_POST['cpassword']));
        $role = mysqli_real_escape_string($conn, $_POST['role']);

		// Get image
		$image_name = $_FILES['image']['name'];
		$image_size = $_FILES['image']['size'];
		$image_tmp_name = $_FILES['image']['tmp_name'];
		$image_folder = '../assets/images/' . $image_name;

		// check if user exists
		$select = mysqli_query($conn, "SELECT * FROM `user` WHERE email='$email' AND password='$pass'") or die('query failed!');

		if(mysqli_num_rows($select) > 0) {
			$message[] = 'user already exist';
		}
		else {
			if($pass != $cpass) {
				$message[] = 'confirm password not matched!';
			}
			elseif($image_size > 5000000) {
				$message[] = 'image size is too large!';
			}
			else {
				// If all condition are pass => insert
				$insert = mysqli_query($conn, "INSERT INTO `user` (name, email, password, image, role) VALUES('$name','$email','$pass','$image_name', '$role')") or die("query failed!");

				if($insert) {
					move_uploaded_file($image_tmp_name, $image_folder);
					$message[] = 'Add user successfully';
					header("location: manage_user.php");
				}
				else {
					$message[] = 'Add user failed!';
				}
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
                <label>Name</label>
                <input type="text" class="form-control" placeholder="Enter user name" name="name" autocomplete="off">
            </div>

            <div class="form-group my-2">
                <label>Email</label>
                <input type="email" class="form-control" placeholder="Enter user email" name="email" autocomplete="off">
            </div>

            <div class="form-group my-2">
                <label>Password</label>
                <input type="password" class="form-control" placeholder="Enter your password" name="password" autocomplete="off">
            </div>

            <div class="form-group my-2">
                <label>Confirm Password</label>
                <input type="password" class="form-control" placeholder="Confirm your password" name="cpassword" autocomplete="off">
            </div>
            
            <div class="form-group my-2">
                <label>Role</label>
                <select class="form-select" name="role" aria-label="Default select example">
                    <option selected value="user">user</option>
                    <option value="admin">admin</option>
                </select>
            </div>

            <div class="form-group my-2">
                <label>Upload Image</label>
                <input type="file" class="form-control" name="image" autocomplete="off">
            </div>
            
            <button type="submit" class="btn btn-primary mt-4" name="submit">Add User</button>
        </form>
</div>
<!-- Body End -->

<!-- Footer Start -->
<?php include("../partials/footer_admin.php"); ?>
<!-- Footer End -->