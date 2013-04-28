<?php

    require "helpers/database.php";

    class Model {
        
        public $dbh;

        function __construct() {
            $this->dbh = Database::getInstance();
        }

    }

?>
