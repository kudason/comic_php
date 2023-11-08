<!-- Logout function -->
<?php
    include("../config/connect.php");

    /*Session start*/ 
    session_start();

    $user_id = $_SESSION['user_id'];

    if(!isset($user_id)) {
        header("location: ../login.php");
    }

    if(isset($_GET['logout'])) {
        unset($user_id);
        session_destroy();
        header('location: ../login.php');
    }
?>

<!-- Logout end -->


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <!-- Bootstrap Link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Font Awesome Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- CSS custom -->
    <style>
        .custom-bg:hover {
            background-color: tomato;
            color: white;
        }
    </style>
</head>
<body>
    <!-- Start Menu -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
        <div class="container-fluid">
                <a class="navbar-brand" href="home.php">
                    <img src="../assets/icon/book.png"  alt="">
                </a>
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="home.php">Home</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="dashboard.php">Dashboard</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="manage_user.php">Manage User</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="manage_comic.php">Manage Comic</a>
                    </li>
                </ul>
                