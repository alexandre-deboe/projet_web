<?php
session_start();

unset($_SESSION['userNom']);
unset($_SESSION['userPrenom']);
unset($_SESSION['userLogin']);
unset($_SESSION['userPoste']);
unset($_SESSION['userStatut']);

header('Location: identification.php');
?>