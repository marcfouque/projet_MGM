<?php 
session_start(); 
require "../../../tools/functionsPrint.php";
getStart(3);
require "../../../tools/functionsParams.php";

$mesParams = verifParams("modifTraitPat",$_GET);
		if($mesParams[0]==1 and isset($_SESSION['coco']) ){//parametres bons et connexion approuvée
			
			require "../../../tools/connect.php"; // connexion à la base


			$requete = 'UPDATE `rel_patient_traitement` SET `NUMPAT`=:nump,`NUMTTT`=:numt,`DATEDEB`=:datedeb,`DATEFIN`=:datefin WHERE `NUMPAT`=:nump AND `NUMTTT`=:numt AND`DATEDEB`=:datedeb';
			$req = $bdd->prepare($requete); //préparation de la requête
			
	
			$req->execute(array(':nump' => $_GET['numpat'], ':numt' => $_GET['numttt'], ':datedeb' => $_GET['datedeb'], ':datefin' =>(isset($_GET['datefin'])&&strlen($_GET['datefin']) != 0?$_GET['datefin']:null) )); 
			// condition si/sinon : date fin passé en paramètre si existante sinon valeur null passé en paramètre
			if($req->rowCount()==0){ // vérification nb de lignes affectés. Si = 0, modification annulée
				print'
				<article class="alert alert-danger" role="alert">
				<p>La modification a échouée !
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</p>
				<hr>
				<a href=../../consulter/traitement/scriptConsultationTraitement.php?libtrait='.$_GET['libtrait'].'>Retour aux résultats</a>
				</article>';
				
			} else { // Si différent de 0, succès de la modification
			print'
				<aside class="alert alert-success" role="alert">
				<h4>Super !</h4>
				<p>Les modifications ont été effectués.
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</p>
				</aside>
				';

			}

			$req->closeCursor() ;
		} else { // si connexion non présente
			print'<article class="alert alert-warning" role="alert">
			<p>Vous n\'êtes pas connectés
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
			</button>
			</p>
			<hr>
			<a href=../../consulter/traitement/scriptConsultationTraitement.php?libtrait='.$_GET['libtrait'].'>Retour aux résultats</a>
			</article>
		
		';
	}
		
	

	getEnd(3);
	?>
