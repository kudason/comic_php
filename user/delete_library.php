<?php
// Include your database connection code here
include("../config/connect.php");

if (isset($_GET['deleteid'])) {
    $item_id = $_GET['deleteid'];

    // Perform the deletion from the database based on the $item_id
    $deleteSql = "DELETE FROM `library` WHERE id=?";
    $deleteStmt = $conn->prepare($deleteSql);
    $deleteStmt->bind_param("i", $item_id);

    if ($deleteStmt->execute()) {
        // Deletion was successful, you can provide a success message or perform other actions
        echo '<div class="alert alert-danger" role="alert">Delete Successfully!</div>';
    } else {
        // Deletion failed, you can provide an error message or perform error handling
        echo '<div class="alert alert-danger" role="alert">Delete Failed!</div>';
    }
}

// Redirect back to the original page after deletion
header("Location: library.php");
?>
