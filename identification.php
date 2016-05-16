<?php
session_start();

include("connexion.php");

$_SESSION['nomBase']=$nomBase;
$_SESSION['bdUser']=$bdUser;
$_SESSION['bdPass']=$bdPass;

$login_error = "";
$mdp_error = "";

$signup_msg = "";
$error = "";

if (isset($_GET['error'])) {
	$error=$_GET['error'];
	
	switch ($error) {
		case "u": $login_error = "Utilisateur inconnu"; break;
		case "v": $mdp_error = "Vous devez impérativement entrer un mot de passe"; break;
		case "m": $mdp_error = "Mot de passe incorrect"; break;
		case "r": $mdp_error = "Requète non effectuée"; break;
		case "b": $mdp_error = "Impossible de se connecter à la base de données"; break; 
		
		case "t": $signup_msg = "Veuillez remplir tous les champs"; break;
		case "n": $signup_msg = "Erreur requète"; break;
		case "i": $signup_msg = "Erreur insert"; break;
		case "d": $signup_msg = "Utilisateur déjà existant"; break;
		case "f": $signup_msg = "Impossible de se connecter à la base de données"; break;
		case "s": $signup_msg = "Compte créé avec succès"; break;	
	}
}

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="overlay.css" type="text/css" rel="stylesheet">
    <script type="text/javascript" src="http://code.jquery.com/jquery-2.2.3.min.js"></script>
    <title>Authentification</title>
  </head>

  <body>
  	<script>
		function openOverlay() {
		    document.getElementById("creation").style.height = "100%";
		}

		function openOverlayInstant() {
			document.getElementById("creation").style.transition = "0s";
		    document.getElementById("creation").style.height = "100%";
		}
		
		function closeOverlay() {
			document.getElementById("creation").style.transition = "0.5s";
		    document.getElementById("creation").style.height = "0%";
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
			$("#validate").submit(function() {
				var checkPre = checkForm('Pre');
				var checkNom = checkForm('Nom');
				var checkPos = checkForm('Pos');
				var checkMdp = checkForm('Mdp');
				if (checkPre && checkNom && checkPos && checkMdp)
					return true;
				else {
					$('#clMsg').removeClass('hidden');
					$('#idMsg').text('Champs invalides');
					$('#chMsg').removeClass().addClass('has-warning');
					return false;
				}
			})
		});
	</script>
	
	<nav class="navbar navbar-inverse navbar-fixed-top">
		<div class="container">
			<div class="navbar-header">
				<a class="navbar-brand" href="identification.php"><strong>Gestion des Etudes</strong></a>
			</div>
		</div>
	</nav>
  
	
  	<div class="container">
	    <div class="col-md-4 col-md-offset-4">
	    
	    	<div class="panel panel-default">
	    	
		    	<div class="panel-heading panel-title">
		    		<strong>Authentification</strong>
		    	</div>
		    	
		    	<div class="panel-body">
			    	<form action="VerifMDP.php" method="post">
			    	
			    		<div class="form-group <?php if ($login_error) echo 'has-error'; ?>">
			    			<label class="control-label">Login</label>
			    			<input type="text" class="form-control" name="login" placeholder="prenom.nom" />
			    			<?php 
			    			if ($login_error)
			    				echo '<p class="control-label small">'.$login_error.'</p>';
			    			?>
				    	</div>
				
						<div class="form-group <?php if ($mdp_error) echo 'has-error'; ?>">
							<label class="control-label">Mot de passe</label>
				    		<input type="password" class="form-control" name="mdp"/>
				    		<?php 
				    		if ($mdp_error)
				    			echo '<p class="control-label small">'.$mdp_error.'</p>';
				    		?>
						</div>
						
						<div class="form-group">
							<input type="submit" class="btn btn-default" value="Connexion" />
							<a onclick="openOverlay()" class="btn btn-link btn-sm" role="button">Créer un compte</a>	
						</div>	
				    </form>
			    </div>
			    
	    	</div>
	    </div>  
    </div>
    
    <div id="creation" class="overlay">
    	<a onclick="closeOverlay()" class="closebtn" role="button">×</a>
    	
    	<div class="overlay-content">
	    	<div class="container">
		   		<div class="col-md-6 col-md-offset-3">
			    	<div class="panel panel-default">
			    	
			    		<div class="panel-heading panel-title">
				    		<strong>Création de compte</strong>
				    	</div>
				    	
				    	<div class="panel-body">
						    <form action="CreationCompte.php" method="post" class="form-horizontal" id="validate">
									    	
								<div class="form-group">
									<div id="chPre">
										<label class="control-label col-md-3">Prénom</label>
										<div class="col-md-9">
											<input type="text" class="form-control" name="prenom" id="idPre" />
										</div>
									</div>
								</div>
								
								<div class="form-group">
									<div id="chNom">
										<label class="control-label col-md-3">Nom</label>
										<div class="col-md-9">
							  				<input type="text" class="form-control" name="nom" id="idNom" />
							  			</div>
						  			</div>
								</div>
										    	
								<div class="form-group">
									<div id="chPos">
										<label class="control-label col-md-3 ">Poste</label>
										<div class="col-md-9">
											<select class="form-control" name="poste" id="idPos">
												<option></option>
												<option>Chargé d'études</option>
												<option>Pôle DSI</option>
												<option>Président</option>
											</select>
										</div>
									</div>
								</div>
										    	
								<div class="form-group">
									<div id="chMdp">
										<label class="control-label col-md-3">Mot de passe</label>
										<div class="col-md-9">
											<input type="password" class="form-control" name="mdp" id="idMdp" />
										</div>
									</div>
								</div>
										    	
								<div class="form-group">
									<div class="col-md-offset-3 col-md-3">
										<input type="submit" class="btn btn-default" value="Valider" />
									</div>
									<?php
									if ($signup_msg) {
										echo '<script>openOverlayInstant()</script>';
										echo '<div id="clMsg" class="col-md-offset-3 col-md-9">';
									}
									else
										echo '<div id="clMsg" class="col-md-offset-3 col-md-9 hidden">';
									
									if ($error == "t")
										echo '<div id="chMsg" class="has-warning">';
									elseif ($error == "s")
										echo '<div id="chMsg" class="has-success">';
									else
										echo '<div id="chMsg" class="has-error">';

									echo '<p id="idMsg" class="control-label">'.$signup_msg.'</p></div></div>';
									?>
								</div>
								
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<footer class="navbar navbar-inverse navbar-fixed-bottom">
		<a class="navbar-brand">Diese</a>
	</footer>
  </body>
</html>
