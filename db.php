<?php
    class Database{
        private $conn;

        public function __construct(){
            $dsn = "mysql:host=127.0.0.1;dbname=hospital";
            $this->conn = new PDO($dsn, "root", "root@123");
            $this->conn -> setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        }

        public function getConnection(){
            return $this->conn;
        }
    }
?>