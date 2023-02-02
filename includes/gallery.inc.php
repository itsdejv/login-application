<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Get values from user
    $galleryImg = $_FILES['galleryImg'];
    $galleryImgName = htmlspecialchars($_POST["galleryImgName"], ENT_QUOTES, 'UTF-8');

    // Proccess
    include "../classes/dbh.classes.php";
    include "../classes/gallery.classes.php";
    include "../classes/gallery-contr.classes.php";

    $galleryCtrl = new GalleryCtrl();
    $galleryCtrl->uploadImage($galleryImg, $galleryImgName);

    header("location: ../gallery.php?photo=uploaded");

} else {
    header("location: ../gallery.php");
}