<?php session_start();

		//Script consultation centre



		require"../../../tools/functionsPrint.php";
		require "../../../tools/functionsParams.php";
		getStart(3);

		$mesParams = verifParams("consultCentre",$_GET);

		if($mesParams[0]==0){//parametre manquant
			echo "coucou";
		}
		else if($mesParams[0]==2){//parametre invalide
			echo "coucou";
		}
		else if($mesParams[0]==1){//parametres bons
			require "../../../tools/connect.php";


		$requete = 'SELECT NUMPAT, `PRENOM`,`NOM`,`DDN`, patient.idcentre FROM `patient` INNER JOIN ths_centre ON patient.IDCENTRE = ths_centre.IDCENTRE WHERE ths_centre.LIBELLECENTRE LIKE :ville';



		echo '<h1>Vous avez recherché : '.$_GET['choixville'].'</h1>';
      $formModifLigne= '<form class="container modal-body" action="../../modifier/centre/modifierCentre.php" method="get">
      <div class="modal-body">
      <input type="hidden" name="numpat" value="§MOTCLEF.numpat"/>
	  <label for="numpat" >Identifiant du patient</label>
	  <input type="number" name="numpa" disabled value="§MOTCLEF.numpat"/>
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
  }

getEnd(3);
		?>
