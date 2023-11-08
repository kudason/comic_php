<!-- Menu Start -->
<?php include("./partials/menu.php"); ?>
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
                $image_folder = './assets/comic_images/' . $image;

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
<?php include("./partials/footer.php"); ?>
<!-- Footer End -->