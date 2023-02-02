<?php

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $userId = $_SESSION["userId"];
    $oldProfileImg = $_SESSION['profileImg'];
    
    // Get values from user
    $firstName = htmlspecialchars($_POST["firstName"], ENT_QUOTES, 'UTF-8');
    $secondName = htmlspecialchars($_POST["secondName"], ENT_QUOTES, 'UTF-8');
    $email = htmlspecialchars($_POST["email"], ENT_QUOTES, 'UTF-8');
    $dateOfBirth = htmlspecialchars($_POST["dateOfBirth"], ENT_QUOTES, 'UTF-8');
    $profileImg = $_FILES['profileImg'];

    // Proccess
    include "../classes/dbh.classes.php";
    include "../classes/editprofile.classes.php";
    include "../classes/editprofile-contr.classes.php";

    $updateUser = new EditProfileCtrl($userId);
    $updateUser->updateUser($firstName, $secondName, $email, $dateOfBirth, $profileImg, $oldProfileImg);

    header("location: ../profile.php?profile=edited");

} else {
    header("location: ../profile.php?sdsadasdas");
}