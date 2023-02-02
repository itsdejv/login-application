<?php
if(isset($_GET["error"])){
    $errorCheck = $_GET["error"];
    if($errorCheck == "emptyInput"){
        echo "<p>The form is not fully completed, you must fill in all fields!</p>";
    }
    else if($errorCheck == "pwdShort"){
        echo "<p>Your password is too short! It has to be at least 8 characters long!</p>";
    }
    else if($errorCheck == "pwdMatch"){
        echo "<p>Your passwords don't match</p>";
    }
    else if($errorCheck == "invalidNameCharacters"){
        echo "<p>Your name contains invalid characters</p>";
    }
    else if($errorCheck == "emailInvalid"){
        echo "<p>The e-mail you've entered is not valid!</p>";
    }
    else if($errorCheck == "emailTaken"){
        echo "<p>The e-mail you're trying to use is already Taken!</p>";
    }
    else if($errorCheck == "userNotFound"){
        echo "<p>User was not found!</p>";
    }
    else if($errorCheck == "changes"){
        echo "<p>You haven't made any changes!</p>";
    }
    else if($errorCheck == "fileSize"){
        echo "<p>Your file is too big! (max: 1MB)</p>";
    }
    else if($errorCheck == "deleteDefaultProfileImg"){
        echo "<p>You can't delete something that doesn't exists.</p>";
    }
    else if($errorCheck == "fileTypeImg"){
        echo "<p>Incorrect type of file. You can upload only images.</p>";
    }
    else if($errorCheck == "invalidFileName"){
        echo "<p>The file name contains forbidden characters!</p>";
    }
    else if($errorCheck == "noPhotos"){
        echo "<p>We haven't found any photos! We're sorry for that!</p>";
    }
}

if(isset($_GET["registration"])){
    $errorCheck = $_GET["registration"];
    if($errorCheck == "success"){
        echo "<p>Registration was successful, please log in!</p>";
    }
}

if(isset($_GET["login"])){
    $errorCheck = $_GET["login"];
    if($errorCheck == "success"){
        echo "<p>You're logged in</p>";
    }
}

if(isset($_GET["profile"])){
    $errorCheck = $_GET["profile"];
    if($errorCheck == "edited"){
        echo "<p>Changes made successfully!</p>";
    }
    if($errorCheck == "pictureDeleted"){
        echo "<p>Profile picture was successfully deleted!</p>";
    }
    if($errorCheck == "deleted"){
        echo "<p>Your profile was successfully deleted!</p>";
    }
}

if(isset($_GET["photo"])){
    $errorCheck = $_GET["photo"];
    if($errorCheck == "deleted"){
        echo "<p>Picture was successfully deleted!</p>";
    }
    if($errorCheck == "uploaded"){
        echo "<p>Picture was successfully uploaded!</p>";
    }
}