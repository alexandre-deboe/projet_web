<?php
session_start(); 

include("connexion.php");

$_SESSION['nomBase']=$nomBase;
$_SESSION['bdUser']=$bdUser;
$_SESSION['bdPass']=$bdPass;

if ($DB = (pg_connect("host=localhost user=$bdUser dbname=$nomBase password=$bdPass"))){
   pg_close($DB);
   header('Location:identification.php');
}

else 
  print "<p class='erreur'>Impossible de se connecter à la base de données</p>";


?>