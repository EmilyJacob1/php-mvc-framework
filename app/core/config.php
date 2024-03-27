<?php
class Database {
    private $host = 'localhost';
    private $dbname = 'cinema';
    private $username = 'root';
    private $password = '';
    private $conn;

    public function getConnection() {
        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->dbname);

        if ($this->conn->connect_error) {
            die('Connection failed: ' . $this->conn->connect_error);
        }

        return $this->conn;
    }
}
