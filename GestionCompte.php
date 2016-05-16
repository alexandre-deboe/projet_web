<?php
session_start();

if (!isset($_SESSION['userLogin']))
	header('Location: identification.php');

$mdp_error = "";

$signup_msg = "";
$error = "";

$userNom=$_SESSION['userNom'];
$userPrenom=$_SESSION['userPrenom'];
$userLogin=$_SESSION['userLogin'];
$userPoste=$_SESSION['userPoste'];
$userStatut=$_SESSION['userStatut'];


$msg_error = "";
$error = "";

if (isset($_GET['error'])) {
	$error=$_GET['error'];

	switch ($error) {
		case "v": $msg_error = "Veuillez compléter tous les champs"; break;
		case "d": $msg_error = "Utilisateur déjà existant"; break;
		case "r": $msg_error = "Erreur requète"; break;
		case "s": $msg_error = "Modification enregistrée avec succès"; break;
		case "b": $msg_error = "Impossible de se connecter à la base de données"; break;
	}
}

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="overlay.css" type="text/css" rel="stylesheet">
    <script src="jquery-ui-1.11.4.custom/jquery-2.2.3.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <title>Modification</title>
  </head>
  
  <body>
  	<script>
  	String.prototype.sansAccent = function(){
  	    var accent = [/[\340-\346]/g /* a */, /[\350-\353]/g /* e */, /[\354-\357]/g /* i */, /[\362-\370]/g /* o */,  /[\371-\374]/g /* u */, /[\361]/g /* n */, /[\347]/g /* c */];
  	    var noaccent = ['a','e','i','o','u','n','c'];
		var str = this;
  	    for(var i = 0; i < accent.length; i=i+1){
  	        str = str.replace(accent[i], noaccent[i]);
  	    }
  	    return str;
  	}

  	function checkForm(id) {
		if ($('#id'+id).val().length == 0 || $('#id'+id).val().length > 20) {
			$('#ch'+id).addClass("has-warning");
			return false;
		}
		else {
			$('#ch'+id).removeClass("has-warning");
			return true;
		}
	}
  	
  	$(document).ready(function() {
  	  $('.id-update').keyup(function() { 
  	  	var prenom = ((($('#idPre').val()).toLowerCase()).sansAccent()).replace(/[^a-z|0-9]/g,"");
  	  	var nom = ((($('#idNom').val()).toLowerCase()).sansAccent()).replace(/[^a-z|0-9]/g,"");
  	    var login = prenom+'.'+nom;
  	    $('#idLog').text(login);
  	  	$('#formLog').val(login);
  	  });

  	  $("#validate").submit(function() {
		var checkPre = checkForm('Pre');
		var checkNom = checkForm('Nom');
		if (checkPre && checkNom)
			return true;
		else {
			$('#clMsg').removeClass('hidden');
			$('#idMsg').text('Champ invalide');
			$('#chMsg').removeClass().addClass('has-warning');
			return false;
		}
  	  });
		  	  
  	});

  	
  	
  	</script>
  	
	<nav class="navbar navbar-inverse navbar-fixed-top">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
		            <span class="sr-only">Toggle navigation</span>
		            <span class="icon-bar"></span>
		            <span class="icon-bar"></span>
		            <span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="page_accueil.php"><strong>Gestion des Etudes</strong></a>
			</div>
	        <div id="navbar" class="navbar-collapse collapse">
				<ul class="nav navbar-nav">
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Liste des études<span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="page_accueil.php">Etudes en cours</a></li>
							<li><a href="page_accueil_terminees.php">Etudes terminées</a></li>
						</ul>
					</li>
					<li><a href="formulaire_etude.php">Ajouter une étude</a></li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li class="dropdown active">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Mon compte<span class="caret"></span></a>
						<ul class="dropdown-menu">
	          				<li class="dropdown-header"><strong>Connecté en tant que</strong></li>
	            			<li><a href="GestionCompte.php"><?php echo $_SESSION['userLogin'];?></a></li>
	            			<li role="separator" class="divider"></li>
	            			<li><a href="GestionCompte.php">Gestion du compte</a></li>
	            			<li><a href="deconnexion.php">Déconnexion</a></li>
          				</ul>
					</li>
				</ul>
			</div>
		</div>
	</nav>
  
  	<div class="container">
	    <div class="col-md-6 col-md-offset-3">
		  	<form action="ModifUtilisateur.php" method="post" id="validate">
		  		<div class="form-group">
				  	<label class="control-label">Login</label>
					<p class="form-control-static" id="idLog"><?php echo $userLogin; ?></p>
					<input type="hidden" name="login" id="formLog" value="<?php echo $userLogin; ?>" />
				</div>
		  	
				<div class="form-group">
					<div id="chPre">
					  	<label class="control-label">Prénom</label>
						<input type="text" class="form-control id-update" name="prenom" value="<?php echo $userPrenom; ?>" id="idPre" />
					</div>
				</div>
				
				<div class="form-group">
					<div id="chNom">
					  	<label class="control-label">Nom</label>
						<input type="text" class="form-control id-update" name="nom" value="<?php echo $userNom; ?>" id="idNom" />
					</div>
				</div>
				
				<div class="form-group">
					<label class="control-label">Poste</label>
					<select class="form-control" name="poste">
						<option id="Chargé d'études">Chargé d'études</option>
						<option id='Pôle DSI'>Pôle DSI</option>
						<option id='Président'>Président</option>
					</select>
					<script>
						document.getElementById("<?php echo $userPoste; ?>").selected = "selected";
					</script>
				</div>
				
				<div class="form-group">
				  	<label class="control-label">Statut</label>
					<p class="form-control-static"><?php echo $userStatut; ?></p>
				</div>
				
				<div class="form-group">
					<label class="control-label">Nouveau mot de passe</label>
				    <input type="password" class="form-control" name="mdp"/>
				</div>
				
				<div class="form-group">
					<input type="submit" class="btn btn-default" value="Valider" />
					<?php 
					if ($msg_error)
						echo '<div id="clMsg" class="col-md-offset-3 col-md-9">';
					else 
						echo '<div id="clMsg" class="col-md-offset-3 col-md-9 hidden">';
					
					if ($error == "s")
						echo '<div id="chMsg" class="has-success">';
					elseif ($error == "v")
						echo '<div id="chMsg" class="has-warning">';
					else
						echo '<div id="chMsg" class="has-error">'; 
					echo '<p id="idMsg" class="control-label text-right">'.$msg_error.'</p></div></div>';
					?>
				</div>	
			</form>
		</div>
	</div>
				
	<footer class="navbar navbar-inverse navbar-fixed-bottom">
		<a class="navbar-brand">Diese</a>
	</footer>
  </body>
</html>