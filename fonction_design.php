<?php

function header_general($title,$description) {
	echo '
		<head>
    		<meta charset="utf-8">
    		<meta http-equiv="X-UA-Compatible" content="IE=edge">
    		<meta name="viewport" content="width=device-width, initial-scale=1">

    		<meta name="description" content="'.$description.'">
    		<meta name="author" content="Diese">
    		<link rel="icon" href="../../favicon.ico">

    		<title>'.$title.'</title>

    		<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    		<link href="navbar-fixed-top.css" rel="stylesheet">

  		</head>
  		';
}

function barre_navigation() {
	echo '
		<nav class="navbar navbar-default navbar-fixed-top">
	      <div class="container">
	        <div class="navbar-header">
	          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
	            <span class="sr-only">Toggle navigation</span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	          </button>
	          <a class="navbar-brand" href="#">Gestion des Etudes</a>
	        </div>
	        <div id="navbar" class="navbar-collapse collapse">
	          <ul class="nav navbar-nav">
	            <li class="active"><a href="#">Liste</a></li>
	            <li><a href="#about">Détails</a></li>
	            <li><a href="#contact">Statistique</a></li>
	          </ul>
	          <ul class="nav navbar-nav navbar-right">
	            <li class="active"><a href="./">Compte <span class="sr-only">(current)</span></a></li>
	          </ul>
	        </div>
	      </div>
	    </nav>
	    ';
}

function fin_page() {
	echo '
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    	<script>window.jQuery || document.write(\'<script src="../../assets/js/vendor/jquery.min.js"><\/script>\')</script>
    	<script src="bootstrap/js/bootstrap.min.js"></script>
    	';
}

function footer() {
	echo '
		<footer class="navbar navbar-default navbar-static-bottom">
			<a class="navbar-brand" href="#">Diese</a>
		</footer>
		';
}