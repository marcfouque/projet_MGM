<?php 
session_start(); 
require "../../../tools/functionsPrint.php";
getStart(3);
require "../../../tools/functionsParams.php";

$mesParams = verifParams("supTraitPat",$_GET);
		if($mesParams[0]==0){//parametre manquant
			echo $mesParams[1];
		}
		else if($mesParams[0]==2){//parametre invalide
			echo $mesParams[1];
		}
		else if($mesParams[0]==1 and isset($_SESSION['coco'])){//parametres bons
			//$mesParams = $mesParams[1];
			//print implode(" _ ",$mesParams);
			require "../../../tools/connect.php";
$mesParams[1]["numpat"];
			$requete = "delete from rel_patient_traitement where numpat = :nump AND numttt = :numt AND datedeb = :datedeb";
			$req = $bdd->prepare($requete);
			
	
			$req->execute(array(':nump' => $_GET['numpat'], ':numt' => $_GET['numttt'], ':datedeb' => $_GET['datedeb']));
			if($req->rowCount()==0){
				print'
				<article class="alert alert-danger" role="alert">
				<p>La suppression a échouée.
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</p>
				</article>';
				echo'<p><a href=../../consulter/traitement/scriptConsultationTraitement.php?libtrait='.$_GET['libtrait'].'>Retour aux résultats</a></p>';
			} else {
			print'
				<aside class="alert alert-success alertParam" role="alert">
				<p>La suppression a été effectué.
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</p>
				</aside>
				';

			}

			$req->closeCursor() ;
		} else {
			print'<article class="alert alert-warning" role="alert">
			<p>Vous n\'êtes pas connectés
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
			</button>
			</p>
			</article>';
		}
		
		

		
	

	getEnd(3);
	?>
