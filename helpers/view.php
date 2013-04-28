<?php

    class View {

        function __construct() {
            //echo "View object initialized!<br/>";
        }
        
        function render($view, $data = FALSE) {
            $view_file = "views/" . $view . ".php";
            if(file_exists($view_file)) {
                require $view_file;
            }
        }

    }
    
?>