<?php

    class Post extends Model {
        
        public $post_id;
        public $author_id;
        public $created_at;
        public $title;
        public $slug;
        public $content;
        public $status;
        private $comments;

        function __construct() {
            parent::__construct();
            return $this;
        }
        
        function findById($post_id) {
            try {
                $query = $this->dbh->prepare("
                    SELECT * 
                    FROM posts 
                    WHERE post_id = :post_id
                    ");
                $query->execute(array("post_id" => $post_id));
                if($query->rowCount()) {
                    foreach($query->fetch() as $key => $value) {
                        $this->$key = $value;
                    }
                }
                else {
                    return FALSE;
                }
            }
            catch(PDOException $e) {
                echo $e->getMessage();
            }
            return $this;
        }
        
        function findComments() {
            try {
                $query = $this->dbh->prepare("
                    SELECT * 
                    FROM comments 
                    WHERE post_id = :post_id 
                    ORDER BY comment_id
                    ");
                $query->execute(array("post_id" => $this->post_id));
                if($query->rowCount()) {
                    $this->comments = array();
                    foreach($query as $key => $value) {
                        $comment = new Comment();
                        $comment->$key = $value;
                        $this->comments[] = $comment;
                    }
                }
                else {
                    return FALSE;
                }
            }
            catch(PDOException $e) {
                echo $e->getMessage();
            }
            return $this->comments;
        }
        
        function findAll() {
            try {
                $query = $this->dbh->prepare("
                    SELECT * 
                    FROM posts 
                    ORDER BY post_id
                    ");
                $query->execute();
                if($query->rowCount()) {
                    $posts = $query->fetchAll();
                }
                else {
                    return FALSE;
                }
            }
            catch(PDOException $e) {
                echo $e->getMessage();
            }
            return $posts;
        }
        
        function save() {
            $tz = ini_get("date.timezone");
            $dtz = new DateTimeZone($tz);
            $dt = new DateTime("now", $dtz);
            $this->created_at = $dt->format("Y-m-d h:i:s");
            try {
                $query = $this->dbh->prepare("
                    INSERT INTO posts 
                    (`author_id`, `created_at`, `title`, `slug`, `content`, `status`)
                    VALUES (:author_id, :created_at, :title, :slug, :content, :status)
                    ");
                $query->execute(array(
                    "author_id" => $this->author_id,
                    "created_at" => $this->created_at,
                    "title" => $this->title,
                    "slug" => $this->slug,
                    "content" => $this->content,
                    "status" => $this->status));
            }
            catch(PDOException $e) {
                echo $e->getMessage();
            }
            return true;
        }
        
        function update() {
            try {
                $query = $this->dbh->prepare("
                    UPDATE posts 
                    SET author_id = :author_id, title = :title, slug = :slug, content = :content, status = :status 
                    WHERE post_id = :post_id
                    ");
                $query->execute(array(
                    "post_id" => $this->post_id,
                    "author_id" => $this->author_id,
                    "title" => $this->title,
                    "slug" => $this->slug,
                    "content" => $this->content,
                    "status" => $this->status));
            }
            catch(PDOException $e) {
                echo $e->getMessage();
            }
            return $this;
        }
        
        function delete() {
            try {
                $query = $this->dbh->prepare("DELETE FROM posts WHERE post_id = :post_id");
                $query->execute(array("post_id" => $this->post_id));
            }
            catch(PDOException $e) {
                echo $e->getMessage();
            }
            return true;
        }

    }
    
?>