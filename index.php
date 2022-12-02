<?php
  require '../dev.ini';

  try {
	  $database = new PDO($dsn, $username, $password);
  } catch(Exception $e) {
	  die('Erreur : '.$e->getMessage());
  }

  $statement = $database->query(
	  "SELECT id, title, content, DATE_FORMAT(creation_date, '%d/%m/%Y à %Hh%imin%ss') AS date_creation_fr FROM posts ORDER BY creation_date DESC LIMIT 0, 5"
  );
$posts = [];
while (($row = $statement->fetch())) {
	$post = [
    	'title' => $row['title'],
    	'french_creation_date' => $row['date_creation_fr'],
    	'content' => $row['content'],
	];

	$posts[] = $post;
}

?>

<!DOCTYPE html>
<html lang="fr">
	<head>
    	<meta charset="utf-8">
    	<title>Le blog de l'AVBN</title>
    	<link href="style.css" rel="stylesheet">
	</head>

	<body>
    	<h1>Le super blog de l'AVBN !</h1>
    	<p>Derniers billets du blog :</p>

    	<?php
    	foreach ($posts as $post) {
    	?>
        	<div class="news">
            	<h3>
                	<?php echo htmlspecialchars($post['title']); ?>
                	<em>le <?php echo $post['french_creation_date']; ?></em>
            	</h3>
            	<p>
                	<?php
                	echo nl2br(htmlspecialchars($post['content']), false);
                	?>
                	<br />
                	<em><a href="#">Commentaires</a></em>
            	</p>
        	</div>
    	<?php
    	}
    	?>
	</body>
</html>
