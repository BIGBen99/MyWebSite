<?php $title = 'Mon blog'; ?>

<?php ob_start(); ?>
<div id="global">
    <header>
        <a href="/"><h1 id="titreBlog">Mon super blog !</h1></a>
        <p>Je vous souhaite la bienvenue sur ce modeste blog.</p>
    </header>
    <div id="contenu">
    <?php
//while ($data = $posts->fetch())
foreach ($posts as $data):
//{
?>
    <article class="news">
        <header>
        <h1>
            <?= htmlspecialchars($data['title']) ?>
            <time>le <?= $data['creation_date_fr'] ?></time>
        </h1>
        </header>
        <p>
            <?= nl2br(htmlspecialchars($data['content'])) ?>
            <br />
            <em><a href="?action=post&id=<?= $data['id'] ?>">Commentaires</a></em>
        </p>
    </article>
<?php
//}
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
