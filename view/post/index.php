<?php $this->title = 'Mon blog - ' . $this->clean($post['title']); ?>

<p><a href="/">Retour à la liste des billets</a></p>

<div class="news">
    <h2><?= $this->clean($post['title']) ?> le <time><?= $this->clean($post['creation_date']) ?></time></h2>
    <p><?= $this->clean($post['content']) ?></p>
</div>
<hr />
<h2>Commentaires</h2>

<form action="/post/addComment" method="post">
    <input type="hidden" name="post_id" value="<?= $post['id'] ?>">
    <div>
        <label for="author">Auteur</label><br />
        <input type="text" id="author" name="author" />
    </div>
    <div>
        <label for="comment">Commentaire</label><br />
        <textarea id="comment" name="comment"></textarea>
    </div>
    <div>
        <input type="submit" />
    </div>
</form>

<?php
    foreach ($comments as $comment):
        if(isset($comment_id) && $comment['id'] == $comment_id) {
?>
    <form action="/post/updateComment" method="post">
        <input type="hidden" name="post_id" value="<?= $post['id'] ?>">
        <input type="hidden" name="comment_id" value="<?= $comment['id'] ?>">
        <p><input type="text" id="author" name="author" value="<?= htmlspecialchars($comment['author']) ?>" /> le <?= $comment['comment_date'] ?></p>
        <p><textarea id="comment" name="comment"><?= nl2br(htmlspecialchars($comment['comment'])) ?></textarea></p>
        <input type="submit" />
    </form>
<?php
        } else {
?>
    <p><strong><?= $this->clean($comment['author']) ?></strong> le <?= $this->clean($comment['comment_date']) ?> (<a href="/post/modidyComment/<?= $comment['id'] ?>">modifier</a>)</p>
    <p><?= $this->clean($comment['comment']) ?></p>
<?php
        }
    endforeach;
?>
