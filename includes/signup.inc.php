<?php

if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    // Get values from user
    $firstName = htmlspecialchars($_POST["firstName"], ENT_QUOTES, 'UTF-8');
    $secondName = htmlspecialchars($_POST["secondName"], ENT_QUOTES, 'UTF-8');
    $email = htmlspecialchars($_POST["email"], ENT_QUOTES, 'UTF-8');
    $dateOfBirth = htmlspecialchars($_POST["dateOfBirth"], ENT_QUOTES, 'UTF-8');
    $pwd = htmlspecialchars($_POST["pwd"], ENT_QUOTES, 'UTF-8');
    $pwdRepeat = htmlspecialchars($_POST["pwdRepeat"], ENT_QUOTES, 'UTF-8');

    // Signup process
    include "../classes/dbh.classes.php";
    include "../classes/signup.classes.php";
    include "../classes/signup-contr.classes.php";
    $signup = new SignupCtrl($firstName, $secondName, $email, $dateOfBirth, $pwd, $pwdRepeat);
    $signup->signUpUser();

    $userId = $signup->fetchUserId($email);

    // Profile process
    include "../classes/editprofile.classes.php";
    include "../classes/editprofile-contr.classes.php";
    $editProfile = new EditProfileCtrl($userId);

    // Creating profile in database
    $editProfile->CreateProfile();

    // Getting user to log in page
    header("location: ../login.php?registration=success");
    

} else {
    header("location: ../signup.php");
}