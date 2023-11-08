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
<div class="container py-5">
<a href="add_comic.php" class="text-light"><button class="btn btn-primary my-5">Add comic</button></a>
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
        <table class="table align-middle table-striped">
            <thead class="table-success align-middle">
                <tr>
                    <th scope="col">Sl no</th>
                    <th scope="col">Title</th>
                    <th scope="col">Author</th>
                    <th scope="col">Date</th>
                    <th scope="col">Description</th>
                    <th scope="col">Number of chapters</th>
                    <th scope="col">Image</th>
                    <th scope="col">Operations</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $sql = "SELECT * FROM `comic`";
                    $result = mysqli_query($conn, $sql);
                    $status = 1;
                    
                    if($result) {
                        while($row = mysqli_fetch_assoc($result)) {
                            $id = $row['id'];
                            $title = $row['title'];
                            $author = $row['author'];
                            $date = $row['date'];
                            $descrip = $row['description'];
                            $chap_num = $row['chap_num'];
                            $image = $row['image'];
                            $image_folder = '../assets/comic_images/' . $image;

                            echo '<tr>
                                    <th scope="row">'.$status.'</th>
                                    <td>'.$title.'</td>
                                    <td>'.$author.'</td>
                                    <td>'.$date.'</td>
                                    <td>'.$descrip.'</td>
                                    <td>'.$chap_num.'</td>
                                    <td><img src="'.$image_folder.'" height="200" width="200" class="border border-1"/></td>
                                    <td>
                                        <a href="update_comic.php?updateid='.$id.'" class="text-light"><button class="btn btn-primary">Update</button></a>
                                        <a href="delete_comic.php?deleteid='.$id.'" class="text-light"><button class="btn btn-danger">Delete</button></a>
                                    </td>
                                  </tr>';
                            
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