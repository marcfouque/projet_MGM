<?php session_start();

		//Script consultation centre



		require"../../../tools/functionsPrint.php";
		require "../../../tools/functionsParams.php";
		getStart(3);

		$mesParams = verifParams("consultCentre",$_GET);
		//modifier oblifalc, descParam, functionsParam
		if($mesParams[0]==0){//parametre manquant
			echo $mesParams[1];
		}
		else if($mesParams[0]==2){//parametre invalide
			echo $mesParams[1];
		}
		else if($mesParams[0]==1){//parametres bons
			require "../../../tools/connect.php";
			//$mesParams = $mesParams[1];
			//print implode(" _ ",$mesParams);


		$requete = 'SELECT `PRENOM`,`NOM`,`DDN` FROM `patient` INNER JOIN ths_centre ON patient.IDCENTRE = ths_centre.IDCENTRE WHERE ths_centre.LIBELLECENTRE LIKE :ville';
		$req = $bdd->prepare($requete);
		$req->execute(array(':ville' => $_GET['choixville']));
		$resultat = $req->fetch();
		if($resultat){//verif si resultat

    echo '<h3>Liste des patients</h3>
    <div class="table-responsive">
    <table class="table table-hover">

    <thead>
    <tr>
      <td>Nom</td>
      <td>Prénom</td>
      <td>Date de naissance</td>
      <td>Actions</td>
    </tr>
    </thead>
    ';

    do {//iteration sur toutes les lignes
      //debut ligne tableau
      echo'<tr>';
      echo'<td>'.$resultat[0].'</td>';
      echo'<td>'.$resultat[1].'</td>';
      echo'<td>'.$resultat[2].'</td>
      <td>
        <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
          <button type="button" data-toggle="modal" data-target="#'.$resultat[0].$resultat[1].$resultat[2].'modif" class="btn btn-secondary">Modifier</button>
          <button type="button" data-toggle="modal" data-target="#'.$resultat[0].$resultat[1].$resultat[2].'supp" class="btn btn-secondary">Supprimer</button>
        </div>
				<aside class="modal fade" id="'.$resultat[0].$resultat[1].$resultat[2].'modif" tabindex="-1" role="dialog" aria-labelledby="'.$resultat[0].$resultat[1].$resultat[2].'modifLabel" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="'.$resultat[0].$resultat[1].$resultat[2].'modifLabel">Modification</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<form class="container modal-body" action="../../modifier/centre/modifierCentre.php" method="get">
								<div class="modal-body">
									<div class="form-group">
										<label for="nomp" >Nom patient :</label>
										<input type="text" disabled value="'.$resultat[1].'" class="form-control" name="nomp"/>
										<input type="hidden"  value="'.$resultat[1].'" class="form-control" name="nompat"/>
										<label for="prenom" >Prénom patient :</label>
										<input type="text" disabled value="'.$resultat[0].'" class="form-control" name="prenom"/>
										<input type="hidden" value="'.$resultat[0].'" class="form-control" name="prenompat"/>
										<label for="datedn" >Date  de naissance du patient :</label>
										<input type="date" disabled value="'.$resultat[2].'" class="form-control" name="datedn"/>
										<input type="hidden" value="'.$resultat[2].'" class="form-control" name="ddn"/>
										<label for="idcentre" >Identifiant du nouveau centre du patient :</label>
										<input type="number" placeholder="identifiant du centre" class="form-control" name="idCentre"/>
									</div>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
									<button type="submit" class="btn btn-primary">Modifier l\'enregistrement</button>
								</div>
							</form>
						</div>
					</div>
				</aside>
				<aside class="modal fade" id="'.$resultat[0].$resultat[1].$resultat[2].'supp" tabindex="-1" role="dialog" aria-labelledby="'.$resultat[0].$resultat[1].$resultat[2].'suppLabel" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="'.$resultat[0].$resultat[1].$resultat[2].'suppLabel">Modification</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<form class="container modal-body" action="../../supprimer/centre/suppCentre.php" method="get">
								<div class="modal-body">
									Enlever le patient de ce centre ?
									<div class="form-group">
										<input type="hidden" value="'.$resultat[1].'" class="form-control" name="nompat"/>
										<input type="hidden" value="'.$resultat[0].'" class="form-control" name="prenompat"/>
										<input type="hidden" value="'.$resultat[2].'" class="form-control" name="ddn"/>
										<input type="hidden" value="'.$mesParams[1]['choixville'].'" class="form-control" name="libCentre"/>
									</div>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
									<button type="submit" class="btn btn-primary">Supprimer l\'enregistrement</button>
								</div>
							</form>
						</div>
					</div>
				</aside>
      </td>
      </tr>';
    } while ($resultat = $req->fetch());

    print'
    </table>
    </div>
    ';
} else {
      echo "Aucun traitement n'a été trouvé <br/>";
   }
   $req->closeCursor() ;
  }

getEnd(3);
		?>
