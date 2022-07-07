<?php

class Database {
    //Database Parameters
    private $host = 'localhost';
    private $database_name = 'Posty'
    private $username = 'root';
    private $password = '';
    private $conn;

    // Databae Connection
    public function connection() {
        $this->connection = null;

        try{
            $this->conn = new PDO('mysql:host='.$this->host .
            ';database_name='.$this->database_name,
            $this->username, $this->$password);
        } catch(PDOException $error) {
            echo 'Connection Error: ' . $error->getMessage();
        }

        return $this->connection
    }
}