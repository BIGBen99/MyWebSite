<?php $title = 'Mon blog'; ?>

<?php ob_start(); ?>

    <?php
foreach ($posts as $post):
?>
    <article class="news">
        <header>
        <h1>
            <?= htmlspecialchars($post['title']) ?>
            <time>le <?= $post['creation_date_fr'] ?></time>
        </h1>
        </header>
        <p>
            <?= nl2br(htmlspecialchars($post['content'])) ?>
            <br />
            <em><a href="?action=post&id=<?= $post['id'] ?>">Commentaires</a></em>
        </p>
    </article>
    <hr />
<?php
endforeach;
$posts->closeCursor();
?>
    
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
