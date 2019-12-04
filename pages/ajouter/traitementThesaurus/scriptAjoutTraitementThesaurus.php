<?php session_start(); 

require "../../../tools/functionsPrint.php";
require "../../../tools/functionsParams.php";
getStart(3);
require "../../../tools/connect.php";


$mesParams = verifParams("ajoutTraitThs",$_GET);
		if($mesParams[0]==0){//parametre manquant
			'<aside class="alert alert-warning alertParam container-fluid " role="alert">
					<p class="display-4"> Parametre manquant. <a href="#'.$mesParams[2].'"> Voir le paramètre manquant</a>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true" class="display-4">&times;</span>
						</button>
					</p>
				</aside>'
			;
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
				<article class="alert alert-success" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="alert-heading">Bien joué !</h4>
				<p>Le traitement "'.$_GET['treatadd'].'" a bien été ajouté.</p>
				<hr>
				<a href="../../ajouter/traitementThesaurus/formAjoutTraitementThesaurus.php"> Retour au formulaire </a>
				</article>
				';

			} catch (PDOException $e){
				print'
				<article class="alert alert-danger" role="alert">
				<p>L\'ajout du traitement a échoué
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</p>
				<a href = "../../ajouter/traitementThesaurus/formAjoutTraitementThesaurus.php">Retour au formulaire</a>
				</article>
				';

			}

			$req->closeCursor();
		} else {
			print'

			<article class="alert alert-warning" role="alert">
			<p>Vous n\'êtes pas connectés !
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
			</button>
			</p>
			<a href = "../../ajouter/traitementThesaurus/formAjoutTraitementThesaurus.php">Retour au formulaire</a>
			</article>';
		}

		getEnd(3);
		?>