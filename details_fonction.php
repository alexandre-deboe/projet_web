<?php

function get_etude ($ref) {
	
	$nomBase=$_SESSION['nomBase'];
	$bdUser=$_SESSION['bdUser'];
	$bdPass=$_SESSION['bdPass'];

        // Connexion à la base de données
    try {
        $bdd = (pg_connect("host=localhost user=$bdUser dbname=$nomBase password=$bdPass"));
    }
    catch(Exception $e) {
    	exit('Impossible de se connecter à la base de données.');
    }




    // Requête SQL
    $requete = "SELECT * FROM etude WHERE reference='$ref'";

    // Exécution de la requête SQL
    $resultat = pg_query($bdd, $requete);
    $tableau = array();

	// On parcourt les résultats de la requête SQL
    while($donnees = pg_fetch_assoc($resultat)) {
        // On ajoute les données dans un tableau
        $tableau['id_client'] = $donnees['id_client'];
        $tableau['login_charge_etudes'] = $donnees['login_charge_etudes'];
        $tableau['tag'] = $donnees['tag'];
        $tableau['date_debut'] = $donnees['date_debut'];
        $tableau['date_fin'] = $donnees['date_fin'];
        $tableau['prix_jeh'] = $donnees['prix_jeh'];
        $tableau['nombre_jeh'] = $donnees['nombre_jeh'];
	}





	// Requête SQL
    $requete2 = "SELECT * FROM client WHERE id='".$tableau['id_client']."'";

    // Exécution de la requête SQL
    $resultat2 = pg_query($bdd, $requete2);

    // On parcourt les résultats de la requête SQL
    while($donnees2 = pg_fetch_assoc($resultat2)) {
        // On ajoute les données dans un tableau
        $tableau['entreprise'] = $donnees2['entreprise'];
        $tableau['c_nom'] = $donnees2['c_nom'];
        $tableau['c_id'] = $donnees2['id'];
        $tableau['c_prenom'] = $donnees2['c_prenom'];
        $tableau['c_adresse'] = $donnees2['adresse'];
        $tableau['c_telephone'] = $donnees2['telephone'];
    }




    // Requête SQL
    $requete3 = "SELECT nom, prenom FROM diese WHERE login='".$tableau['login_charge_etudes']."'";

    // Exécution de la requête SQL
    $resultat3 = pg_query($bdd, $requete3);

    // On parcourt les résultats de la requête SQL
    while($donnees3 = pg_fetch_assoc($resultat3)) {
        // On ajoute les données dans un tableau
        $tableau['ce_nom'] = $donnees3['nom'];
        $tableau['ce_prenom'] = $donnees3['prenom'];
    }
	
	pg_close($bdd);
	
	return $tableau;
}







function get_intervenants ($ref) {
	
	$nomBase=$_SESSION['nomBase'];
	$bdUser=$_SESSION['bdUser'];
	$bdPass=$_SESSION['bdPass'];

        // Connexion à la base de données
    try {
        $bdd = (pg_connect("host=localhost user=$bdUser dbname=$nomBase password=$bdPass"));
    }
    catch(Exception $e) {
    	exit('Impossible de se connecter à la base de données.');
    }

    // Requête SQL
    $requete4 = "SELECT nom, prenom FROM etude_intervenant NATURAL JOIN intervenant WHERE reference_etude='$ref'";

    // Exécution de la requête SQL
    $resultat4 = pg_query($bdd, $requete4);
    $tableau = array();


    // On parcourt les résultats de la requête SQL
    while($donnees4 = pg_fetch_assoc($resultat4)) {
        // On ajoute les données dans un tableau
        $i_nom = $donnees4['nom'];
        $i_prenom = $donnees4['prenom'];
        $tableau[$i_prenom] = "$i_nom";
    }

	pg_close($bdd);

	return $tableau;
}








function get_document ($ref) {
	
	$nomBase=$_SESSION['nomBase'];
	$bdUser=$_SESSION['bdUser'];
	$bdPass=$_SESSION['bdPass'];

        // Connexion à la base de données
    try {
        $bdd = (pg_connect("host=localhost user=$bdUser dbname=$nomBase password=$bdPass"));
    }
    catch(Exception $e) {
    	exit('Impossible de se connecter à la base de données.');
    }




    // Requête SQL
    $requete = "SELECT typedocument, lien FROM document WHERE reference_etude=$ref";

    // Exécution de la requête SQL
    $resultat = pg_query($bdd, $requete);
    $tableau = array();

	// On parcourt les résultats de la requête SQL
    while($donnees = pg_fetch_assoc($resultat)) {
        // On ajoute les données dans un tableau
        $typedocument = $donnees['typedocument'];
        $lien = $donnees['lien'];
        $tableau[$typedocument] = $lien;
	}

	pg_close($bdd);

	return $tableau;
}

?>