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
   $req->closeCursor() ;
  }
		
getEnd(3);	
		?>