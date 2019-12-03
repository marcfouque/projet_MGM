<?php session_start();

		//Script consultation traitement

require "../../../tools/functionsPrint.php";
require "../../../tools/functionsParams.php";
getStart(3);

$mesParams = verifParams("consultTrait",$_GET);
		if($mesParams[0]==0){//parametre manquant
			print '
     <p class="display-4"> Parametre manquant <a href="#'.$mesParams[2].'"> Voir le paramètre manquant</a></p>';
   }
		else if($mesParams[0]==2){//parametre invalide
			print ' <p> Le paramètre est invalide </p>';
		}
		else if($mesParams[0]==1){//parametres bons
      require "../../../tools/connect.php";

      $requete = "SELECT P.NUMPAT, NOM, PRENOM, R.NUMTTT, LIBELLETTT, DATEDEB, DATEFIN FROM patient P INNER JOIN (rel_patient_traitement R INNER JOIN ths_traitement T on R.NUMTTT = T.NUMTTT) ON P.NUMPAT = R.NUMPAT WHERE LIBELLETTT like :nom_traitement";
     // $req = $bdd->prepare($requete);
     // $req->execute(array(':nom_traitement' => $_GET['libtrait']));
        //$NbreData = $req->rowCount();
      //$resultat = $req->fetch();

      echo '<h1>Vous avez recherché : '.$_GET['libtrait'].'</h1>';
      $formModifLigne= '<form class="container modal-body" action="../../modifier/traitement/modifTraitPat.php" method="get">
                        <div class="modal-body">
                        <input type="hidden" name=""
                          <div class="form-group">
                            <label for="nompat" >Nom du patient</label>
                            <input type="text" class="form-control" name="nompat" placeholder="saisissez le nom du patient" value="§MOTCLEF.nom" >

                          </div>
                          <div class="form-group">
                            <label for="prenompat" >Prénom du patient</label>
                            <input type="text" class="form-control" name="prenompat" placeholder="saisissez le prénom du patient" value="§MOTCLEF.prenom" 
                          </div>
                           <div class="form-group">
                            <label for="libttt" >Nom du traitement</label>
                            <input type="text" class="form-control" name="libttt" placeholder="saisissez le libellé du traitement" value="§MOTCLEF.libellettt" >
                          </div>
                          <div class="form-group form-inline">
                          <fieldset><legend>Prise du traitement</legend>
                            <label for="datedebttt" >Début de prise</label>
                            <input type="date" style="margin-left:10px;" class="form-control" name="datedebttt" placeholder="saisissez la date du début de la prise de traitement" value="§MOTCLEF.datedeb" >
                            <label for="datefinttt" >Fin de prise</label>
                            <input type="date" style="margin-left:10px;" class="form-control" name="datefinttt" placeholder="saisissez la date de fin de la prise de traitement" value="§MOTCLEF.datefin" >
                            </fieldset>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                          <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
                        </div>
                    </form>';

      $formSuppLigne = '<form class="container modal-body" action="../../supprimer/examen/suppExamThs.php" method="get">
                        <div class="modal-body">
                          <input type="hidden" class="form-control" name="numexam">
                          <p>§MOTCLEFS</p>
                        </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary">Supprimer l\'enregistrement</button>
                      </div>
                    </form>';           
      getResultatRequete($requete,array(':nom_traitement' => $_GET['libtrait']),array("nom","prenom","datedeb", "datefin"),$formModifLigne,$formSuppLigne,$bdd);

/*if($resultat){//verif si resultat
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
      echo'<td>'.$resultat[2].'</td>';
      echo'<td>'.$resultat[3].'</td>';
      echo'<td>'.$resultat[4].'</td>

      <td>
        <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
          <button type="button" class="btn btn-secondary">Modifier</button>
          <button type="button" class="btn btn-secondary">Supprimer</button>
        </div>
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
   $req->closeCursor() ;*/
  }

getEnd(3);
?>