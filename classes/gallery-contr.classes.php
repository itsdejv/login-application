<?php

class GalleryCtrl extends Gallery
{
    function __construct(){
    }

    public function uploadImage($galleryImg, $galleryImgName){
        // Check if user filled everything
        if($this->emptyInput($galleryImg, $galleryImgName) == false){
            header("location: ../gallery.php?error=emptyInput");
            exit();
        }

        // Check if user filled file name correctly
        if($this->checkFileName($galleryImgName) == false){
            header("location: ../gallery.php?error=invalidFileName");
            exit();
        }

        $this->addProfileImage($galleryImg, $galleryImgName);
    }

    public function removePhoto($photoId, $photoPath){
        $this->deletePhoto($photoId, $photoPath);
    }

    // Check if user filled everything
    private function emptyInput($galleryImg, $galleryImgName){
        global $result;
        if(empty($galleryImgName) || empty($galleryImg['name'])){
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    // Check if name is correctly written
    private function checkFileName($galleryImgName){
        global $result;
        if(!preg_match('/^[a-zA-Z0-9]/', $galleryImgName)){
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }
}