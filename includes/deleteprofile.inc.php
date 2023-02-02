<?php

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $userId = $_SESSION['userId'];

    // Proccess
    include "../classes/dbh.classes.php";
    include "../classes/editprofile.classes.php";
    include "../classes/editprofile-contr.classes.php";

    $updateUser = new EditProfileCtrl($userId);
    $updateUser->deleteProfile($userId);

    header('location: ../index.php?profile=deleted');

} else {
    header("location: ../editprofile.php");
}