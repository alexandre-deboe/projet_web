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

if ((!isset($_POST['nom'])) | ($_POST['nom'] == ""))
    header('Location: formulaire_etude.php');
else{
    $prenom=pg_escape_string($_POST['prenom']);
    $nom=pg_escape_string($_POST['nom']);
    $tel=pg_escape_string($_POST['tel']);
    $mail=pg_escape_string($_POST['mail']);

    try {
        $bdd = (pg_connect("host=localhost user=$bdUser dbname=$nomBase password=$bdPass"));
    } catch (Exception $e) {
        $suggestions[] = array();
        print json_encode($suggestions);
        exit('Impossible de se connecter à la base de données.');
    }


    $verif = pg_query($bdd,"SELECT * FROM intervenant where LOWER(nom)=LOWER('$nom') AND LOWER(prenom)=LOWER('$prenom')");

    if (!$verif){
        header('Location: formulaire_etude.php?error=d');
    }
    else{
        if ($donnees = pg_fetch_assoc($verif)) {
            header('Location: formulaire_etude.php?error=i');
        }
        else{
            $verif=pg_query($bdd,"SELECT * FROM intervenant ORDER BY id_intervenant DESC");
            if ($donnees = pg_fetch_assoc($verif)) {
                $id=$donnees['id_intervenant'];
                $id=$id+1;
                pg_query($bdd,"INSERT INTO intervenant VALUES ('$id','$nom', '$prenom', '$tel', '$mail')");
                header('Location: formulaire_etude.php?error=s');



            }
        }
    }


}