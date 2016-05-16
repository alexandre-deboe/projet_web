<?php
include("connexion.php");
error_reporting(E_ALL);
ini_set('display_errors',1);
$_SESSION['nomBase']=$nomBase;
$_SESSION['bdUser']=$bdUser;
$_SESSION['bdPass']=$bdPass;





if(isset($_POST['charge_etude'])) {
    try {
        $bdd = (pg_connect("host=localhost user=$bdUser dbname=$nomBase password=$bdPass"));
    } catch (Exception $e) {
        exit('Impossible de se connecter à la base de données.');
    }


    $charge_etude = preg_split('/[\s]+/', pg_escape_string($_POST['charge_etude']));
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

    $resultat1 = pg_query($bdd, "SELECT * FROM diese WHERE nom='$charge_etude_nom' AND prenom='$charge_etude_prenom'");
    if ($resultat1) {
        if((pg_num_rows($resultat1))==0) {
            echo ('no');
        }
        else {
            echo ('yes');
        }
    }
    else{
        echo "blabla";
    }
    


}
else {
    echo "pas de POST";
}
pg_close($bdd);

?>