<?php
// Starting session
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- linking bootstrap -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <script src="bootstrap/js/bootstrap.min.js"></script>

    <!-- linking style -->
    <link rel="stylesheet" href="style.css">

    <title>Document</title>
</head>
<body>
    <!-- NAV -->
    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Login Application</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                <a class="nav-link" aria-current="page" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" aria-current="page" href="gallery.php">Gallery</a>
                </li>
            </ul>
            <span class="navbar-text">
                <?php
                // Checking if user is logge in
                if(isset($_SESSION['userId'])){
                    ?>
                    
                    <a href="includes/signout.inc.php">Sign out</a>
                    <a href="profile.php">Profile</a>

                    <?php
                } else {
                    ?>

                    <a href="signup.php">Sign up</a>
                    <a href="login.php">Log in</a>

                    <?php
                }
                ?>
            </span>
            </div>
        </div>
    </nav>
    <?php include "includes/errors.inc.php" ?>