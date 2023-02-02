<?php
class EditProfile extends DbConn
{
    // Creating profile in profiles database after signup
    protected function SetUserProfile($userId){
        // Creating SQL Query
        $query = "INSERT INTO profiles (users_id, profiles_img) VALUES (?,?);";

        // Connecting to database and preparing statement (SQL_INJECTION protection)
        $stmt = $this->connect()->prepare($query);

        // Execitung the statement and replacing question marks with variables (array)
        if(!$stmt->execute([$userId, 'img/profiles/profiledefault.jpg'])){
            $stmt = null;
            header("../signup.php?stmt=failed");
            exit();
        }

        $stmt = null;
    }

    protected function checkEmail($email, $userId){
        // Creating SQL query to select user
        $query = "SELECT * FROM users WHERE users_email = ? AND users_id != ?;";

        // connecting to the database and preparing statement
        $stmt = $this->connect()->prepare($query);

        // Execitung the statement and replacing question marks with variables (array)
        if(!$stmt->execute([$email, $userId])){
            $stmt = null;
            header("location: ../editprofile.php?stmt=failed");
            exit();
        }

        // Checking if user exists
        global $result;
        if($stmt->rowCount() > 0){
            $result = false;
        } else {
            $result = true;
        }
        $stmt = null;
        return $result;
    }

    // Function to edit user
    protected function editUser($firstName, $secondName, $email, $dateOfBirth, $profileImg, $userId){
        // Creating SQL Query
        $query = "UPDATE users SET users_firstName=?, users_secondName=?, users_email=?, users_dateOfBirth=? WHERE users_id = ?;";

        // connecting to the database and preparing statement
        $stmt = $this->connect()->prepare($query);

        // Execitung the statement and replacing question marks with variables (array)
        if(!$stmt->execute([$firstName, $secondName, $email, $dateOfBirth, $userId])){
            $stmt = null;
            header("location: ../editprofile.php?stmt=failed");
            exit();
        }

        // Checking if user made changes
        if($stmt->rowCount() == 0 & empty($profileImg['name'])){
            $stmt = null;
            header("location: ../editprofile.php?error=changes");
            exit();
        }

        // Displaying edited informations
        $_SESSION["userFirstName"] = $firstName;
        $_SESSION["userSecondName"] = $secondName;
        $_SESSION["userEmail"] = $email;
        $_SESSION["userDOB"] = $dateOfBirth;

        $stmt = null;
    }

    public function addProfileImage($userId, $profileImg, $oldProfileImg){
        $defaultProfileImg = 'img/profiles/profiledefault.jpg';

        // Delete previous profile picture
        if ($defaultProfileImg != $oldProfileImg) {
            // Delete previous profile picture
            unlink('../' . $oldProfileImg);
        }

        // Getting information about picture
        $fileName = $profileImg['name'];
        $fileTmpName = $profileImg['tmp_name'];
        $fileSize = $profileImg['size'];
        $fileError = $profileImg['error'];
        $fileType = $profileImg['type'];

        // Getting file extension
        $fileExt = explode('.',$fileName);
        $fileExt = strtolower(end($fileExt));

        // Creating array of allowed extensions
        $allowedExt = ['jpg', 'png', 'jpeg'];

        if(in_array($fileExt, $allowedExt)){
            if($fileError == 0){
                if($fileSize < 1000000){  // (1MB)

                    // Creating a new file with user id
                    $imgName = 'profile' . $userId . "." . $fileExt;
                    $fileDir = '../img/profiles/' . $imgName;
                    $fileNormDir = 'img/profiles/' . $imgName;

                    // Moving the file in folder
                    move_uploaded_file($fileTmpName, $fileDir);

                    // Creating SQL query to add file destionation to profiles database
                    $query = "UPDATE profiles SET profiles_img = ?";

                    // connecting to the database and preparing statement
                    $stmt = $this->connect()->prepare($query);

                    // Execitung the statement and replacing question marks with variables (array)
                    if(!$stmt->execute([$fileNormDir])){
                        $stmt = null;
                        header("location: ../editprofile.php?stmt=failed");
                        exit();
                    }

                    $_SESSION["profileImg"] = $fileNormDir;

                    $stmt = null;
                }
                else {
                    header("location: ../editprofile.php?error=fileSize");
                    exit();
                }
            }
        } else {
            header("location: ../editprofile.php?error=fileTypeImg");
            exit();
        }
    }

    public function deleteProfilePicture($oldProfileImg){

        $defaultProfileImg = 'img/profiles/profiledefault.jpg';

        if($defaultProfileImg != $oldProfileImg){
            // Delete previous profile picture
            unlink('../' . $oldProfileImg);

            // Creating SQL query to add file destionation to profiles database
            $query = "UPDATE profiles SET profiles_img = ?";

            // connecting to the database and preparing statement
            $stmt = $this->connect()->prepare($query);

            // Execitung the statement and replacing question marks with variables (array)
            if(!$stmt->execute([$defaultProfileImg])){
                $stmt = null;
                header("location: ../editprofile.php?stmt=failed");
                exit();
            }

            $stmt = null;

            // Update profile picture
            $_SESSION['profileImg'] = $defaultProfileImg;
        } else {
            header("location: ../editprofile.php?error=deleteDefaultProfileImg");
            exit();
        }
    }

    public function deleteProfile($userId){
        // Create SQL Query
        $query = 'DELETE FROM users WHERE users_id = ?;
        DELETE FROM profiles WHERE users_id = ?;';

        // Connecting to the database and preparing statement
        $stmt = $this->connect()->prepare($query);

        // Execitung the statement and replacing question marks with variables (array)
        if(!$stmt->execute([$userId, $userId])){
            $stmt = null;
            header("location: ../editprofile.php?stmt=failed");
            exit();
        }

        session_unset();
        session_destroy();

        $stmt = null;
    }
}