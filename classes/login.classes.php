<?php

class Login extends DbConn
{
    // Getting user
    protected function getUser($email, $pwd){
        // SQL query
        $query = "SELECT users_pwd FROM users WHERE users_email = ?;";
        
        // Connecting to database and preparing statement (SQL_INJECTION protection)
        $stmt = $this->connect()->prepare($query);

        // Execitung the statement and replacing question marks with variables (array)
        if(!$stmt->execute([$email])){
            $stmt = null;
            header("../login.php?stmt=failed");
            exit();
        }

        // Checking if user exists
        if($stmt->rowCount() == 0){
            $stmt = null;
            header("location: ../login.php?error=userNotFound");
            exit();
        }

        // Fetching getted information into assoc
        $user = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $checkPwd = password_verify($pwd, $user[0]["users_pwd"]);

        // If password doesn't match with a password in database
        if($checkPwd == false){
            $stmt = null;
            header("location: ../login.php?password=wrong");
            exit();
        }
        // If password matches with password in database
        else if ($checkPwd == true){
            $query = "SELECT * FROM users WHERE users_email = ? and users_pwd = ?;";

            // Connecting to database and preparing statement (SQL_INJECTION protection)
            $stmt = $this->connect()->prepare($query);

            // Execitung the statement and replacing question marks with variables (array)
            if(!$stmt->execute([$email, $user[0]["users_pwd"]])){
                $stmt = null;
                header("../login.php?stmt=failed");
                exit();
            }

            // Checking if user exists
            if($stmt->rowCount() == 0){
                $stmt = null;
                header("location: ../login.php?error=userNotFound");
                exit();
            }

            $user = $stmt->fetchAll(PDO::FETCH_ASSOC);

            session_start();
            $_SESSION["userId"] = $user[0]["users_id"];
            $_SESSION["userFirstName"] = $user[0]["users_firstName"];
            $_SESSION["userSecondName"] = $user[0]["users_secondName"];
            $_SESSION["userEmail"] = $user[0]["users_email"];
            $_SESSION["userDOB"] = $user[0]["users_dateOfBirth"];

            if(isset($_SESSION["userId"])){
                $query = "SELECT * FROM profiles WHERE users_id = ?;";

                // Connecting to database and preparing statement (SQL_INJECTION protection)
                $stmt = $this->connect()->prepare($query);

                // Execitung the statement and replacing question marks with variables (array)
                if(!$stmt->execute([$_SESSION["userId"]])){
                    $stmt = null;
                    header("../login.php?stmt=failed");
                    exit();
                }

                // Checking if user exists
                if($stmt->rowCount() == 0){
                    $stmt = null;
                    header("location: ../login.php?error=userNotFound");
                    exit();
                }

                $user = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $_SESSION["profileImg"] = $user[0]['profiles_img'];
            }

            $stmt = null;

            header("location: ../index.php");
        }

    }
}