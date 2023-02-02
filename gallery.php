<!-- INCLUDING HEADER -->
<?php
include "skeleton/header.php";
?>

<!-- MAIN SECTION -->
<main>
    <div class="container">

        <?php

        include "classes/dbh.classes.php";
        include "classes/gallery-view.classes.php";

        $galleryView = new GalleryView();
        $galleryResult = $galleryView->galleryPrint();


        if($galleryResult){
            foreach ($galleryResult as $photo) { ?>
            <div class="gallery-item">
                <a href="">
                    <div class="gallery-photo" style="background-image: url(<?php echo $photo['photos_path'] ?>);">
                    <form action="includes/gallerydeletephoto.inc.php" method="post">
                        <input type="hidden" name="photoId" value="<?php echo $photo['photos_id'] ?>">
                        <input type="hidden" name="photoPath" value="<?php echo $photo['photos_path'] ?>">
                        <input type="submit" value="Smazat">
                    </form>    
                    </div>
                    <h3><?php echo $photo['photos_name'] ?></h3>
                </a>
            </div><?php
            }
        } else {
            echo "There are no photos!";
        }?>

        <form action="includes/gallery.inc.php" method="post" enctype='multipart/form-data'>
            <input type="file" name="galleryImg"><br>
            <input type="text" name="galleryImgName" placeholder="Name of the photo"><br>
            <input type="submit" value="Upload image" name="submit">
        </form>
    </div>
</main>

<!-- INCLUDING HEADER -->
<?php
include "skeleton/footer.php";
?>
<div class="container">

</div>