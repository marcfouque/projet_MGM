<?php
session_start();
require "../../../tools/functionsParams.php";
     require "../../../tools/functionsPrint.php";

getStart(3);
if(isset($_SESSION['coco'])){
  $bool=4;
  $mess="";
  $mesParams = (count($_GET)==0?array(99,"0 parametre",null):verifParams("modifPat",$_GET));
  //echo $mesParams[0];

   if($mesParams[0]==1){
     require "../../../tools/connect.php";
		$t=isset($_GET['nompat']);
		echo $t;
        //construction requete
        $requete = "UPDATE patient SET prenom = :nvprenom, nom = :nvnom, ddn = :nvddn, sexe = :nvsexe, consangpar = :nvcons, samen = :nvsamen, pdsnais = :nvpds, taillenais = :nvtaille, pcnais = :nvpc where numpat= :idpat";
		$req = $bdd->prepare($requete);

     		try {
     		    $resultat=$req->execute(array(
				"idpat"=> $mesParams[1]['numpat'],
				'nvprenom' => $mesParams[1]['prenompat'],
				'nvnom' => $mesParams[1]['nompat'],
				'nvddn' => $mesParams[1]['ddn'],
				'nvsexe' => $mesParams[1]['sexe'],
				'nvcons' => $mesParams[1]['consang'],
				'nvsamen' => $mesParams[1]['nbame'],
				'nvpds' => $mesParams[1]['pdsnaiss'],
				'nvtaille' => $mesParams[1]['taillenaiss'],
				'nvpc' => $mesParams[1]['pcnaiss']));
     			$bool=5;
		echo'<p class="display-4">La modification a réussi, <a href="../../consulter/patient/formConsultPatient.php">retour</a></p>';
            exit;
     		} catch (PDOException $e) {

     		   //une erreur s'est produite, $bool le signifiera
          $mess='<p>'.implode(" _ ",$req->errorInfo()).'</p>';

     		}
     		$req->closeCursor() ;

   }
   
   if($bool==4){
    echo $bool;
    echo $mess;
    echo'<p><b>'.implode(" ",$mesParams[1]).'</b></p>';
     echo'<p class="display-4">La modification a échoué, <a href="../../consulter/patient/formConsultPatient.php">retour</a></p>';
   }

}else{
  echo'<h2>403</h2>';
  echo'<p class="display-4">Vous devez etre connecté pour modifier un élément</p>';

}
  getEnd(3);
 ?>