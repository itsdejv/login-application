<?php

class DbConn
{
    protected function connect(){
        try {
            $host = "localhost";
            $username = "root";
            $password = "";
            $dbName = "LoginApplication";
            $dbh = new PDO('mysql:host=' . $host .';dbname=' . $dbName, $username, $password);
            return $dbh;
        }
        catch (PDOException $e){
            print "Error!: " . $e->getMessage() . "</br>";
            die();
        }
    }
}