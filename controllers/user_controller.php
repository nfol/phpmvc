<?php

    require "models/user_model.php";

    class UserController extends Controller {

        function __construct() {
            echo "UserController object initialized!<br/>";
            $this->model = new User();
        }
        
        function login() {
            if(isset($_POST['submit'])) {
                echo "Submit<br/>";
                $this->model->login($_POST['name'], $_POST['password']);
                }
            if(isset($_SESSION['user_logged_in'])) {
                echo "Helló " . $_SESSION['user_name'] . " (" . $_SESSION['user_role'] . ")<br/>";
            }
            echo "Login form goes here<br/>";
            echo "<form method=\"post\" action=\"" . APP_HOST . "user/login\">\n";
            echo "<input type=\"text\" name=\"name\"/><br/>\n";
            echo "<input type=\"password\" name=\"password\"/><br/>\n";
            echo "<input type=\"submit\" name=\"submit\" value=\"Login\"/>\n";
            echo "</form>";
            if(isset($_SESSION['user_logged_in'])) {
                echo "<a href=\"" . APP_HOST . "user/logout\">Log out</a>";
            }
        }
        
        function logout() {
            $this->model->logout();
        }
        
    }
    
?>