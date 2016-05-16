<?php
session_start();
if (!isset($_SESSION['userLogin'])){header('Location: identification.php');}

$signup_msg = "";

if (isset($_GET['error'])) {
    $error=$_GET['error'];

    switch ($error) {
        case "i": $signup_msg = "Intervenant deja inscrit"; break;
        case "d": $signup_msg = "Impossible de se connecter à la base de données"; break;
        case "s": $signup_msg = "Intervenant inscrit avec succès"; break;
    }
}

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" type="text/css" href="formulaire_etude.css" />

    <link href="jquery-ui-1.11.4.custom/jquery-ui.css" rel="stylesheet" />
    <script
        src="jquery-ui-1.11.4.custom/jquery-2.2.3.min.js"></script>
    <script
        src="jquery-ui-1.11.4.custom/jquery-ui.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet"/>
    <title>Ajouter une étude</title>

</head>







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
                <li class="active"><a href="formulaire_etude.php">Ajouter une étude</a></li>
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

<form onsubmit="return verifForm()"  action="ajout_etude.php" name="formulaireDynamique" method="post" id="0" enctype="multipart/form-data">
    <div class="row">
        <div class="col-md-4">
            <div class="colonne">

                <div class="ligne"><label for="Entreprise" id="1">Entreprise :</label><input type="text" id="21" name="entreprise" onblur="verifentreprise(this)" size="25" /></div><br/>

                <div class="ligne"><label for="Nom Client" id="2">Nom Client :</label><input type="text" id="22" name="nom_client" onblur="verifclient(this)" size="25"/></div><br/>

                <div class="ligne"><label for="Prénom Client" id="3">Prénom Client :</label><input type="text" id="23" name="prenom_client" onblur="verifclient(this)" size="25"/></div><br/>

                <div class="ligne"><label for="Adresse Client" id="4">Adresse Client :</label><input type="text" id="24" name="adresse_client" onblur="verifadresse(this)" size="25"/></div><br/>

                <div class="ligne"><label for="Téléphone Client" id="5">Téléphone Client :</label><input type="text" id="25" name="tel_client" onblur="veriftel(this)" size="25" placeholder="0123456789"/></div><br/>

                <div class="ligne"><label for="Chargé d'étude" id="6">Chargé d'étude :</label><input type="text" id="26" name="charge_etude" onblur="verifchargeetude()" size="25" placeholder="Nom Prénom"/></div><br/>

                <div class="ligne"><label for="Date de début" id="7">Date de début :</label><input type="text" id="27" name="date_debut" class="datepicker saisiedate" onblur="verifdate(this)" size="25"/></div><br/>

                <div class="ligne"><label for="Date de fin" id="8">Date de fin :</label><input type="text" id="28" name="date_fin" class="datepicker saisiedate" onblur="verifdate(this)" size="25"/></div><br/>

                <div class="ligne"><label for="Prix de la JEH" id="9">Prix de la JEH :</label><input type="text" id="29" name="prix_jeh" onblur="verifprixjeh(this)" size="25" placeholder="min:80, max:340"/></div><br/>

                <div class="ligne"><label for="nombre de JEH" id="10">Nombre de JEH :</label><input type="text" id="30" name="nb_jeh" onblur="verifnombrejeh(this)" size="25"/></div><br/>

                



            </div>

        </div>

        <div class="col-md-4">
            <div class="colonne">



                <div class="form-group" id="61">

                    <input type="file" id="doc1" name="doc1" />
                    <select name="type1">
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


                <div class="form-group" id="62">

                    <input type="file" id="doc2" name="doc2" />



                    <select name="type2">
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

                <div class="form-group" id="63">

                    <input type="file" id="doc3" name="doc3" />



                    <select name="type3">
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
                <div class="form-group" id="64">

                    <input type="file" id="doc4" name="doc4" />



                    <select name="type4">
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


                <div class="form-group" id="65">

                    <input type="file" id="doc5" name="doc5" />

                    <select name="type5">
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


                <div class="form-group" id="66">

                    <input type="file" id="doc6" name="doc6" />



                    <select name="type6">
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
        </div>
        <div class="col-md-4">

            <div id="intervenant" class="colonne">
                <label for="Intervenant" id="12" class="intervenant">Intervenant(s) :</label><br/><br/>
                <input type="text" id="50" name="intervenant50"  onblur="verifintervenant2(this)" size="30" placeholder="Nom Prénom"/>
                <input id="33" type="button" onclick="ajout(this);" class = "ajout1" value=""/>
                <div class="form-group">
                    <a onclick="openOverlay()" class="btn btn-link btn-sm" role="button">Inscrire un intervenant</a>
                </div>
                <div class="col-sm-offset-2 col-sm-20">
                    <input class="btn btn-primary" onclick="verifintervenant();" onmouseover="verifchargeetude();verifintervenant()" type="submit" id="11" value="Submit">
                </div>
            </div>
            <br/><br/>

        </div>
    </div>



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
    </script>















    <script type="text/javascript">
        function getfile(){
            document.getElementById('hiddenfile').click();
        }
        function getvalue(){
            document.getElementById('selectedfile').value=document.getElementById('hiddenfile').value;
        }
    </script>









</form>
<div id="creation" class="overlay">
    <div class="overlay-content">
        <div class="container">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-default">

                    <div class="panel-heading panel-title">
                        <strong>Inscription Intervenant</strong>
                        <a onclick="closeOverlay()"class="closebtn" role="button">×</a>
                    </div>

                    <div class="panel-body">
                        <form action="ajout_intervenant.php" method="post" class="form-horizontal" id="validate">

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
                                <div id="chNom">
                                    <label class="control-label col-md-3">Téléphone</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="tel" id="idNom" />
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div id="chNom">
                                    <label class="control-label col-md-3">Mail</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="mail" id="idNom" />
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

                                if ($error == "i")
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

<script type="text/javascript">
    $(document).ready(function() {
        $('.datepick').datepicker({ dateFormat: "yy-mm-dd"});
    });
</script>

<script src="animate.js"></script>
<script type="text/javascript">
    cache();

    setTimeout(affiche, 200);

    var imgObj = null;
    var animate ;
    var tab = [];



    var pas;
    for (pas =61; !(pas >= 67); pas++) {
        var str = pas.toString();
        tab.push(init(str));
    }

    for (pas =1; !(pas >= 11); pas++) {
        var str = pas.toString();
        tab.push(init(str));
    }
    for (pas = 21; !(pas >= 31); pas++) {
        var str = pas.toString();
        tab.push(init(str));
    }
    tab.push(init("intervenant"));







    window.onload = init('1');
    setTimeout(cascade,100);

    $('#50').autocomplete({
        source: 'complete.php',
        minLength: 1,
        dataType: 'json'
    });

    $('#21').autocomplete({
        source: 'completeentreprise.php',
        minLength: 1,
        dataType: 'json'
    });
    $('#22').autocomplete({
        source: 'completenomclient.php',
        minLength: 1,
        dataType: 'json'
    });
    $('#23').autocomplete({
        source: 'completeprenomclient.php',
        minLength: 1,
        dataType: 'json'
    });
    $('#24').autocomplete({
        source: 'completeadresse.php',
        minLength: 1,
        dataType: 'json'
    });
    $('#25').autocomplete({
        source: 'completetelephone.php',
        minLength: 1,
        dataType: 'json'
    });
    $('#26').autocomplete({
        source: 'completeCE.php',
        minLength: 1,
        dataType: 'json'
    });









</script>
<footer class="navbar navbar-inverse navbar-fixed-bottom">
    <a class="navbar-brand">Diese</a>
</footer>
</body>




</html>
