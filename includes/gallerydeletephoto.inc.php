<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Get values
    $photoPath = htmlspecialchars($_POST["photoPath"], ENT_QUOTES, 'UTF-8');
    $photoId = htmlspecialchars($_POST["photoId"], ENT_QUOTES, 'UTF-8');

    // Proccess
    include "../classes/dbh.classes.php";
    include "../classes/gallery.classes.php";
    include "../classes/gallery-contr.classes.php";

    $galleryCtrl = new GalleryCtrl();
    $galleryCtrl->removePhoto($photoId, $photoPath);

    header("location: ../gallery.php?photo=deleted");

} else {
    header("location: ../gallery.php");
}