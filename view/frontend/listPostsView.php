<?php $title = 'Mon blog'; ?>

<?php ob_start(); ?>
<div id="global">
    <header>
        <a href="/"><h1 id="titreBlog">Mon super blog !</h1></a>
        <p>Je vous souhaite la bienvenue sur ce modeste blog.</p>
    </header>
    <div id="contenu">
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
<?php
endforeach;
$posts->closeCursor();
?>
    
    </div> <!-- #contenu -->
    <footer id="piedBlog">
        Blog réalisé avec PHP, HTML5 et CSS.
    </footer>
</div> <!-- #global -->
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
