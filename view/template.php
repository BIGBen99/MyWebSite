<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <base href="<?= $webRoot ?>">
        <link href="public/css/style.css" rel="stylesheet" /> 
        <title><?= $title ?></title>
    </head>
        
    <body>
        <div id="global">
            <header>
                <a href="/"><h1 id="titreBlog">Mon super blog !</h1></a>
                <p>Je vous souhaite la bienvenue sur ce modeste blog.</p>
            </header>
            <nav>
                <a href="/">Home</a>
                <a href="/entity/index">Entities</a>
            </nav>
            <div id="contenu">
                <?= $content ?>
            </div> <!-- #contenu -->
            <footer id="piedBlog">
                Blog réalisé avec PHP, HTML5 et CSS.
            </footer>
        </div> <!-- #global -->
    </body>
</html>
