<?php session_start(); 

require "../../../tools/functionsPrint.php";
require "../../../tools/functionsParams.php";
getStart(3);
require "../../../tools/connect.php";


$mesParams = verifParams("ajoutTraitThs",$_GET);
		if($mesParams[0]==0){//parametre manquant
			echo $mesParams[1];
		}
		else if($mesParams[0]==2){//parametre invalide
			echo $mesParams[1];
		}
		else if($mesParams[0]==1 and isset($_SESSION['coco'])){//parametres bons et connecté à une session
			//print implode(" _ ",$mesParams);

			$requete = "INSERT INTO ths_traitement (LIBELLETTT) VALUES (:tttadd)";
			$req = $bdd->prepare($requete);


			try {
				$req->execute(array(':tttadd' => $_GET['treatadd']));

				print'
				<aside class="alert alert-success alertParam" role="alert">
				<p>Traitement : '.$_GET['treatadd'].' ajouté au Thesaurus.
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</p>
				</aside>
				';
			} catch (PDOException $e){
				print'
				<article class="alert alert-danger" role="alert">
				<p>Le traitement est déjà présent.
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</p>
				</article>
				';
			
			}

			$req->closeCursor();
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