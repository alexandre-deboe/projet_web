<?php
include("connexion.php");
error_reporting(E_ALL);
ini_set('display_errors',1);
$_SESSION['nomBase']=$nomBase;
$_SESSION['bdUser']=$bdUser;
$_SESSION['bdPass']=$bdPass;



$entreprise = pg_escape_string($_POST['entreprise']);
$nom_client = pg_escape_string($_POST['nom_client']);
$prenom_client = pg_escape_string($_POST['prenom_client']);
$adresse_client = pg_escape_string($_POST['adresse_client']);
$tel_client = pg_escape_string($_POST['tel_client']);
$charge_etude = preg_split('/[\s]+/', pg_escape_string($_POST['charge_etude']));    //nom=[0] et prenom=[1]
$date_debut = pg_escape_string($_POST['date_debut']);
$date_fin = pg_escape_string($_POST['date_fin']);
$prix_jeh = pg_escape_string($_POST['prix_jeh']);
$nombre_jeh = pg_escape_string($_POST['nb_jeh']);
$intervenant1 = preg_split('/[\s]+/', pg_escape_string($_POST['intervenant50']));    //nom=[0] et prenom=[1]







if(isset($_POST['entreprise'])){
    try {
        $bdd = (pg_connect("host=localhost user=$bdUser dbname=$nomBase password=$bdPass"));
    } catch (Exception $e) {
        $suggestions[] = array();
        print json_encode($suggestions);
        exit('Impossible de se connecter à la base de données.');
    }

    echo "$entreprise $nom_client $prenom_client";


    $resultat1 = pg_query($bdd, "SELECT * FROM client WHERE entreprise='$entreprise' AND c_nom='$nom_client' AND c_prenom='$prenom_client'");

    if ($resultat1) {
        if ($donnees = pg_fetch_assoc($resultat1)) {// Si le client est deja connu
            $id_client = $donnees['id'];

            echo "<br/> id_cleint : $id_client";


            $resultat2 = pg_query($bdd, "SELECT * FROM etude WHERE id_client='$id_client' ORDER BY reference DESC");
            if ($resultat2) {  //si on a deja fait une etude pour le client alors on a deja une reference
                if ($ref_etude = (pg_fetch_assoc($resultat2))) {
                    $ref_etude = $ref_etude['reference'];
                    $ref_etude = $ref_etude + 0.01; // on incremente la reference de 0.1 pour la nouvelle etude
                    echo "<br/>deja une etude ref: $ref_etude";
                } else {// si le client n'a pas d'etude il faut créer une nouvelle reference
                    $resultat2 = pg_query($bdd, "SELECT * FROM etude ORDER BY reference DESC");
                    if($ref_etude = (pg_fetch_assoc($resultat2))) {
                        $ref_etude = $ref_etude['reference'];
                        echo "<br/>ref: $ref_etude";
                        $ref_etude = floor($ref_etude);  // on tronc pour obtenir un decimal rond (x.00)
                        echo "ref: $ref_etude";
                        $ref_etude = $ref_etude + 1.01;
                        echo "ref: $ref_etude";
                    }
                    else {
                        $ref_etude=1.01;
                    }
                }
            }
        } else {   // Si le client n'est pas connu
            $resultat2 = pg_query($bdd, "SELECT * FROM client ORDER BY id DESC");
            if ($resultat2) {
                if ($donnees = pg_fetch_assoc($resultat2)) {
                    $id_client = $donnees['id'];
                    $id_client = $id_client + 1;

                } else {
                    $id_client = 1;
                }

            } else {
                exit("erreur SQL id_client");
            }
            //ajout du client dans la table client
            $resultat3 = pg_query($bdd, "INSERT INTO client VALUES ('$id_client','$entreprise', '$nom_client', '$prenom_client', '$adresse_client', '$tel_client')");
            if(!$resultat3){
                exit("erreur SQL INSERT Client");
            }
            //on trouve une ref pour l etude
            $resultat2 = pg_query($bdd, "SELECT * FROM etude ORDER BY reference DESC");
            if($ref_etude = (pg_fetch_assoc($resultat2))) {
                $ref_etude = $ref_etude['reference'];
                echo "<br/>ref: $ref_etude";
                $ref_etude = floor($ref_etude);  // on tronc pour obtenir un decimal rond (x.00)
                echo "ref: $ref_etude";
                $ref_etude = $ref_etude + 1.01;
                echo "ref: $ref_etude";
            }
            else {
                $ref_etude=1.01;
            }
        }
    }


    else {
        exit("fail requete SQL client");
    }
    $max = sizeof($charge_etude);

    if ($max > 2) {
        $charge_etude_prenom = $charge_etude[$max - 1];
        $charge_etude_nom = $charge_etude[0];
        for ($i = 1; $i < $max - 1; $i = $i + 1) {
            $ext = $charge_etude[$i];
            $charge_etude_nom = $charge_etude_nom . ' ' . $ext;
        }
    } else {
        $charge_etude_nom = $charge_etude[0];
        $charge_etude_prenom = $charge_etude[1];
    }
    echo "<br/>$charge_etude_nom $charge_etude_prenom";
    $resultat3 = pg_query($bdd, "SELECT * FROM diese WHERE prenom='$charge_etude_prenom'");
    if ($resultat3) {
        if($login_charge_etude = (pg_fetch_assoc($resultat3))) {//si le chargé d'etude est connu on recupere son id
            $login_charge_etude = $login_charge_etude['login'];
        }
        else { //sinon on redirige l'utilisateur en disant que le chargé d etude est inconnu
            header('Location: formulaire_etude.php?msg=1');
            exit();
        }
    }
    else {
        exit("erreur SQL chargé d'étude");
    }




//On ajoute les données dans la table etude_intervenant
    for ($i = 50; $i <= 59; $i++) {
        if (isset($_POST["intervenant$i"])) {
            if (pg_escape_string($_POST["intervenant$i"]) != "") {
                $intervenant = preg_split('/[\s]+/', pg_escape_string($_POST["intervenant$i"]));
                $max = sizeof($intervenant);

                if ($max > 2) {
                    $intervenant_prenom = $intervenant[$max - 1];
                    $intervenant_nom = $intervenant[0];
                    for ($i = 1; $i < $max - 1; $i = $i + 1) {
                        $ext = $intervenant[$i];
                        $intervenant_nom = $intervenant_nom . ' ' . $ext;
                    }
                } else {
                    $intervenant_nom = $intervenant[0];
                    $intervenant_prenom = $intervenant[1];
                }

                $resultat5 = pg_query($bdd, "SELECT * FROM intervenant WHERE nom='$intervenant_nom' AND prenom='$intervenant_prenom'");
                if($resultat5 = pg_fetch_assoc($resultat5)){
                    $id_intervenant = $resultat5['id_intervenant'];
                    echo "<br/>id_inter : $id_intervenant";
                    $resultat6 = pg_query($bdd, "INSERT INTO etude_intervenant VALUES ('$ref_etude', '$id_intervenant')");



                }
                else {
                    header('Location: formulaire_etude.php?msg=1');
                    exit();
                }
            }

        }
    }
    //On ajoute les données dans la table etude
    $resultat4 = pg_query($bdd, "INSERT INTO etude VALUES ('$ref_etude', '$id_client', '$login_charge_etude', 'En cours', '$date_debut', '$date_fin', '$prix_jeh', '$nombre_jeh')");


//Ajout de document
    $extensions = array('.pdf', '.docx', '.doc', '.docm');

    $dossier = "uploads/$ref_etude/";
    if(!is_dir($dossier)){
        mkdir($dossier);
    }
    $target_dir = $dossier;

    $uploadOk = 1;


// verifie si un fichier a ete selectionne
    $arr = array("1","2","3","4","5","6",);
    foreach ($arr as $value) {
        $doc="doc$value";
        $type="type".$value;


        if (!isset($_FILES[$doc])) {
            echo "<p>Aucun fichier n'a ete selectionne !";

        }
        else {
            $extension = strrchr($_FILES[$doc]['name'], '.');
            $target_file = $target_dir . basename($ref_etude . " - " . $_POST[$type]) . $extension;


            if (!in_array($extension, $extensions)) //Si l'extension n'est pas dans le tableau
            {
                echo 'Vous devez uploader un fichier de type pdf, docx, doc, docm';
            } else {
                // cerifie la taille du fichier
                if ($_FILES[$doc]["size"] > 5000000) {
                    echo "<p>Désolé, le fichier est trop volumineux !";

                } else {  // Si il n'y a pas d erreur

                    if (move_uploaded_file($_FILES[$doc]["tmp_name"], $target_file)) {


                            $requete = "INSERT INTO document(reference_etude,typedocument,lien,tag) VALUES ('$ref_etude', '$type','$dossier','a relir')";
                        pg_query($bdd, $requete);


                    }


                }
            }
        }

    }
    pg_close();
    header('Location: details.php?ref='.$ref_etude);

}
else {
//////verif si le client est deja connu
    exit('Vous devez passer par le formulaire pour acceder à cette page');
}

?>
