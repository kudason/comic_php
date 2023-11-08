<!-- Menu Start -->
<?php include("../partials/menu_admin.php"); ?>

<?php include("delete_user.php"); ?>

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

<!-- Body Start -->
<div class="container py-5">
<a href="add_user.php" class="text-light"><button class="btn btn-primary my-5">Add user</button></a>
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
        <table class="table">
            <thead class="table-success">
                <tr>
                    <th scope="col">Sl no</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Password</th>
                    <th scope="col">Role</th>
                    <th scope="col">Image</th>
                    <th scope="col">Operations</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $sql = "SELECT * FROM `user` WHERE id!='$user_id'";
                    $result = mysqli_query($conn, $sql);
                    $status = 1;
                    
                    if($result) {
                        while($row = mysqli_fetch_assoc($result)) {
                            $id = $row['id'];
                            $name = $row['name'];
                            $email = $row['email'];
                            $password = $row['password'];
                            $role = $row['role'];
                            $image = $row['image'];

                            if($image == '') {
                                echo '<tr>
                                    <th scope="row">'.$status.'</th>
                                    <td>'.$name.'</td>
                                    <td>'.$email.'</td>
                                    <td>'.$password.'</td>
                                    <td>'.$role.'</td>
                                    <td><img src="../assets/default_img/default-avatar.png" height="40" width="40" class="rounded-circle border border-1"/></td>
                                    <td>
                                        <a class="text-decoration-none" href="update_user.php?updateid='.$id.'" class="text-light"><button class="btn btn-primary">Update</button></a>
                                        <a href="delete_user.php?deleteid='.$id.'" class="text-light"><button class="btn btn-danger">Delete</button></a>
                                    </td>
                                  </tr>';
                            }
                            else {
                                echo '<tr>
                                    <th scope="row">'.$status.'</th>
                                    <td>'.$name.'</td>
                                    <td>'.$email.'</td>
                                    <td>'.$password.'</td>
                                    <td>'.$role.'</td>
                                    <td><img src="../assets/images/'.$image.'" height="40" width="40" class="rounded-circle border border-1"/></td>
                                    <td>
                                        <a class="text-decoration-none" href="update_user.php?updateid='.$id.'" class="text-light"><button class="btn btn-primary">Update</button></a>
                                        <a href="delete_user.php?deleteid='.$id.'" class="text-light"><button class="btn btn-danger">Delete</button></a>
                                    </td>
                                  </tr>';
                            
                            
                            }

                            $status++;
                        }
                    }
                ?>
                
            </tbody>
        </table>
</div>
<!-- Body End -->

<!-- Footer Start -->
<?php include("../partials/footer_admin.php"); ?>
<!-- Footer End -->