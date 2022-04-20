<?php $this->title = 'Mon blog'; ?>

<?php foreach ($posts as $post): ?>
    <article class="news">
        <header>
            <a href="?action=post&id=<?= $post['id'] ?>"><h2><?= htmlspecialchars($post['title']) ?> le <time><?= $post['creation_date'] ?></time></h2></a>
        </header>
        <p>
            <?= nl2br(htmlspecialchars($post['content'])) ?>
            <br />
            <em>Commentaires</em>
        </p>
    </article>
    <hr />
<?php endforeach; ?>