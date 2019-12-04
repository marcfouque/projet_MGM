<?php session_start();

		//Script consultation centre



		require"../../../tools/functionsPrint.php";
		require "../../../tools/functionsParams.php";
		getStart(3);
require "../../../tools/connect.php";
		$mesParams = verifParams("consultCentre",$_GET);
		
		if($mesParams[0]==0){//parametre manquant
			echo "coucou";
		}
		else if($mesParams[0]==2){//parametre invalide
			echo "coucou";
		}
		else if($mesParams[0]==1){//parametres bons
			


		$requete = 'SELECT `PRENOM`,`NOM`,`DDN`, LIBELLECENTRE FROM `patient` INNER JOIN ths_centre ON patient.IDCENTRE = ths_centre.IDCENTRE WHERE ths_centre.LIBELLECENTRE LIKE :ville';

		

		echo '<h1>Vous avez recherché : '.$_GET['choixville'].'</h1>';
      $formModifLigne= '<form class="container modal-body" action="../../modifier/centre/modifierCentre.php" method="get">
      <div class="modal-body">
      <input type="hidden" name="numpat" value="§MOTCLEF.numpat"/>
      <div class="form-group">
      <label for="nompat" >Nom du patient</label>
      <input type="text" class="form-control" name="nompat" placeholder="saisissez le nom du patient" value="§MOTCLEF.nom" />
      </div>
      <div class="form-group">
      <label for="prenompat" >Prénom du patient</label>
      <input type="text" class="form-control" name="prenompat" placeholder="saisissez le prénom du patient" value="§MOTCLEF.prenom" />
      </div>
      <div class="form-group">
      <label for="libttt" >Nom du traitement</label>
      <input type="text" class="form-control" name="libellecentre" placeholder="saisissez le libellé du traitement" value="§MOTCLEF.libellecentre" />
      </div>
      
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
      <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
      </div>
      </form>';

      $formSuppLigne = '<form class="container modal-body" action="../../supprimer/centre/suppCentre.php" method="get">
      <div class="modal-body">
      <input type="hidden" class="form-control" name="numttt">
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
