<?php
session_start();
if (!isset($_SESSION['userLogin'])){header('Location: identification.php');}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<link href="bootstrap/css/bootstrap.css" rel="stylesheet"/>
	<link href="test2.css" rel="stylesheet" />
	<script src="jquery-ui-1.11.4.custom/jquery-2.2.3.min.js"></script>
    <script src="jquery-ui-1.11.4.custom/jquery-ui.js"></script>
    <link href="jquery-ui-1.11.4.custom/jquery-ui.css" rel="stylesheet" />
	<script src="bootstrap/js/bootstrap.min.js"></script>
	<title>Accueil</title>
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
					<li class="dropdown active">
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

<form id="1" action="details.php">
	<div class="entreprise">
		<label for="Entreprise" id="12" >Rechercher :</label>
		<input type="text" id="entreprise" name="ref" size="30"/>
		<input class="btn btn-primary" onclick="redirige()" onKeyPress="if(event.keyCode == 13) redirige();" type="submit" id="11" value="Submit">
	</div> 
</form>

<script type="text/javascript">
function redirige(){
    var champ = document.getElementById("entreprise");
    var str = champ.value;
    str= str.split(" ",1);

    champ.value=str;

}

$('#entreprise').autocomplete({
        source: 'complete_page_accueil.php',
        minLength: 2,
        dataType: 'json'
    });

</script>
<div class="col-md-6 col-md-offset-3">
<table class="table table-hover">

<?php

function barre_naviga ($nb_total,
						   $nb_affichage_par_page,
						   $debut,
						   $nb_liens_dans_la_barre) {

	$barre = '';
	// on recherche l'URL courante munie de ses paramètre auxquels on ajoute le paramètre 'debut' qui jouera le role du premier élément de notre LIMIT
	if ($_SERVER['QUERY_STRING'] == "") {
		$query = $_SERVER['PHP_SELF'].'?debut=';
	}
	else {
		$tableau = explode ("debut=", $_SERVER['QUERY_STRING']);
		$nb_element = count ($tableau);
		if ($nb_element == 1) {
			$query = $_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'].'&debut=';
		}
		else {
			if ($tableau[0] == "") {
				$query = $_SERVER['PHP_SELF'].'?debut=';
			}
			else {
				$query = $_SERVER['PHP_SELF'].'?'.$tableau[0].'debut=';
			}
		}
	}

	// on calcul le numéro de la page active
	$page_active = floor(($debut/$nb_affichage_par_page)+1);
	// on calcul le nombre de pages total que va prendre notre affichage
	$nb_pages_total = ceil($nb_total/$nb_affichage_par_page);

	// on calcul le premier numero de la barre qui va s'afficher, ainsi que le dernier ($cpt_deb et $cpt_fin)
	// exemple : 2 3 4 5 6 7 8 9 10 11 << $cpt_deb = 2 et $cpt_fin = 11
	if ($nb_liens_dans_la_barre%2==0) {
		$cpt_deb1 = $page_active - ($nb_liens_dans_la_barre/2)+1;
		$cpt_fin1 = $page_active + ($nb_liens_dans_la_barre/2);
	}
	else {
		$cpt_deb1 = $page_active - floor(($nb_liens_dans_la_barre/2));
		$cpt_fin1 = $page_active + floor(($nb_liens_dans_la_barre/2));
	}

	if ($cpt_deb1 <= 1) {
		$cpt_deb = 1;
		$cpt_fin = $nb_liens_dans_la_barre;
	}
	elseif ($cpt_deb1>1 && $cpt_fin1<$nb_pages_total) {
		$cpt_deb = $cpt_deb1;
		$cpt_fin = $cpt_fin1;
	}
	else {
		$cpt_deb = ($nb_pages_total-$nb_liens_dans_la_barre)+1;
		$cpt_fin = $nb_pages_total;
	}

	if ($nb_pages_total <= $nb_liens_dans_la_barre) {
		$cpt_deb=1;
		$cpt_fin=$nb_pages_total;
	}

	// si le premier numéro qui s'affiche est différent de 1, on affiche << qui sera un lien vers la premiere page
	if ($cpt_deb != 1) {
		$cible = $query.(0);
		$lien = '<A HREF="'.$cible.'">&lt;&lt;</A>&nbsp;&nbsp;';
	}
	else {
		$lien='';
	}
	$barre .= $lien;

	// on affiche tous les liens de notre barre, tout en vérifiant de ne pas mettre de lien pour la page active
	for ($cpt = $cpt_deb; $cpt <= $cpt_fin; $cpt++) {
		if ($cpt == $page_active) {
			if ($cpt == $nb_pages_total) {
				$barre .= $cpt;
			}
			else {
				$barre .= $cpt.'&nbsp;-&nbsp;';
			}
		}
		else {
			if ($cpt == $cpt_fin) {
				$barre .= "<A HREF='".$query.(($cpt-1)*$nb_affichage_par_page);
				$barre .= "'>".$cpt."</A>";
			}
			else {

				$barre .= "<A HREF='".$query.(($cpt-1)*$nb_affichage_par_page);
				$barre .= "'>".$cpt."</A>&nbsp;-&nbsp;";
			}
		}
	}

	$fin = ($nb_total - ($nb_total % $nb_affichage_par_page));
	if (($nb_total % $nb_affichage_par_page) == 0) {
		$fin = $fin - $nb_affichage_par_page;
	}

	// si $cpt_fin ne vaut pas la dernière page de la barre de navigation, on affiche un >> qui sera un lien vers la dernière page de navigation
	if ($cpt_fin != $nb_pages_total) {
		$cible = $query.$fin;
		$lien = '&nbsp;&nbsp;<A HREF="'.$cible.'">&gt;&gt;</A>';
	}
	else {
		$lien='';
	}
	$barre .= $lien;

	return $barre;
}


/*connexion bd*/
error_reporting(E_ALL);
ini_set('display_errors', 1);
include ("connexion.php");
$_SESSION['nomBase']=$nomBase;
$_SESSION['bdUser']=$bdUser;
$_SESSION['bdPass']=$bdPass;
if ($bd=pg_connect("host=localhost user=$bdUser dbname=$nomBase password=$bdPass")){
// on prépare une requête permettant de calculer le nombre total d'éléments qu'il faudra afficher sur nos différentes pages
$sql  = "SELECT count(*) FROM etude WHERE tag='En cours'";
// on exécute cette requête
$resultat = pg_query($sql);

// on récupère le nombre d'éléments à afficher
$nb_total = pg_fetch_array($resultat);

// on teste si ce nombre de vaut pas 0
if (($nb_total = $nb_total[0]) == 0) {
	echo 'Aucune réponse trouvée';
}
else 
{

	// sinon, on regarde si la variable $debut (le x de notre LIMIT) n'a pas déjà été déclarée, et dans ce cas, on l'initialise à 0
	if (!isset($_GET['debut'])) {$_GET['debut'] = 0;}

	$nb_affichage_par_page = 4;
$ou=$_GET['debut'];
$requete="select reference,entreprise,date_debut from etude,client where etude.id_client=client.id and tag='Terminée' order by date_debut DESC LIMIT $nb_affichage_par_page OFFSET $ou";
$C_service=pg_query($bd,$requete); 
    if ($C_service)
    {

   while ($tupleServ=pg_fetch_array($C_service)){
   	      $reference=$tupleServ['reference'];
        $entreprise=$tupleServ['entreprise'];
        $date_debut=$tupleServ['date_debut'];


       echo "<tr onclick=\"document.location='details.php?ref=$reference'\">
                <td class=\"active\">$reference</td>
                <td class=\"active\">$entreprise</td>
                <td class=\"active\">Date début : $date_debut</td>
              </tr>";
    }
}?>
</table>
</div>
<div class="pagination">
  <?php
    // on affiche enfin notre barre
	echo barre_naviga($nb_total, $nb_affichage_par_page, $ou, 3);
}
// on libère l'espace mémoire alloué pour cette requête
pg_free_result ($resultat);
// on ferme la connexion à la base de données.
pg_close ();
}
else { echo "Impossible de se connecter à la base de données";}


?>
</div>

	<footer class="navbar navbar-inverse navbar-fixed-bottom">
		<a class="navbar-brand">Diese</a>
	</footer>

</body>

</html>
