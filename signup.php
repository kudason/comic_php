<!-- Menu Start -->
<?php include("./partials/menu.php"); ?>
<!-- Menu End -->



<!-- Connect to database and insert -->
<?php
	/* Connect to mysql*/
	include("./config/connect.php");

	/*Check to insert data*/
	if(isset($_POST['signup'])) {
		// Get varuable
		$name = mysqli_real_escape_string($conn, $_POST['uname']);
		$email = mysqli_real_escape_string($conn, $_POST['email']);
		$pass = mysqli_real_escape_string($conn, md5($_POST['password']));
		$cpass = mysqli_real_escape_string($conn, md5($_POST['cpassword']));

		// Get image
		$image_name = $_FILES['image']['name'];
		$image_size = $_FILES['image']['size'];
		$image_tmp_name = $_FILES['image']['tmp_name'];
		$image_folder = './assets/images/' . $image_name;

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
				$insert = mysqli_query($conn, "INSERT INTO `user` (name, email, password, image, role) VALUES('$name','$email','$pass','$image_name', 'user')") or die("query failed!");

				if($insert) {
					move_uploaded_file($image_tmp_name, $image_folder);
					$message[] = 'registered successfully';
					header("location: login.php");
				}
				else {
					$message[] = 'registration failed!';
				}
			}
		}

	} 
?>
<!-- Query end -->





<!-- Body here -->
<div class="container h-100 py-5">
	<div class="row d-flex justify-content-center align-items-center h-100">
		<div class="col-lg-12 col-xl-11">
			<div class="card text-black" style="border-radius: 25px;">
				<div class="card-body p-md-5">
					<div class="row justify-content-center">
						<div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

							<p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Signup</p>

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

							<form class="mx-1 mx-md-4" method="post" enctype="multipart/form-data">

									<div class="d-flex flex-row align-items-center mb-4">
										<i class="fas fa-user fa-lg me-3 fa-fw"></i>
									    <div class="form-outline flex-fill mb-0">
                                            <input type="text" name="uname" id="form3Example1c" class="form-control" />
										    <label class="form-label" for="form3Example1c">Your Name</label>
									    </div>
									</div>

									<div class="d-flex flex-row align-items-center mb-4">
										<i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
										<div class="form-outline flex-fill mb-0">
											<input type="email" name="email" id="form3Example3c" class="form-control" />
											<label class="form-label" for="form3Example3c">Your Email</label>
										</div>
									</div>

									<div class="d-flex flex-row align-items-center mb-4">
										<i class="fas fa-lock fa-lg me-3 fa-fw"></i>
										<div class="form-outline flex-fill mb-0">
											<input type="password" name="password" id="form3Example4c"
												class="form-control" /> <label class="form-label"
												for="form3Example4c">Password</label>
										</div>
									</div>

									<div class="d-flex flex-row align-items-center mb-4">
										<i class="fas fa-key fa-lg me-3 fa-fw"></i>
										<div class="form-outline flex-fill mb-0">
											<input type="password" name="cpassword" id="form3Example4cd"
												class="form-control" /> <label class="form-label"
												for="form3Example4cd">Repeat your password</label>
										</div>
									</div>

                                    <div class="d-flex flex-row align-items-center mb-4">
										<i class="fas fa-image fa-lg me-3 fa-fw"></i>
										<div class="form-outline flex-fill mb-0">
                                            <input class="form-control" type="file" name="image" accept="image/png, image/jpg, image/jpeg" id="formFile">
                                            <label class="form-label"
												for="form3Example4cd">Insert Your Image</label>
										</div>
									</div>


									<div class="d-flex justify-content-center align-items-center mx-4 mb-3 mb-lg-4">
										<input type="submit" value="Register" class="btn btn-primary btn-lg me-4" name="signup"></input>
										<a style="color: red;" href="login.php">Already have an account? Login now</a>
									</div>

							</form>

							</div>
								<div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">
                                    <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-registration/draw1.webp" class="img-fluid" alt="Sample image">
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
    </div>
</div>
<!-- Body end -->


<!-- Footer Start -->
<?php include("./partials/footer.php"); ?>
<!-- Footer End -->