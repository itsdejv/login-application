<?php

class Signup extends DbConn
{
    
    // Creating function to create a user
    protected function setUser($firstName, $secondName, $email, $dateOfBirth, $pwd){
        // Creating SQL query to add user
        $query = "INSERT INTO users (users_firstName, users_secondName, users_email, users_dateOfBirth, users_pwd) VALUES (?, ?, ?, ?, ?);";
        
        // connecting to the database and preparing statement
        $stmt = $this->connect()->prepare($query);

        // Hashing the password
        $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

        // Execitung the statement and replacing question marks with variables (array)
        if(!$stmt->execute([$firstName, $secondName, $email, $dateOfBirth, $hashedPwd])){
            $stmt = null;
            header("../signup.php?stmt=failed");
            exit();
        }

        $stmt = null;
    }

    // Creating function to check if user exists
    protected function checkUser($email){
        // Creating SQL query
        $query = "SELECT * FROM users where users_email = ?;";
        // connecting to the database and preparing statement
        $stmt = $this->connect()->prepare($query);

        // Execitung the statement and replacing question marks with variables (array)
        if(!$stmt->execute([$email])){
            $stmt = null;
            header("../signup.php?stmt=failed");
            exit();
        }

        // If user exists set result to false otherwise to true
        global $result;
        if($stmt->rowCount() > 0){
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    protected function getUserId($email){
        // Creating SQL query
        $query = "SELECT users_id FROM users  WHERE users_email=?;";
        // connecting to the database and preparing statement
        $stmt = $this->connect()->prepare($query);

        // Execitung the statement and replacing question marks with variables (array)
        if(!$stmt->execute([$email])){
            $stmt = null;
            header("../signup.php?stmt=failed");
            exit();
        }

        /// Checking if user exists
        if($stmt->rowCount() == 0){
            $stmt = null;
            header("location: ../login.php?error=userNotFound");
            exit();
        }

        $user = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $user;
    }
}