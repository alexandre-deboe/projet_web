<?php
include("connexion.php");
error_reporting(E_ALL);
ini_set('display_errors',1);
$_SESSION['nomBase']=$nomBase;
$_SESSION['bdUser']=$bdUser;
$_SESSION['bdPass']=$bdPass;





if(isset($_POST['intervenant'])) {
    try {
        $bdd = (pg_connect("host=localhost user=$bdUser dbname=$nomBase password=$bdPass"));
    } catch (Exception $e) {
        exit('Impossible de se connecter à la base de données.');
    }

if(pg_escape_string($_POST['intervenant'])==""){
    echo 'no';
}
    else {
        $intervenant = preg_split('/[\s]+/', pg_escape_string($_POST['intervenant']));
        $max = sizeof($intervenant);
        if($max<2){
            echo 'no';
        }
        else {
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

            $resultat1 = pg_query($bdd, "SELECT * FROM intervenant WHERE nom='$intervenant_nom' AND prenom='$intervenant_prenom'");
            if ($resultat1) {
                if ((pg_num_rows($resultat1)) == 0) {
                    echo('no');
                } else {
                    echo('yes');
                }
            } else {
                echo "no";
            }
        }

    }

}
else {
    echo "no";
}

pg_close($bdd);
?>