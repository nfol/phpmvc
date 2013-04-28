<?php $posts = $data; ?>

<h1>Bejegyzések listája</h1>

<?php
    if($posts) {
        echo "<ul>";
        foreach($posts as $post) {
            echo "<li>" . $post['title'] .
                " <a href=\"" . APP_HOST . "post/show/" . $post['post_id'] . "\">Mutat</a>";
                if(isset($_SESSION['user_logged_in']) && ($_SESSION['user_role'] != "default")) {
                    echo " <a href=\"" . APP_HOST . "post/edit/" . $post['post_id'] . "\">Szerkeszt</a>" .
                " <a href=\"" . APP_HOST . "post/delete/" . $post['post_id'] . "\" onClick=\"return confirm('Biztosan törölni szeretnéd?')\">Töröl</a></li>";
                }
        }
        echo "</ul>";
    }
    else echo "Nincsenek bejegyzések!";
    
    if(isset($_SESSION['user_logged_in']) && ($_SESSION['user_role'] != "default")) {
        echo "<a href=\"" . APP_HOST . "post/edit\">Új bejegyzés</a>";
    }
?>