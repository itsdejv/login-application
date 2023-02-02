<?php

class Gallery extends DbConn
{
    public function addProfileImage($galleryImg, $galleryImgName)
    {
        // Getting information about picture
        $fileName = $galleryImg['name'];
        $fileTmpName = $galleryImg['tmp_name'];
        $fileSize = $galleryImg['size'];
        $fileError = $galleryImg['error'];
        $fileType = $galleryImg['type'];

        // Getting file extension
        $fileExt = explode('.', $fileName);
        $fileExt = strtolower(end($fileExt));

        // Creating array of allowed extensions
        $allowedExt = ['jpg', 'png', 'jpeg'];

        if (in_array($fileExt, $allowedExt)) {
            if ($fileError == 0) {
                if ($fileSize < 1000000) { // (1MB)
                    // Creating a new file with user id
                    $imgName = 'photo-' . $galleryImgName . '-' . uniqid() . '.' . $fileExt;
                    $imgName = str_replace(" ", "", $imgName);
                    $fileDir = '../img/gallery/' . $imgName;
                    $fileNormDir = 'img/gallery/' . $imgName;

                    // Moving the file in folder
                    move_uploaded_file($fileTmpName, $fileDir);

                    // Creating SQL query to add file destionation to profiles database
                    $query = "INSERT INTO gallery (photos_path, photos_name) VALUES (?,?);";

                    // Connecting to the database and preparing statement
                    $stmt = $this->connect()->prepare($query);

                    // Execitung the statement and replacing question marks with variables (array)
                    if(!$stmt->execute([$fileNormDir, $galleryImgName])){
                        $stmt = null;
                        header("location: ../editprofile.php?stmt=failed");
                        exit();
                    }
                } 
                // Throw error if file is too big
                else {
                    header("location: ../gallery.php?error=fileSize");
                    exit();
                }
            }
        }
        // Throw error if the file is wrong type
        else {
            header("location: ../gallery.php?error=fileTypeImg");
            exit();
        }
    }

    public function deletePhoto($photoId, $photoPath){
        unlink('../' . $photoPath);

        // Creating SQL query to add file destionation to profiles database
        $query = "DELETE FROM gallery WHERE photos_id = ?;";

        // Connecting to the database and preparing statement
        $stmt = $this->connect()->prepare($query);

        // Execitung the statement and replacing question marks with variables (array)
        if(!$stmt->execute([$photoId])){
            $stmt = null;
            header("location: ../editprofile.php?stmt=failed");
            exit();
        }
    }
}