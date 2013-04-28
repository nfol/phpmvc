<?php $post = $data; ?>

<h1><?= $post->post_id . ": " . $post->title ?></h1>

<?= $post->content ?>

<hr/>

<a href="<?= APP_HOST ?>post/show">Vissza</a>
