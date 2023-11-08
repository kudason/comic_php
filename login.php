<!-- Menu Start -->
<?php include("./partials/menu.php"); ?>
<!-- Menu End -->

<!-- Connect to mysql and login -->
<?php
  // Connect to mysql
  include("./config/connect.php");

  // Start session
  session_start();

  /* Check to confirm login */
  if(isset($_POST['login'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = mysqli_real_escape_string($conn, md5($_POST['password']));

    /* Select query */
    $select = mysqli_query($conn, "SELECT * FROM `user` WHERE email='$email' AND password='$pass'") or die("query failed");
    
    /* If already in db -> connect */
    if(mysqli_num_rows($select) > 0) {
      $row = mysqli_fetch_assoc($select);
      $_SESSION['user_id'] = $row['id'];
      
      if($row['role'] != 'admin') {
        header('location: user/home.php');
      }
      else {
        header('location: admin/home.php');
      }
      
    } 
    else {
      $message[] = 'Incorrect email or password';
    }
  }
?>
<!-- End Query -->




<!-- Body here -->
<div class="container py-5 h-100">
    <div class="row d-flex align-items-center justify-content-center h-100">
      <div class="col-md-8 col-lg-7 col-xl-6">
        <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.svg"
          class="img-fluid" alt="Phone image">
      </div>
      <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
        <form action="" method="post" enctype="multipart/form-data">
          <h3 class="text-center">Login</h3>

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
          <!-- end echo message -->

          <!-- Email input -->
          <div class="form-outline mb-4">
            <input type="email" name="email" id="form1Example13" class="form-control form-control-lg" name="email" />
            <label class="form-label" for="form1Example13">Email address</label>
          </div>

          <!-- Password input -->
          <div class="form-outline mb-4">
            <input type="password" name="password" id="form1Example23" class="form-control form-control-lg" name="password"/>
            <label class="form-label" for="form1Example23">Password</label>
          </div>

          <div class="d-flex justify-content-center align-items-center mb-4">
            <!-- Submit button -->
            <input type="submit" value="Login" name="login" class="btn btn-primary btn-lg btn-block me-4"></input>
            <a style="color: red;" href="signup.php">Don't have an account? Register now</a>
          </div>

          
        </form>
      </div>
    </div>
  </div>
<!-- Body end -->





<!-- Footer Start -->
<?php include("./partials/footer.php"); ?>
<!-- Footer End -->