<?php
/*fichier comportant différentes fonctions permettant de factoriser du code html (avec une mobilité des references).*/


	function getHead($granularite=0){
		//fonction "printant" le <head> d'un fichier html.
		//granularite niveau dans l'arborescence par rapport à la racine (granu = (nb slash entre fichier et projet_MGM) - 1)

		$prefix="";
		for($i=0;$i<$granularite;$i++)$prefix.="../";
		print'
			  <head>
				<meta charset="utf-8">
				<meta http-equiv="X-UA-Compatible" content="IE=edge">
				<meta name="viewport" content="width=device-width, initial-scale=1">
				<title>MGM Cohorte</title>

				<link rel="stylesheet" href="'.$prefix.'lib/bootstrap/css/bootstrap.min.css" />
				<link rel="stylesheet" href="'.$prefix.'css/css.css"/>

				<link rel="icon" href="'.$prefix.'resources/faceFavicon.png">

			  </head>
		';
	}

	function getConnection($granularite=0){
		//fonction "printant" le composant de connexion
		//granularite niveau dans l'arborescence par rapport à la racine
		$prefix="";
		for($i=0;$i<$granularite;$i++)$prefix.="../";
		if(!isset($_SESSION["coco"])){
			print'
					<form class="form-inline navbar-nav ml-auto" id="formauthen">
					  <div class="form-group nav-item justify-content-end">
							<input class="w-25 form-control" type="text" id="nomu" required placeholder="nom utilisateur" />
							<input class="w-25 form-control" type="password"  id="motp" required placeholder="mot de passe" />
						</div>
						<button type="submit" class="btn btn-primary">Se Connecter</button>
					</form>
			';
		}
		else{
			print'
					<form class="form-inline navbar-nav ml-auto justify-content-end" id="formdeco">
						<span>'.$_SESSION['coco'].'</span>
						<button type="submit" class="btn btn-primary btn-outline-success">Se Deconnecter</button>
					</form>
			';
		}
	}


	function getNav($granularite=0){
		//fonction "printant" la bar de navigation
		//granularite niveau dans l'arborescence par rapport à la racine
		$prefix = "";
		for($i=0;$i<$granularite;$i++)$prefix.="../";
		print'
			<nav class="navbar navbar-nav navbar-expand-lg navbar-light bg-light">
				  <a class="navbar-brand" href="#"><img src="'.$prefix.'resources/ISPED-UBX_2019RVB.jpg" alt="logo ISPED UBordeaux"></a>
				  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				  </button>
				  Projet INF204
				  <div class="collapse navbar-collapse" id="navbarNavDropdown">
					<ul class="navbar-nav">
					<li class="nav-item active">
						<a class="nav-link" href="'.$prefix.'index.php">Accueil <span class="sr-only">(current)</span></a>
					  </li>
					  <li class="nav-item active">
						<a class="nav-link" href="'.$prefix.'pages/aide.php">Aide <span class="sr-only">(current)</span></a>
					  </li>
					  <li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						  Créateurs
						</a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
						  <a class="dropdown-item" href="#">Gregory</a>
						  <a class="dropdown-item" href="#">Manon</a>
						  <a class="dropdown-item" href="#">Marc</a>
						</div>
					  </li>
					</ul>';
			getConnection($granularite);
			print'
				  </div>
				</nav>
				<img src="'.$prefix.'resources/chi.gif" id="chi" style="width:200px;" >

		';

	}


	function getStart($granularite=0){
		//fonction "printant" le début d'un fichier html avec le <head> et la bar de navigation
		//granularite niveau dans l'arborescence par rapport à la racine

		$prefix = "";
		for($i=0;$i<$granularite;$i++)$prefix.="../";


		print'
			<!doctype html>
			<html lang="fr">
			  ';
		getHead($granularite);
		print'
			  <body>
		';
		getNav($granularite);

	}

	function getEnd($granularite=0){
		//fonction "printant" la fin d'un fichier html avec les appels aux scripts js (bootstrap, jquery,...)
		//granularite niveau dans l'arborescence par rapport à la racine

		$prefix = "";
		for($i=0;$i<$granularite;$i++)$prefix.="../";


		print'
			<script src="'.$prefix.'lib/jquery/jquery-3.4.1.min.js"></script>
			<script src="'.$prefix.'lib/bootstrap/js/bootstrap.min.js"></script>
			<script src="'.$prefix.'js/js.js"></script>
		  </body>
		</html>
		';

	}
?>
