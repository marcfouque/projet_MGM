<?php 
session_start(); 
require "../../../tools/functionsPrint.php";
getStart(3);
require "../../../tools/functionsParams.php";

$mesParams = verifParams("modifTraitPat",$_GET);
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


			$requete = 'UPDATE `rel_patient_traitement` SET `NUMPAT`=:nump,`NUMTTT`=:numt,`DATEDEB`=:datedeb,`DATEFIN`=:datefin';
			$req = $bdd->prepare($requete);
			$req->execute(array(':nump' => $_GET['$MOTCLEF.NUMPAT'], ':numt' => $_GET['$MOTCLEF.NUMTTT'], ':datedeb' => $_GET['$MOTCLEF.datedeb'], ':datefin' => $_GET['$MOTCLEF.datefin'], ));
			

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
	}
}
	

	getEnd(3);
	?>
