<?php 
session_start(); 
require "../../../tools/functionsPrint.php";
getStart(3);
require "../../../tools/functionsParams.php";

$mesParams = verifParams("supTraitPat",$_GET);
		if($mesParams[0]==1 and isset($_SESSION['coco'])){//parametres bons et connection ok
			
			require "../../../tools/connect.php";

			$requete = "delete from rel_patient_traitement where numpat = :nump AND numttt = :numt AND datedeb = :datedeb"; // requête de suppression
			$req = $bdd->prepare($requete); // preparation de la requete
			
	
			$req->execute(array(':nump' => $_GET['numpat'], ':numt' => $_GET['numttt'], ':datedeb' => $_GET['datedeb'])); // execution de la requete
			if($req->rowCount()==0){ // vérification nombre de lignes supprimés
				// Si = 0, message de non suppression
				// Si # de 0, suppression effectuée
				print'
				<article class="alert alert-danger" role="alert">
				<p>La suppression a échouée.
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</p>
				<hr>
				<a href=../../consulter/traitement/scriptConsultationTraitement.php?libtrait='.$_GET['libtrait'].'>Retour aux résultats</a>
				</article>';
			} else { 
			print'
				<aside class="alert alert-success" role="alert">
				<p>La suppression a été effectué 
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</p>				
				</aside>
				';

			}

			$req->closeCursor() ;
		} else { // connexion non approuvée
			print'<article class="alert alert-warning" role="alert">
			<p>Vous n\'êtes pas connectés
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
			</button>
			</p>
			<hr>
			<a href=../../consulter/traitement/scriptConsultationTraitement.php?libtrait='.$_GET['libtrait'].'>Retour aux résultats</a>
			</article>';
		}
		
		

		
	

	getEnd(3);
	?>
