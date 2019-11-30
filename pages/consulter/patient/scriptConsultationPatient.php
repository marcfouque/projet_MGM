<?php session_start(); 

		//Script consultation centre


		
		require"../../../tools/functionsPrint.php";
		require "../../../tools/functionsParams.php";
		getStart(3);
		
		$mesParams = verifParams("consultPatient",$_GET);
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
		
		$requete = 'SELECT * FROM `patient` WHERE patient.numpat LIKE :idpat';
		$req = $bdd->prepare($requete);
		$req->execute(array(':idpat' => $_GET['numpat']));	
		$resultat = $req->fetch();
		if($resultat){//verif si resultat
			
    echo '<h3>Liste des patients</h3>
    <div class="table-responsive">
    <table class="table table-hover">
    
    <thead>
    <tr>
	  <td>NumPat</td>
      <td>Nom</td>
      <td>Prénom</td>
      <td>Date de naissance</td>
	  <td>Sexe</td>
	  <td>Consanguinité parentale</td>
	  <td>Nb semaines daménorrhée</td>
	  <td>Poids à la naissance</td>
	  <td>Taille à la naissance</td>
	  <td>PCNais</td>
	  <td>Id du centre</td>
	  <td>Maladie contractée</td>
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
	  echo'<td>'.$resultat[4].'</td>';
	  echo'<td>'.$resultat[5].'</td>';
	  echo'<td>'.$resultat[6].'</td>';
	  echo'<td>'.$resultat[7].'</td>';
	  echo'<td>'.$resultat[8].'</td>';
	  echo'<td>'.$resultat[9].'</td>';
	  echo'<td>'.$resultat[10].'</td>';
	  echo'<td>'.$resultat[11].'</td>
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
      echo "Aucun patient n'a été trouvé <br/>";
   }
   $req->closeCursor() ;
  }
  print 
		'
		<form action="formConsultPatient.php" method="GET"
		<div class="input-group">
		<input class="btn btn-primary" type="submit" value="Rechercher un autre patient">
  		</div><br/>
  		</form>';
		
getEnd(3);	
		?>