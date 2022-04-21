<?php $this->title = 'Mon blog'; ?>

<?php foreach ($posts as $post): ?>
    <article class="news">
        <header>
            <a href="post/index/<?= $post['id'] ?>"><h2><?= $this->clean($post['title']) ?> le <time><?= $this->clean($post['creation_date']) ?></time></h2></a>
        </header>
        <p>
            <?= $this->clean($post['content']) ?>
            <br />
            <em>Commentaires</em>
        </p>
    </article>
    <hr />
<?php endforeach; ?>
