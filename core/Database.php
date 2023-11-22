<?php
class Database {
    protected $connection;

    public function __construct() {
        $this->connection = new mysqli("localhost", "root", "", "url_shortener");
        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }
    }
    public function getConnection() {
        return $this->connection;
    }
}