<?php

    require "models/post_model.php";

    class PostController extends Controller {

        function __construct() {
            $this->model = new Post();
            $this->view = new View();
        }
        
        function show($post_id = FALSE) {
            if(!$post_id) {
                $posts = $this->model->findAll();
                $this->view->render("post/list", $posts);
            }
            else {
                $post = $this->model->findById($post_id);
                if(!$post) {
                    header("Location: " . APP_HOST . "post/show");
                }
                $this->view->render("post/show", $post);
            }
        }
        
        function edit($post_id = FALSE) {
            if(!isset($_SESSION['user_logged_in']) || $_SESSION['user_role'] == "default") {
                header("Location: " . APP_HOST . "post/show");
            }
            if(!$post_id) {
                if(isset($_POST['save'])) {
                    print_r($_POST);
                    foreach($_POST as $key => $value) {
                        $this->model->$key = $value;
                    }
                    print_r($this->model);
                    $this->model->save();
                    print_r($this->model);
                    //header("Location: " . APP_HOST . "post/show");
                }
                else {
                    $this->view->render("post/edit");
                }
            }
            else {
                $this->model->post_id = $post_id;
                if(isset($_POST['update'])) {
                    print_r($_POST);
                    foreach($_POST as $key => $value) {
                        $this->model->$key = $value;
                    }
                    print_r($this->model);
                    $this->model->update();
                    //header("Location: " . APP_HOST . "post/show");
                }
                $post = $this->model->findById($post_id);
                if(!$post) {
                    header("Location: " . APP_HOST . "post/show");
                }
                $this->view->render("post/edit", $post);
            }
        }
        
        function delete($post_id) {
            if(!isset($_SESSION['user_logged_in']) || ($_SESSION['user_role'] == "default")) {
                header("Location: " . APP_HOST . "post/show");
            }
            else {
                $this->model->post_id = $post_id;
                $this->model->delete();
                header("Location: " . APP_HOST . "post/show");
            }
        }

    }
    
?>