<?php session_start();

		//Script consultation traitement

require "../../../tools/functionsPrint.php";
getStart(3);
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

       $requete = "SELECT patient.NOM, patient.PRENOM FROM patient INNER JOIN (rel_patient_traitement INNER JOIN ths_traitement on rel_patient_traitement.NUMTTT = ths_traitement.NUMTTT) ON patient.NUMPAT = rel_patient_traitement.NUMPAT WHERE LIBELLETTT like :nom_traitement";
       $req = $bdd->prepare($requete);
       $req->execute(array(':nom_traitement' => $_GET['libtrait']));
       $NbreData = $req->rowCount();
       $resultat = $req->fetch();

      echo '<h1>'.$_GET['libtrait'].'</h1>';
      echo '<h3>Liste des patients</h3>';

       if($resultat){
         do {
				//echo "<p>".implode(" _ ",$resultat)."</p>";
           echo
           "<p>
           <table border ='1' class='table table-striped' width =40px>
           <thead>
           <tr>
           <th scope='col'>#</th>
           <th scope='col'>Nom</th>
           <th scope='col'>Prénom</th>
          
           </tr>
           </thead>
           <tbody>
           <tr>
           <th scope='row'></th>
           <td>".$resultat[0]."</td>
           <td>".$resultat[1]."</td>
           <td><a href='#' class='btn btn-primary btn-lg active' role='button' aria-pressed='true'>X</a></td>
           </tr>
           </tbody>
           </table>
           </p>";
        } while ($resultat = $req->fetch());
     }
     else {
      echo "Aucun traitement n'a été trouvé <br/>";
      echo "<b>Erreur dans l'exécution de la requête ou zero resultat</b><br/>";
      echo "<b>Message de mySQL: </b>".implode(" $ ",$req->errorInfo());
   }
   $req->closeCursor() ;

}


?>
