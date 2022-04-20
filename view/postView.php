<?php $title = 'Mon blog - ' . $post['title']; ?>

<p><a href="?action=listPosts">Retour à la liste des billets</a></p>

<div class="news">
    <h2><?= htmlspecialchars($post['title']) ?> le <time><?= $post['creation_date'] ?></time></h2>
    <p><?= nl2br(htmlspecialchars($post['content'])) ?></p>
</div>
<hr />
<h2>Commentaires</h2>

<form action="?action=addComment&id=<?= $post['id'] ?>" method="post">
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
        if(isset($commentId) && $comment['id'] == $commentId) {
?>
    <form action="?action=updateComment&postId=<?= $post['id'] ?>&commentId=<?= $comment['id'] ?>" method="post">
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