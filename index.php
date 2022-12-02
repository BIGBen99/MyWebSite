<?php
  require '../dev.ini';
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
  	// Connexion à la base de données
  	try
  	{
      	$bdd = new PDO($dsn, $username, $password);
  	}
  	catch(Exception $e){
        	die( 'Erreur : '.$e->getMessage()   );
  	}

  	// On récupère les 5 derniers billets
  	$req = $bdd->query('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS date_creation_fr FROM posts ORDER BY creation_date DESC LIMIT 0, 5');

  	while ($donnees = $req->fetch())
  	{
  	?>
  	<div class="news">
     	<h3>
        	<?php echo htmlspecialchars($donnees['title']); ?>
        	<em>le <?php echo $donnees['date_creation_fr']; ?></em>
     	</h3>
     	<p>
     	<?php
     	// On affiche le contenu du billet
            	echo	nl2br ( htmlspecialchars( $donnees['content']), false);
     	?>
     	<br>
     	<em><a href="#">Commentaires</a></em>
     	</p>
  	</div>
  	<?php
  	} // Fin de la boucle des billets
  	$req->closeCursor();
    ?>
   </body>
</html>
