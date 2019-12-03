<?php
session_start();
require "../../../tools/functionsParams.php";
     require "../../../tools/functionsPrint.php";

getStart(3);
if(isset($_SESSION['coco'])){
  $bool=4;
  $mess="";
  $mesParams = (count($_GET)==0?array(99,"0 parametre",null):verifParams("suppPat",$_GET));
  //echo $mesParams[0];

   if($mesParams[0]==1){
     require "../../../tools/connect.php";

        //construction requete
        $requete = "delete from patient where numpat = :nump";
		$req = $bdd->prepare($requete);

     		try {
     		    $resultat=$req->execute(array(":nump"=>$mesParams[1]['numpat']));
     				$bool=5;
		echo'<p class="display-4">La suppression a réussi, <a href="../../consulter/patient/formConsultPatient.php">retour</a></p>';
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
     echo'<p class="display-4">La suppression a échoué, <a href="../../consulter/patient/formConsultPatient.php">retour</a></p>';
   }

}else{
  echo'<h2>403</h2>';
  echo'<p class="display-4">Vous devez etre connecté pour supprimer un élément</p>';

}
  getEnd(3);
 ?>
