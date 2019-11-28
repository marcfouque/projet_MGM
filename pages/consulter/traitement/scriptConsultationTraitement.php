<?php session_start();

		//Script consultation traitement

require "../../../tools/functionsPrint.php";
require "../../../tools/functionsParams.php";

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

      $requete = "SELECT patient.NOM, patient.PRENOM, patient.DDN FROM patient INNER JOIN (rel_patient_traitement INNER JOIN ths_traitement on rel_patient_traitement.NUMTTT = ths_traitement.NUMTTT) ON patient.NUMPAT = rel_patient_traitement.NUMPAT WHERE LIBELLETTT like :nom_traitement";
      $req = $bdd->prepare($requete);
      $req->execute(array(':nom_traitement' => $_GET['libtrait']));
        //$NbreData = $req->rowCount();
      $resultat = $req->fetch();

      echo '<h1>Vous avez recherché : '.$_GET['libtrait'].'</h1>';
      

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


?>