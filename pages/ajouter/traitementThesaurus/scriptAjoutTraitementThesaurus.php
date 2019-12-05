<?php session_start(); 

require "../../../tools/functionsPrint.php"; // affichage de la page html
require "../../../tools/functionsParams.php"; // utilisation fonctions liés au paramètre (vérification...)
getStart(3); // appel de toutes les fonctions indispensables au fonctionnement de la page et du script
require "../../../tools/connect.php"; // connexion à la base


$mesParams = verifParams("ajoutTraitThs",$_GET);
		if($mesParams[0]==0){//parametre manquant
			print '<aside class="alert alert-warning " role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true" class="display-4">&times;</span>
						</button>
					<p> Oups... le paramètre est manquant</p>
					<a href = "../../ajouter/traitementThesaurus/formAjoutTraitementThesaurus.php">Retour au formulaire</a>
				</aside>'
			;
		}
		else if($mesParams[0]==2){//parametre invalide
			print '<aside class="alert alert-warning " role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true" class="display-4">&times;</span>
						</button>
					<p> Oups... le paramètre est invalide</p>
					<a href = "../../ajouter/traitementThesaurus/formAjoutTraitementThesaurus.php">Retour au formulaire</a>
				</aside>'
			;
		}
		else if($mesParams[0]==1 and isset($_SESSION['coco'])){//parametres bons et connecté à une session
			

			$requete = "INSERT INTO ths_traitement (LIBELLETTT) VALUES (:tttadd)";
			$req = $bdd->prepare($requete);


			try { // ajout try/catch pour mettre en avant toute erreur dans l'échange avec la base
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
		} else { //
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