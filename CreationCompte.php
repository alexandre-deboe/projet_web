<?php
session_start();

$nomBase=$_SESSION['nomBase'];
$bdUser=$_SESSION['bdUser'];
$bdPass=$_SESSION['bdPass'];

function minSansAccent($str) {
	$str = strtolower($str);
	$str = str_replace(
			array(' ','à','â','ä','á','ã','å','î','ï','ì','í','ô','ö','ò','ó','õ','ø','ù','û','ü','ú','é','è','ê','ë','ç','ÿ','ñ'),
			array('','a','a','a','a','a','a','i','i','i','i','o','o','o','o','o','o','u','u','u','u','e','e','e','e','c','y','n'),$str);
	$str = preg_replace('/[^a-z0-9\s]/','',$str);
	return $str;
}

if ((!isset($_POST['mdp'])) | ($_POST['mdp'] == ""))
	header('Location: identification.php?error=t');

else {
	$prenom=pg_escape_string($_POST['prenom']);
	$nom=pg_escape_string($_POST['nom']);
	$poste=pg_escape_string($_POST['poste']);
	$mdp=SHA1($_POST['mdp']);
	
	$login = minSansAccent($prenom).'.'.minSansAccent($nom);
	
	if ($DB = pg_connect("host=localhost user=$bdUser dbname=$nomBase password=$bdPass")) {
		$verif = pg_query($DB,"SELECT * FROM diese where login='$login'");
		
		if (!$verif)
			header('Location: identification.php?error=n');
		
		elseif (pg_num_rows($verif) == 0) {
			$requete = "INSERT INTO diese (nom,prenom,login,poste,mdp,statut) VALUES ('$nom','$prenom','$login','$poste','$mdp','user')";
			$reponse = pg_query($DB,$requete);
		
			if ($reponse)
				header('Location: identification.php?error=s');
			else
				header('Location: identification.php?error=i');
		}
		
		else
			header('Location: identification.php?error=d');
			
		pg_close($DB);
	}
	else
		header('Location: identification.php?error=f');
}
?>