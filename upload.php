<?php 
session_start();

if (!isset($_SESSION['userLogin'])){header('Location: identification.php');}

$nomBase=$_SESSION['nomBase'];
$bdUser=$_SESSION['bdUser'];
$bdPass=$_SESSION['bdPass'];

$ref = $_POST['reference'];
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="description" content="détails etude">
        <meta name="author" content="Diese">

        <title>Ajout de document <?php echo $ref; ?></title>

        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="details.css" rel="stylesheet">

  </head>

    <body>

	<nav class="navbar navbar-inverse navbar-fixed-top">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
		            <span class="sr-only">Toggle navigation</span>
		            <span class="icon-bar"></span>
		            <span class="icon-bar"></span>
		            <span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="page_accueil.php"><strong>Gestion des Etudes</strong></a>
			</div>
	        <div id="navbar" class="navbar-collapse collapse">
				<ul class="nav navbar-nav">
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Liste des études<span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="page_accueil.php">Etudes en cours</a></li>
							<li><a href="page_accueil_terminees.php">Etudes terminées</a></li>
						</ul>
					</li>
					<li><a href="formulaire_etude.php">Ajouter une étude</a></li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Mon compte<span class="caret"></span></a>
						<ul class="dropdown-menu">
	          				<li class="dropdown-header"><strong>Connecté en tant que</strong></li>
	            			<li><a href="GestionCompte.php"><?php echo $_SESSION['userLogin'];?></a></li>
	            			<li role="separator" class="divider"></li>
	            			<li><a href="GestionCompte.php">Gestion du compte</a></li>
	            			<li><a href="deconnexion.php">Déconnexion</a></li>
          				</ul>
					</li>
				</ul>
			</div>
		</div>
	</nav>

    <div class="jumbotron">
      <div class="container">
        <h1 class="page-header">Ajout de document <small><?php echo $ref; ?></small></h1></br>

          <?php

            $dossier = 'uploads/'.$_POST['reference'].'/';
            if(!is_dir($dossier)){
                mkdir($dossier);
            }

            $target_dir = $dossier;
            $target_file = $target_dir . basename($_POST['reference']." - ".$_POST['type']);
            $uploadOk = 1;

            // verifie si un fichier a ete selectionne
            if (!$_FILES["fileToUpload"]) {
                echo "<p>Aucun fichier n'a ete selectionne !";
                $uploadOk = 0;
            }

            // verifie si le fichier existe deja
            if (file_exists($target_file)) {
                echo "<p>Désolé, le fichier existe déjà !";
                $uploadOk = 0;
            }
            // cerifie la taille du fichier
            if ($_FILES["fileToUpload"]["size"] > 5000000) {
                echo "<p>Désolé, le fichier est trop volumineux !";
                $uploadOk = 0;
            }

            // verifie s'il y a une erreur
            if ($uploadOk == 0) {
                echo '
                     Il n\'a pas pu être uploadé.</p>
                    <p><a class="btn btn-info btn-lg" role="button" onclick="document.location.href=\'details.php?ref='.$_POST['reference'].'\'">Retour à l\'upload</a></p>
                    ';
            // si tout est bon, essaye d'upload le fichier
            } else {
                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                    echo '
                        <p>Le fichier "'. basename($_POST['reference']." - ".$_POST['type']). '" a bien été uploadé.</p>
                        <p><a class="btn btn-success btn-lg" role="button" onclick="document.location.href=\'details.php?ref='.$_POST['reference'].'\'">Retour aux détails de l\'étude</a></p>
                        ';
                
                    include('connexion.php');

                        // Connexion à la base de données
                    try {
                        $bdd = (pg_connect("host=localhost user=$bdUser dbname=$nomBase password=$bdPass"));
                    }
                    catch(Exception $e) {
                        exit('Impossible de se connecter à la base de données.');
                    }

                    $requete = "INSERT INTO document(reference_etude,typedocument,lien,tag) VALUES ('".$_POST['reference']."','".$_POST['type']."','".$dossier."','a relire')";
                    pg_query($bdd, $requete);

                    pg_close($bdd);

                } else {
                    echo '
                        <p>Désolé, il y a eu une erreur dans l\'upload du fichier.</p>
                        <p><a class="btn btn-info btn-lg" role="button" onclick="document.location.href=\'details.php?ref='.$_POST['reference'].'\'">Retour à l\'upload</a></p>
                        ';
                }
            }
          ?> 

      </div>
    </div>
  </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="bootstrap/js/bootstrap.min.js"></script>

    </body>

    <footer class="navbar navbar-inverse navbar-fixed-bottom">
            <a class="navbar-brand" href="#">Diese</a>
    </footer>

</html>