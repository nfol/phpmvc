<?php

    class User extends Model {  
        
        public $user_id;
        public $name;
        public $password;
        public $role;

        function __construct() {
            parent::__construct();
            echo "User object initialized!<br/>";
        }
        
        function login($name, $password) {
            echo "login<br/>";
            try {
                $query = $this->dbh->prepare("SELECT user_id, role FROM users WHERE name = :name AND password = :password");
                $query->execute(array("name" => $name, "password" => md5($password)));
                if($query->rowCount()) {
                    echo "Érvényes login<br/>";
                    $result = $query->fetch();
                    $this->user_id = $result['user_id'];
                    $this->name = $name;
                    $this->role = $result['role'];
                    
                    $_SESSION['user_logged_in'] = TRUE;
                    $_SESSION['user_id'] = $this->user_id;
                    $_SESSION['user_name'] = $this->name;
                    $_SESSION['user_role'] = $this->role;
                    
                    return TRUE;
                }
                else {
                    echo "Hibás bejelentkezés<br/>";
                    return FALSE;
                }
            }
            catch(PDOException $e) {
                echo $e->getMessage();
            }
        }
        
        function logout() {
            echo $_SESSION['user_name'] . " (" . $_SESSION['user_role'] . ") logged out.<br/>";
            unset($_SESSION['user_id']);
            unset($_SESSION['user_name']);
            unset($_SESSION['user_role']);
            $_SESSION['user_logged_in'] = FALSE;
            session_destroy();
            header("Location: " . APP_HOST . "user/login");
        }
        
        function findAll() {
            
        }
        
        function findById($user_id) {
            
        }
        
        function findByName($user_name) {
            
        }
        
        function update() {
            
        }
        
        function delete() {
            
        }
        
        function create() {
            
        }

    }
    
?>