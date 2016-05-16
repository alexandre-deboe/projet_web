<?php
session_start();

$nomBase=$_SESSION['nomBase'];
$bdUser=$_SESSION['bdUser'];
$bdPass=$_SESSION['bdPass'];

$login = $_SESSION['userLogin'];

if ((!isset($_POST['login'])) | ($_POST['login'] == ""))
	header('Location: GestionCompte.php?error=v');
	
else {
	$newLogin=$_POST['login'];
	$newPrenom=pg_escape_string($_POST['prenom']);
	$newNom=pg_escape_string($_POST['nom']);
	$newPoste=pg_escape_string($_POST['poste']);
	$newMdp=$_POST['mdp'];
	
	if ($DB = pg_connect("host=localhost user=$bdUser dbname=$nomBase password=$bdPass")) {
		$requete_login = "UPDATE diese SET login='$newLogin' WHERE login='$login'";
		$reponse_login = pg_query($DB,$requete_login);
		
		if ($reponse_login) {
			$requete_data = "UPDATE diese SET prenom='$newPrenom', nom='$newNom', poste='$newPoste' WHERE login='$newLogin'";
			$reponse_data = pg_query($DB,$requete_data);
			
			if ($reponse_data && $newMdp != "") {
				$requete_mdp = "UPDATE diese SET mdp='".SHA1($newMdp)."' WHERE login='$newLogin'";
				$reponse_mdp = pg_query($DB,$requete_mdp);
			}
			else 
				header('Location: GestionCompte.php?error=r');
			
			$_SESSION['userNom']=$newNom;
			$_SESSION['userPrenom']=$newPrenom;
			$_SESSION['userLogin']=$newLogin;
			$_SESSION['userPoste']=$newPoste;
			header('Location: GestionCompte.php?error=s');
		}
		else
			header('Location: GestionCompte.php?error=d');
		
		pg_close($DB);
	}
	else
		header('Location: GestionCompte.php?error=b');
}		
	
?>