<?php

session_start();

if (!isset($_SESSION['userLogin'])){header('Location: identification.php');}

$nomBase=$_SESSION['nomBase'];
$bdUser=$_SESSION['bdUser'];
$bdPass=$_SESSION['bdPass'];

$ref = $_GET['ref'];
include('details_fonction.php');

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="détails etude">
    <meta name="author" content="Diese">

    <title>Détails de l'étude <?php echo $ref; ?></title>

    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="details.css" rel="stylesheet">

    <script>
        function openOverlay() {
            document.getElementById("terminer").style.height = "100%";
        }

        function closeOverlay() {
            document.getElementById("terminer").style.transition = "0.5s";
            document.getElementById("terminer").style.height = "0%";
        }

        function openOverlay2() {
            document.getElementById("supprimer").style.height = "100%";
        }

        function closeOverlay2() {
            document.getElementById("supprimer").style.transition = "0.5s";
            document.getElementById("supprimer").style.height = "0%";
        }

        function openOverlay3() {
            document.getElementById("ajout").style.height = "100%";
        }

        function closeOverlay3() {
            document.getElementById("ajout").style.transition = "0.5s";
            document.getElementById("ajout").style.height = "0%";
        }

        function openOverlay4() {
            document.getElementById("modif").style.height = "100%";
            document.getElementById("1").style.zIndex = 1;

        }

        function closeOverlay4() {
            document.getElementById("modif").style.transition = "0.5s";
            document.getElementById("modif").style.height = "0%";
        }
    </script>
    <script src="animate.js"></script>

</head>

<?php
$etude = get_etude($ref);
$intervenants = get_intervenants($ref);
$documents = get_document($ref);
?>

<body>

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
                <li class="dropdown">
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
<?php
if ($_SESSION['userStatut'] == 'admin')
    echo '
		<div class="btn-group btn-group-justified" role="group" aria-label="...">
	  		<div class="btn-group" role="group">
	    		<button type="button" class="btn btn-info" onclick="openOverlay3()">Ajouter</button>
			</div>
		  	<div class="btn-group" role="group">
		    	<button onclick="openOverlay4()" type="button" id="1" class="btn btn-warning">Modifier</button>
		  	</div>
		  	<div class="btn-group" role="group">
		    	<button type="button" class="btn btn-success" onclick="openOverlay()">Terminer</button>
		  	</div>
		  	<div class="btn-group" role="group">
		    	<button type="button" class="btn btn-danger" onclick="openOverlay2()">Supprimer</button>
		  	</div>
		</div>
		';
else
    echo '
	    <div class="btn-group btn-group-justified" role="group" aria-label="..." style="padding-right: 65%;">
	  		<div class="btn-group" role="group">
	    		<button type="button" class="btn btn-info" onclick="openOverlay3()">Ajouter</button>
			</div>
	    </div>
			';
?>

<div id="terminer" class="overlay">
    <a onclick="closeOverlay()"class="closebtn" role="button">×</a>

    <div class="overlay-content">
        <div class="container">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-success">

                    <div class="panel-heading panel-title">
                        <strong>Cloturer l'étude</strong>
                    </div>

                    <div class="panel-body">
                        <p>Etes-vous sur de vouloir cloturer cette étude ?</p>
                        <p><a class="btn btn-success btn-lg" role="button" onclick="document.location.href='terminer_etude.php?ref=<?php echo $ref; ?>'">Terminer</a></p>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<div id="supprimer" class="overlay">
    <a onclick="closeOverlay2()"class="closebtn" role="button">×</a>

    <div class="overlay-content">
        <div class="container">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-danger">

                    <div class="panel-heading panel-title">
                        <strong>Supprimer l'étude</strong>
                    </div>

                    <div class="panel-body">
                        <p>Etes-vous sur de vouloir supprimer cette étude ?</p>
                        <p><a class="btn btn-danger btn-lg" href="#" role="button" onclick="document.location.href='supprimer_etude.php?ref=<?php echo $ref; ?>'">Supprimer</a></p>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<div id="ajout" class="overlay">
    <a onclick="closeOverlay3()"class="closebtn" role="button">×</a>

    <div class="overlay-content">
        <div class="container">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-info">

                    <div class="panel-heading panel-title">
                        <strong>Ajouter un document</strong>
                    </div>

                    <div class="panel-body">

                        <form class="form-horizontal" role="form" action="upload.php" method="post" enctype="multipart/form-data">

                            <div class="form-group">
                                <label class="control-label col-sm-2" for="email">Type :</label>
                                <div class="col-sm-10">
                                    <select name="type">
                                        <optgroup label="Client">
                                            <option value="Devis">Devis</option>
                                            <option value="PC">PC</option>
                                            <option value="Convention Client">Convention Client</option>
                                            <option value="Avenant Client Retard">Avenant Client Retard</option>
                                            <option value="Avenant Client Rupture">Avenant Client Rupture</option>
                                        </optgroup>
                                        <optgroup label="Intervenant">
                                            <option value="Convention Intervenant">Convention Intervenant</option>
                                            <option value="Rapport de mission">Rapport de mission</option>
                                            <option value="Récapitulatif de mission">Récapitulatif de mission</option>
                                            <option value="Avenant Intervenant Retard">Avenant Intervenant Retard</option>
                                            <option value="Avenant Intervenant Rupture">Avenant Intervenant Rupture</option>
                                        </optgroup>
                                        <optgroup label="Payement">
                                            <option value="Facture">Facture</option>
                                            <option value="Lettre de recette">Lettre de recette</option>
                                            <option value="BV">BV</option>
                                        </optgroup>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-sm-2" for="email">Fichier :</label>
                                <div class="col-sm-10">
                                    <input type="file" name="fileToUpload" id="fileToUpload">
                                    <input type="hidden" name="reference" value="<?php echo $ref; ?>">
                                </div>
                            </div></br>

                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-20">
                                    <input class="btn btn-info" type="submit" value="Upload Document" name="submit">
                                </div>
                            </div>

                        </form>

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<div id="modif" class="overlay">
    <a onclick="closeOverlay4()"class="closebtn4" role="button">×</a>

    <div class="overlay-content4">
        <div class="container">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-warning">

                    <div class="panel-heading panel-title">
                        <strong>Modifier les détails de l'étude</strong>
                    </div>

                    <div class="panel-body">

                        <form class="form-horizontal" onsubmit="return verifForm()"  action="modif_etude.php" name="formulaireDynamique" method="post">
                            <div class="form-group form-group-sm" >
                                <label  class="col-sm-3 control-label" for="Nom Client" id="2">Nom Client :</label>
                                <div class="col-sm-9">
                                    <input value="<?php echo $etude['c_nom'] ?>" class="form-control" type="text" id="22" name="nom_client" onblur="verifclient(this)"/></div>
                            </div>
                            <div class="form-group form-group-sm" >
                                <label class="col-sm-3 control-label" for="Prénom Client" id="3">Prénom Client :</label>
                                <div class="col-sm-9">
                                    <input value="<?php echo $etude['c_prenom'] ?>" class="form-control" type="text" id="23" name="prenom_client" onblur="verifclient(this)"/></div>
                            </div>
                            <div class="form-group form-group-sm" >
                                <label  class="col-sm-3 control-label" for="Adresse Client" id="4">Adresse Client :</label>
                                <div class="col-sm-9">
                                    <input value="<?php echo $etude['c_adresse'] ?>" class="form-control" type="text" id="24" name="adresse_client" onblur="verifadresse(this)"/></div>
                            </div>
                            <div class="form-group form-group-sm" >
                                <label  class="col-sm-3 control-label" for="Téléphone Client" id="5">Téléphone Client :</label>
                                <div class="col-sm-9">
                                    <input value="<?php echo $etude['c_telephone'] ?>" class="form-control" type="text" id="25" name="tel_client" onblur="veriftel(this)"/></div>
                                <input type="hidden" name="reference" value="<?php echo $ref; ?>">
                                <input type="hidden" name="c_id" value="<?php echo $etude['c_id']; ?>">
                            </div>
                            <div class="form-group form-group-sm" >
                                <label  class="col-sm-3 control-label" for="Date de début" id="7">Date de début :</label>
                                <div class="col-sm-9">
                                    <input value="<?php echo $etude['date_debut'] ?>" class="form-control" type="text" id="27" name="date_debut" class="datepicker saisiedate" onblur="verifdate(this)"/></div>
                            </div>
                            <div class="form-group form-group-sm" >
                                <label  class="col-sm-3 control-label" for="Date de fin" id="8">Date de fin :</label>
                                <div class="col-sm-9">
                                    <input value="<?php echo $etude['date_fin'] ?>" class="form-control" type="text" id="28" name="date_fin" class="datepicker saisiedate" onblur="verifdate(this)"/></div>
                            </div>
                            <div class="form-group form-group-sm" >
                                <label  class="col-sm-3 control-label" for="Prix de la JEH" id="9">Prix de la JEH :</label>
                                <div class="col-sm-9">
                                    <input value="<?php echo $etude['prix_jeh'] ?>" class="form-control" type="text" id="29" name="prix_jeh" onblur="verifprixjeh(this)"/></div>
                            </div>
                            <div class="form-group form-group-sm" >
                                <label  class="col-sm-3 control-label" for="nombre de JEH" id="10">Nombre de JEH :</label>
                                <div class="col-sm-9">
                                    <input value="<?php echo $etude['nombre_jeh'] ?>" class="form-control"class="form-control input-sm" type="text" id="30" name="nb_jeh" onblur="verifnombrejeh(this)"/></div>
                            </div>
                            <input class="btn btn-warning" type="submit" value="Modifier" name="submit">
                        </form>

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<div>



    <h1 class="page-header">Détails de l'étude <small><?php echo $ref; ?> </small></h1>

    <div class="row marketing">
        <div class="col-lg-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    Le Client
                </div>
                <div class="panel-body">

                    <?php
                    echo $etude['entreprise'].' - '.$etude['c_prenom'].' '.$etude['c_nom'];
                    ?>

                </div>
            </div>

            <div class="panel panel-primary">
                <div class="panel-heading">
                    Le Chargé d'Etude
                </div>
                <div class="panel-body">

                    <?php
                    echo $etude['ce_prenom'].' '.$etude['ce_nom'];
                    ?>

                </div>
            </div>

            <?php
            foreach($intervenants as $prenom => $nom) {
                echo '
  			  	<div class="panel panel-primary">
  					<div class="panel-heading">
    					Intervenant
  					</div>
  					<div class="panel-body">
  						'.$prenom.' '.$nom.'
  					</div>
				</div>
			';
            }
            ?>

            <div class="panel panel-primary">
                <div class="panel-heading">
                    Durée de l'étude
                </div>
                <div class="panel-body">

                    <?php
                    echo $etude['date_debut'].' - '.$etude['date_fin'];
                    ?>

                </div>
            </div>

            <div class="panel panel-primary">
                <div class="panel-heading">
                    Prix de l'étude
                </div>
                <div class="panel-body">

                    <?php
                    $prix = $etude['nombre_jeh']*$etude['prix_jeh'];
                    echo $etude['nombre_jeh'].' - '.$etude['prix_jeh'].' --> '.$prix;
                    ?>

                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <?php
            foreach($documents as $typedocument => $lien) {
                echo '
  			  	<div class="panel panel-info">
  					<div class="panel-heading">
    					'.$typedocument.'
  					</div>
  					<div class="panel-body">
  						'.$lien.'
  					</div>
				</div>
			';
            }
            ?>


        </div>
    </div>

</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
<script src="bootstrap/js/bootstrap.min.js"></script>

</body>

<footer class="navbar navbar-inverse navbar-fixed-bottom">
    <a class="navbar-brand">Diese</a>
</footer>

</html>