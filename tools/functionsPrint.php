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
						<button type="submit" class="btn btn-outline-success">Se Deconnecter</button>
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
						<a class="nav-link dropdown-toggle" href="#" id="dropAjou" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						  Ajouter
						</a>
						<div class="dropdown-menu" aria-labelledby="dropAjou">
						  <a class="dropdown-item" href="#" >Nouveau Traitement</a>
					    <a class="dropdown-item" href="#"  >Nouvel Examen</a>
							<a class="dropdown-item" href="#"  >Traitement à un Patient</a>
							<a class="dropdown-item" href="'.$prefix.'pages/ajouter/examens/formAjoutExam.php"  >Examen à un Patient</a>
						</div>
					  </li>
						<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="dropConsul" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						  Consulter
						</a>
						<div class="dropdown-menu" aria-labelledby="dropConsul">
						  <a class="dropdown-item" href="'.$prefix.'pages/consulter/patient/consultpatient.php" >Patient</a>
					    <a class="dropdown-item" href="'.$prefix.'pages/consulter/examen/formConsultExamen.php"  >Examen</a>
					    <a class="dropdown-item" href="#"  >Centre</a>
						 	<a class="dropdown-item" href="#"  >Traitement</a>
						</div>
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

	function getResultatRequete($requete, $arrexec, $colonnesVisible,$formModifLigne, $formSuppLigne, $bdd){
		//fonction permettant d'afficher les rsultats sous la forme d'un tableeau
		//$requete = String format sql , représentant la requte transmise à la base de données
		//$arrexec = array() associatif, des termes à remplacer lors de l'execution de la requete, $req->execute(ARRAY)
		//$formModifLigne = string format html correspondant au formaulaire de modification de la ligne
		//$formSuppLigne =  string format html correspondant au formaulaire de suppression de la ligne
		//$bdd un objet base de données contenant la connexion à la base de données, /tools/connect.php
		//$colonnesVisible un array des noms de colonne que l'on veut voir apparaitre (en minuscules)


		function remplaceMotClef($form, $colonne,$resultat){
			//remplace tous les mots-clefs dinserer dans les formauliares par les valeurs correspondantes
			$formulaire = $form;	//clone de $form
			$chaineRecap = "";		//chaine recapitulative de la ligne, utile pour §MOTCLEFS
			//for($i = 0; $i < count($colonne)-1; $i++){	//colonne-1 pour enlever "action" (derniere colonne avec les boutons)
			for($i = 0; $i < count($colonne); $i++){	//colonne-1 pour enlever "action" (derniere colonne avec les boutons)
				$formulaire = str_replace("§MOTCLEF.".strtolower($colonne[$i]),$resultat[$i],$formulaire);	//remplacement du mot clef, nom varaible en minuscule
				$chaineRecap .= '<span class="text-muted">'.$colonne[$i].' :<b class="text-muted">'.$resultat[$i].'</b>, </span>';
			}
			$chaineRecap = substr($chaineRecap,0,-9).substr($chaineRecap, -7);
			$formulaire = str_replace("§MOTCLEFS",$chaineRecap,$formulaire);
			return $formulaire;
		}
		//preparation requete
		$req = $bdd->prepare($requete);
		$req->execute($arrexec);
		$resultat = $req->fetch();

		if($resultat){//verif si resultat

			//récupération noms colonnes
			$colonnes = array();
			$colonnesVisi=array();
			$colonnesVisiIndex=array();
			for ($i = 0; $i < $req->columnCount(); $i++){
				$col = $req->getColumnMeta($i);
				$colonnes[$i] = $col['name'];
				if(in_array (strtolower($col['name']) , $colonnesVisible)){//$colonnesVisi[$i] = $col['name'];
					array_push ($colonnesVisi, $col['name']);
					array_push($colonnesVisiIndex,$i);
				}
			}
			//$colonnes[$req->columnCount()]="Actions";
			$colonnesVisi[count($colonnesVisi)]="Actions";
			//echo implode("_",$colonnesVisi);
			print'
				<div class="table-responsive">
			  	<table class="table table-hover">
			';
			print'
				<thead>
			    <tr>';
			foreach($colonnesVisi as $c)echo'<th scope="col">'.$c.'</th>';
			print'
				</tr>
		  </thead>
			';

			//pour stocker les modals
			$modalsModif = "";
			$modalsSupp = "";

			do {//iteration sur toutes les lignes
				//identifiant unique de la ligne (servant d'id pour les modals)
				$idunique = "";

				echo'<tr>';
				for($i=0;$i<count($colonnesVisi)-1;$i++){//iterationàà traverslesResultat
					//echo'<td>'.$resultat[$i].'</td>';
					//$idunique.=$resultat[$i];
					echo'<td>'.$resultat[$colonnesVisiIndex[$i]].'</td>';
					$idunique.=$resultat[$colonnesVisiIndex[$i]];
				}
				$idunique = 'id'.str_replace(",","",str_replace("-","",$idunique));
				print'
				<td>
					<div class="btn-group" role="group" aria-label="Button group with nested dropdown">
					  <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#'.$idunique.'modif" >Modifier</button>
					  <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#'.$idunique.'supp" >Supprimer</button>
					</div>
				</td>
				';

				//pour l'apparition de la fenetre de modification (modalmodif)

				$modalsModif.='
				<div class="modal fade" id="'.$idunique.'modif" tabindex="-1" role="dialog" aria-labelledby="'.$idunique.'modifLabel" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="'.$idunique.'modifLabel">Modification</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							'.remplaceMotClef($formModifLigne,$colonnes,$resultat).'
						</div>
					</div>
				</div>';

				//pour l'apparition de la fenetre de suppression (modalmodif)

				$modalsSupp.='
					<div class="modal fade" id="'.$idunique.'supp" tabindex="-1" role="dialog" aria-labelledby="'.$idunique.'suppLabel" aria-hidden="true">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="'.$idunique.'suppLabel">Supprimer l\'enregistrement</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								'.remplaceMotClef($formSuppLigne,$colonnes,$resultat).'
							</div>
						</div>
					</div>
				';

				echo'</tr>';
			} while ($resultat = $req->fetch());

			print'
			 </table>
		 </div>
			';

			print '<div>'.$modalsModif.'</div>';
			print '<div>'.$modalsSupp.'</div>';
		}
		else{
			echo "<b>Zéro resultat pour cette requète</b><br/>";
			//echo "<b>Message de mySQL: </b>".implode("\n",$req->errorInfo());
			echo "<a href='formConsultExamen_bis.php'><p> Retour au formulaire</p></a>";
		}




		$req->closeCursor() ;



	}

?>
