<?php
session_start();

$nomBase=$_SESSION['nomBase'];
$bdUser=$_SESSION['bdUser'];
$bdPass=$_SESSION['bdPass'];

if ((!isset($_POST['mdp'])) | ($_POST['mdp'] == ""))
	header('Location: identification.php?error=v');

else {
	$login=$_POST['login'];
	$mdp=SHA1($_POST['mdp']);

	if ($DB = pg_connect("host=localhost user=$bdUser dbname=$nomBase password=$bdPass")) {
		$requete = "SELECT * FROM diese WHERE login='$login'";
		$reponse = pg_query($DB,$requete);
		pg_close($DB);
		
		if ($reponse) {
			$tuple = pg_fetch_assoc($reponse);

			if ($tuple) {
				if ($tuple['mdp'] == $mdp) {
	 				$_SESSION['userNom']=$tuple['nom'];
	 				$_SESSION['userPrenom']=$tuple['prenom'];
	 				$_SESSION['userLogin']=$tuple['login'];
	 				$_SESSION['userPoste']=$tuple['poste'];
	 				$_SESSION['userStatut']=$tuple['statut'];
	 				header('Location: page_accueil.php');	
				}
				else
					header('Location: identification.php?error=m');
			}
			
			else 
				header('Location: identification.php?error=u');
		}
		
		else
			header('Location: identification.php?error=r');
	}
	
	else
		header('Location: identification.php?error=b');
}

?>