<?php session_start();

		require"../../../tools/functionsPrint.php";
		require "../../../tools/functionsParams.php";
		getStart(3);
		require "../../../tools/connect.php";

		$mesParams = verifParams("consultCentre",$_GET);

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
		else if($mesParams[0]==1){//parametres bons	


		$requete = 'SELECT NUMPAT, `PRENOM`,`NOM`,`DDN`, patient.idcentre FROM `patient` INNER JOIN ths_centre ON patient.IDCENTRE = ths_centre.IDCENTRE WHERE ths_centre.LIBELLECENTRE LIKE :ville';



		echo '<h1>Vous avez recherché : '.$_GET['choixville'].'</h1>';

	//affichage des fenêtres modals "Modifier" et "Supprimer" (certaines valeurs non affichés dans la fenêtre modale doivent tout de même mentionnés en "hidden" pour être réutilisés par modifier ou supprimer)
	// valeurs récupérés grâce à mot clef
      $formModifLigne= '<form class="container modal-body" action="../../modifier/centre/modifierCentre.php" method="get">
      <div class="modal-body">
      <input type="hidden" name="numpat" value="§MOTCLEF.numpat"/>
	  <label for="numpat" >Identifiant du patient</label>
	  <input type="number" name="numpat" disabled value="§MOTCLEF.numpat"/>
      <div class="form-group">
      <label for="nompat" >Nom du patient</label>
      <input type="text" disabled class="form-control" name="nompat"  value="§MOTCLEF.nom" />
      </div>
      <div class="form-group">
      <label for="prenompat" >Prénom du patient</label>
      <input type="text" disabled class="form-control" name="prenompat" value="§MOTCLEF.prenom" />
      </div>
      <div class="form-group">
      <label for="libttt" >Identifiant du centre</label>
      <input type="number" class="form-control" name="idCentre" value="§MOTCLEF.idcentre" />
      </div>

      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
      <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
      </div>
      </form>';

      $formSuppLigne = '<form class="container modal-body" action="../../supprimer/centre/suppCentre.php" method="get">
      <div class="modal-body">
      <input type="hidden" class="form-control" value="§MOTCLEF.numpat" name="numpat">
      <p>§MOTCLEFS</p>
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
      <button type="submit" class="btn btn-primary">Supprimer l\'enregistrement</button>
      </div>
      </form>';

         getResultatRequete($requete,array(':ville' => $_GET['choixville']),array("nom","prenom","ddn"),$formModifLigne,$formSuppLigne,$bdd);
         //Requête 
  }

getEnd(3);
		?>
