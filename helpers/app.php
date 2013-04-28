<?php

    require "helpers/controller.php";

    class App {

        function __construct() {
            
        }
        
        function run() {
            session_start();
            header("Content-Type: text/html; charset=UTF-8");
            
            // Szétbontjuk az URL-t paraméterekre
            if(isset($_GET['url'])) {
                $url = explode("/", rtrim($_GET['url'], "/"));
                               
                // A paraméterek alapján példányosítjuk az osztályt és hívjuk a metódusát, ha létezik
                if(isset($url[1])) {
                    try {
                        require "controllers/" . $url[0] . "_controller.php";
                        $controller_class = ucfirst($url[0]) . "Controller";
                        $controller = new $controller_class();
                        $controller->$url[1]((isset($url[2]) ? $url[2] : FALSE));
                    }
                    catch(Exception $e) {
                        echo $e->getMessage();
                    }
                }
                else {
                    echo "404";
                }
            }
            else {
                echo "The query string is empty!<br/>"; //
            }
        }

    }
    
?>