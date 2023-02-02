<?php

class SignupCtrl extends Signup
{
    // Creating private variables
    private $firstName;
    private $secondName;
    private $email;
    private $dateOfBirth;
    private $pwd;
    private $pwdRepeat;

    // Adding construct variables
    public function __construct($firstName, $secondName, $email, $dateOfBirth, $pwd, $pwdRepeat)
    {
        $this->firstName = $firstName;
        $this->secondName = $secondName;
        $this ->email = $email;
        $this->dateOfBirth = $dateOfBirth;
        $this->pwd = $pwd;
        $this->pwdRepeat = $pwdRepeat;
    }

    // Creating function to sign up user
    public function signUpUser(){

        // Creating the conditions that must be fulfilled
        // Checking if all inputs are filled
        if($this->emptyInput() == false){
            header("location: ../signup.php?error=emptyInput&firstName=" . $this->firstName . "&secondName=" . $this->secondName . "&DOB=" . $this->dateOfBirth);
            exit();
        }

        // Checking if password is long enough
        if($this->pwdLength() == false){
            header("location: ../signup.php?error=pwdShort&firstName=" . $this->firstName . "&secondName=" . $this->secondName . "&DOB=" . $this->dateOfBirth);
            exit();
        }

        // Checking if all passwords are matching
        if($this->pwdMatch() == false){
            header("location: ../signup.php?error=pwdMatch&firstName=" . $this->firstName . "&secondName=" . $this->secondName . "&DOB=" . $this->dateOfBirth);
            exit();
        }

        // Checking if name contains allowed characters
        if($this->checkName() == false){
            header("location: ../signup.php?error=invalidNameCharacters&firstName=" . $this->firstName . "&secondName=" . $this->secondName . "&DOB=" . $this->dateOfBirth);
            exit();
        }

        // Checking if email is correctly written
        if($this->checkEmail() == false){
            header("location: ../signup.php?error=emailInvalid&firstName=" . $this->firstName . "&secondName=" . $this->secondName . "&DOB=" . $this->dateOfBirth);
            exit();
        }

        // Chechking if email is taken or not
        if($this->checkUser($this->email) == false){
            header("location: ../signup.php?error=emailTaken&firstName=" . $this->firstName . "&secondName=" . $this->secondName . "&DOB=" . $this->dateOfBirth);
            exit();
        }


        // if All cinditions are fulfilled then create user
        $this->setUser($this->firstName, $this->secondName, $this->email, $this->dateOfBirth, $this->pwd);
    }

    // Creating function to check if all inputs are filled
    private function emptyInput(){
        global $result;
        if(empty($this->firstName) || empty($this->secondName) || empty($this->email) || empty($this->dateOfBirth) || empty($this->pwd) || empty($this->pwdRepeat)){
            $result = false;
        } else{
            $result = true;
        }
        return $result;
    }

    // Creating function to check if email is correctly written
    private function checkEmail(){
        global $result;
        if(!filter_var($this->email,FILTER_VALIDATE_EMAIL)){
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    // Creating function to check if password long enough
    private function pwdLength(){
        global $result;
        if(strlen($this->pwd) < 8){
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    // Creating function to check if passwords are matching
    private function pwdMatch(){
        global $result;
        if($this->pwd !== $this->pwdRepeat){
            $result = false;
        } else{
            $result = true;
        }
        return $result;
    }

    // Creating function to check if name is correctly written
    private function checkName(){
        global $result;
        if(preg_match('/[^\pL\s-]/u', $this->firstName) || preg_match('/[^\pL\s-]/u', $this->secondName)){
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    public function fetchUserId($email){
        $userId = $this->getUserId($email);
        return $userId[0]['users_id'];
    }
}