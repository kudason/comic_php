<!-- Menu Start -->
<?php include("./partials/menu.php"); ?>
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
                        $image_folder = './assets/comic_images/' . $image;

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
<?php include("./partials/footer.php"); ?>   
<!-- Footer End -->