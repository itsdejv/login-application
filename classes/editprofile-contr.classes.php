<?php
class EditProfileCtrl extends EditProfile
{
    private $userId;

    function __construct($userId){
        $this->userId = $userId;
    }

    // Creating profile in profiles database after signup
    public function CreateProfile(){
        $this->SetUserProfile($this->userId);
    }

    public function updateUser($firstName, $secondName, $email, $dateOfBirth, $profileImg, $oldProfileImg){

        // Check if inputs are empty
        if($this->emptyInput($firstName, $secondName, $email, $dateOfBirth, $profileImg) == false){
            header("location: ../editprofile.php?error=emptyInput");
            exit();
        }

        // Check if names are written correctly
        if($this->checkName($firstName, $secondName) == false){
            header("location: ../editprofile.php?error=invalidNameCharacters");
            exit();
        }

        // Check if email exists
        if($this->checkEmailFormat($email) == false){
            header("location: ../editprofile.php?error=emailInvalid");
            exit();
        }

        // Check if email is taken
        if($this->checkEmail($email, $this->userId) == false){
            header("location: ../editprofile.php?error=emailTaken");
            exit();
        }

        // Finally editing the user
        $this->editUser($firstName, $secondName, $email, $dateOfBirth, $profileImg, $this->userId);
        
        if(!empty($profileImg['name'])){
            $this->addProfileImage($this->userId, $profileImg, $oldProfileImg);
        }
    }

    // Creating function to check if inputs are empty or not
    private function emptyInput($firstName, $secondName, $email, $dateOfBirth, $profileImg){
        global $result;
        if(empty($firstName) || empty($secondName) || empty($email) || empty($dateOfBirth)){
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    // Creating function to check if name is correctly written
    private function checkName($firstName, $secondName){
        global $result;
        if(preg_match('/[^\pL\s-]/u', $firstName) || preg_match('/[^\pL\s-]/u', $secondName)){
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    // Creating function to check if email is correctly written
    private function checkEmailFormat($email){
        global $result;
        if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }
}