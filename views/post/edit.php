<?php $post = $data; ?>

<h1>Edit post<?= (isset($post->post_id) ? " #" . $post->post_id : "") ?></h1>

<form method="post" action="<?= APP_HOST ?>post/edit<?= (isset($post->post_id) ? "/". $post->post_id : "") ?>">
    <input type="hidden" name="post_id" value="<?= (isset($post->post_id) ? $post->post_id : "") ?>"/><br/>
    author_id: <input type="text" name="author_id" value="<?= (isset($post->author_id) ? $post->author_id : $_SESSION['user_id']) ?>"/><br/>
    title: <input type="text" name="title" value="<?= (isset($post->title) ? $post->title : "") ?>"/><br/>
    slug: <input type="text" name="slug" value="<?= (isset($post->slug) ? $post->slug : "") ?>"/><br/>
    content: <textarea name="content"><?= (isset($post->content) ? $post->content : "") ?></textarea><br/>
    status: <input type="text" name="status" value="<?= (isset($post->status) ? $post->status : "") ?>"/><br/>
    <input type="submit" name="<?= (isset($post->post_id) ? "update" : "save") ?>" value="<?= (isset($post->post_id) ? "Update" : "Save") ?>"/>
</form>