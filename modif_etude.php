<?php

session_start();

if (!isset($_SESSION['userLogin'])){header('Location: identification.php');}


if ($_SESSION['userStatut'] != 'admin'){header('Location: page_accueil.php');}

$nomBase=$_SESSION['nomBase'];
$bdUser=$_SESSION['bdUser'];
$bdPass=$_SESSION['bdPass'];

?>

<!DOCTYPE html>
<html lang="fr">
	<head>
    	<meta charset="utf-8">
    	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">

    	<meta name="description" content="détails etude">
    	<meta name="author" content="Diese">

    	<title>Détails de l'étude <?php echo $ref; ?></title>

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

	<?php

    $nom_client = $_POST['nom_client'];
    $prenom_client = $_POST['prenom_client'];
    $adresse_client = $_POST['adresse_client'];
    $tel_client = $_POST['tel_client'];
    $date_debut = $_POST['date_debut'];
    $date_fin = $_POST['date_fin'];
    $prix_jeh = $_POST['prix_jeh'];
    $nb_jeh = $_POST['nb_jeh'];
    $ref = $_POST['reference'];
    $c_id = $_POST['c_id'];

        // Connexion à la base de données
    try {
        $bdd = (pg_connect("host=localhost user=$bdUser dbname=$nomBase password=$bdPass"));
    }
    catch(Exception $e) {
      exit('Impossible de se connecter à la base de données.');
    }

    // Requête SQL
    $requete = "UPDATE etude SET nombre_JEH='$nb_jeh', prix_JEH='$prix_jeh', date_fin='$date_fin', date_debut='$date_debut'  WHERE reference='$ref'";

    // Exécution de la requête SQL
  	pg_query($bdd, $requete);

    $requete = "UPDATE client SET c_nom='$nom_client', c_prenom='$prenom_client', adresse='$adresse_client', telephone='$tel_client'  WHERE id='$c_id'";
    
    pg_query($bdd, $requete);

    pg_close($bdd);



  ?>

  <div class="jumbotron">
      <div class="container">
        <h1 class="page-header">Etude modifiée <small><?php echo $ref; ?></small></h1>
        <p><a class="btn btn-primary btn-lg" href="#" role="button" onclick="document.location.href='details.php?ref=<?php echo $ref; ?>'">Retour aux détails de l'étude</a></p>
      </div>
    </div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="bootstrap/js/bootstrap.min.js"></script>

	</body>

	<footer class="navbar navbar-inverse navbar-fixed-bottom">
			<a class="navbar-brand">Diese</a>
	</footer>

</html>