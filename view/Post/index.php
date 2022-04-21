<?php $title = 'Mon blog - ' . $post['title']; ?>

<p><a href="?action=listPosts">Retour à la liste des billets</a></p>

<div class="news">
    <h2><?= htmlspecialchars($post['title']) ?> le <time><?= $post['creation_date'] ?></time></h2>
    <p><?= nl2br(htmlspecialchars($post['content'])) ?></p>
</div>
<hr />
<h2>Commentaires</h2>

<form action="?action=addComment" method="post">
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
    <form action="?action=updateComment" method="post">
        <input type="hidden" name="post_id" value="<?= $post['id'] ?>">
        <input type="hidden" name="comment_id" value="<?= $comment['id'] ?>">
        <p><input type="text" id="author" name="author" value="<?= htmlspecialchars($comment['author']) ?>" /> le <?= $comment['comment_date'] ?></p>
        <p><textarea id="comment" name="comment"><?= nl2br(htmlspecialchars($comment['comment'])) ?></textarea></p>
        <input type="submit" />
    </form>
<?php
        } else {
?>
    <p><strong><?= htmlspecialchars($comment['author']) ?></strong> le <?= $comment['comment_date'] ?> (<a href="?action=modifyComment&postId=<?= $post['id'] ?>&commentId=<?= $comment['id'] ?>">modifier</a>)</p>
    <p><?= nl2br(htmlspecialchars($comment['comment'])) ?></p>
<?php
        }
    endforeach;
?>
