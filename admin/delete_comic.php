<?php
    include("../config/connect.php");

    if(isset($_GET['deleteid'])) {
        $id = $_GET['deleteid'];

        $select = mysqli_query($conn, "SELECT * FROM `comic` WHERE id=$id");

        if($select) {
            $row = mysqli_fetch_assoc($select);
            $image_folder = "../assets/comic_images/" . $row['image'];

            if(file_exists($image_folder)) {
                unlink($image_folder);
            }

            $delete = mysqli_query($conn, "DELETE FROM `comic` WHERE id=$id") or die("Query Failed!");

            if($delete) {
                $message[] = 'Delete comic successfully';
                header("location: manage_comic.php");
            }
            else {
                $message[] = 'Delete failed';
            }
        }

    }
?>