<?php
include("connexion.php");

$_SESSION['nomBase']=$nomBase;
$_SESSION['bdUser']=$bdUser;
$_SESSION['bdPass']=$bdPass;

    if(($_GET['term'])!=null) {
        // Mot tapé par l'utilisateur
        $q = htmlentities($_GET['term']);

 
        // Connexion à la base de données
        try {
            $bdd = (pg_connect("host=localhost user=$bdUser dbname=$nomBase password=$bdPass"));
        } catch(Exception $e) {
			$suggestions[] = array();
			print json_encode($suggestions);
            exit('Impossible de se connecter à la base de données.');
        }
 
        // Requête SQL
        $requete = "SELECT * FROM intervenant WHERE (LOWER(nom) LIKE LOWER('%$q%'))";
 
        // Exécution de la requête SQL
        $resultat = pg_query($bdd, $requete);

        $suggestions[] = array();
        // On parcourt les résultats de la requête SQL
        while($donnees = pg_fetch_assoc($resultat)) {
            // On ajoute les données dans un tableau
            $nom = $donnees['nom'];
            $prenom = $donnees['prenom'];
            $suggestions[] = "$nom $prenom";
        }

        // On renvoie le données au format JSON pour le plugin
        print json_encode($suggestions);
        pg_close($bdd);
    }
    else {
        $suggestions[] = array();
        $suggestions[] = "Ca marche pas";
        print json_encode($suggestions);
    }
?>
