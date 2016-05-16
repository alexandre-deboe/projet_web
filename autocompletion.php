<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<link rel="stylesheet" href="style_autocomplete.css" />
<script type="text/javascript" src="http://code.jquery.com/jquery-1.5.1.min.js"></script>
<script type="text/javascript" src="http://ajax.microsoft.com/ajax/jquery.ui/1.8.10/jquery-ui.js"></script>
<link rel="Stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.9/themes/base/jquery-ui.css" />

	<head >
		<title>AutoCompletion</title>
	</head>

	<body>


	<script type="text/Javascript" >
		var i = 1;

		function ajout(element){
			var formulaire = window.document.formulaireDynamique;
			// On clone le bouton d'ajout
			var ajout = element.cloneNode(true);
			ajout.className = "ajout2";
			// Crée un nouvel élément de type "input"
			var champ = document.createElement("input");
			// Les valeurs encodée dans le formulaire seront stockées dans un tableau
			champ.name = "champs[]";
			champ.type = "text";
			i=i+1;
			champ.id = i.toString();
			champ.size = 30;

			var sup = document.createElement("input");
			sup.value = "";
			sup.type = "button";
			sup.className = "supprime";
			// Ajout de l'événement onclick
			sup.onclick = function onclick(event)
			{suppression(this);};

			// On crée un nouvel élément de type "p" et on insère le champ l'intérieur.
			var bloc = document.createElement("a");
			bloc.appendChild(champ);
			//formulaire.insertAfter(champ, ajout);
			//formulaire.insertAfter(ajout, element);

			//formulaire.insertAfter(sup, element);



			$(ajout).insertAfter(element);
			$(sup).insertAfter(element);
			$(champ).insertAfter(element);
			$(document.createElement("p")).insertAfter(element);

			var pas;
			for (pas = 1; pas < 5; pas++){
				var str = '#'+pas.toString();

				$(str).autocomplete({
					source: 'complete.php',
					minLength: 1,
					dataType: 'json'


				});

			}

		}

		function suppression(element){
			var formulaire = window.document.formulaireDynamique;

			// Supprime le bouton d'ajout
			formulaire.removeChild(element.previousSibling);
			// Supprime le champ
			formulaire.removeChild(element.nextSibling);
			// Supprime le bouton de suppression
			formulaire.removeChild(element);
		}
	</script>
	<form name="formulaireDynamique">
		<input type="text" id="1" size="30"/>


		<input type="button" onclick="ajout(this);" class = "ajout1" value=""/>
		<br/><br/>
		<input class="arrondi" type="submit" name="submit" value="" />
	</form>

		<script>
			$('#1').autocomplete({
				source: 'complete.php',
				minLength: 1,
				dataType: 'json'
			});


        </script>
	</body>

</html>



