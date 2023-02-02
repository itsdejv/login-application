<?php

class LoginCtrl extends Login
{

    // Creating private variables
    private $email;
    private $pwd;

    // Adding construct variables
    public function __construct($email, $pwd)
    {
        $this->email = $email;
        $this->pwd = $pwd;
    }

    // Login user
    public function loginUser(){
        if($this->emptyInput() == false){
            header("location: ../login.php?error=emptyInput");
            exit();
        }

        $this->getUser($this->email, $this->pwd);
    }

    // Creating function to check if all inputs are filled
    private function emptyInput(){
        global $result;
        if(empty($this->email) || empty($this->pwd)){
            $result = false;
        } else{
            $result = true;
        }
        return $result;
    }
}