<?php
    include("../config/connect.php");

    if(isset($_GET['deleteid'])) {
        $id = $_GET['deleteid'];

        $select = mysqli_query($conn, "SELECT * FROM `user` WHERE id=$id");

        if($select) {
            $row = mysqli_fetch_assoc($select);
            $image_folder = "../assets/images/" . $row['image'];

            if(file_exists($image_folder)) {
                unlink($image_folder);
            }

            $delete = mysqli_query($conn, "DELETE FROM `user` WHERE id=$id") or die("Query Failed!");

            if($delete) {
                $message[] = 'Delete user successfully';
                header("location: manage_user.php");
            }
            else {
                $message[] = 'Delete failed';
            }
        }

    }
?>