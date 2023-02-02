<?php

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userId = $_SESSION['userId'];
    $oldProfileImg = $_SESSION['profileImg'];

    // Proccess
    include "../classes/dbh.classes.php";
    include "../classes/editprofile.classes.php";
    include "../classes/editprofile-contr.classes.php";

    $updateUser = new EditProfileCtrl($userId);
    $updateUser->deleteProfilePicture($oldProfileImg);

    header("location: ../profile.php?profile=pictureDeleted");

} else {
    header("location: ../editprofile.php");
}