<?php

class GalleryView extends DbConn
{
    public function galleryPrint(){
        $query = "SELECT * FROM gallery ORDER BY photos_id";

        $stmt = $this->connect()->prepare($query);

        if(!$stmt->execute()){
            $stmt = null;
            header("gallery.php?stmt=failed");
            exit();
        }
       
        if($stmt->rowCount() > 0){
            return $stmt;
        } else{
            return false;
        }
    }
}