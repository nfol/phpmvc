<?php

    class Database {

        private $dbh;
        public static $instance = NULL;

        private function __construct() {
            $this->dbh = new PDO("mysql:host=localhost;dbname=mvc2", "root", "");
            $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->dbh->query("SET NAMES utf8");
        }

        public static function getInstance() {
            if(!isset(self::$instance)) {
                self::$instance = new Database();
            }
            return self::$instance;
        }
        
        public function prepare($statement) {
            try {
                return $this->dbh->prepare($statement);
            }
            catch(PDOException $e) {
                echo $e->getMessage();
                return FALSE;
            }
        }
        
    }
  
?>