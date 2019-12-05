<?php
session_start();
require "../../../tools/functionsParams.php";

if(isset($_SESSION['coco'])){//si connecté
  $bool=true;
  $mess="";
  $mesParams = (count($_GET)==0?array(99,"0 parametre",null):verifParams("suppCentre",$_GET));
   if($mesParams[0]==1){
     require "../../../tools/connect.php";

        //construction requete
        $requete = "UPDATE patient SET idcentre = null WHERE numpat=:numpat;";

     		$req = $bdd->prepare($requete);

     		try {
     		    $resultat=$req->execute(array(":numpat"=>$mesParams[1]['numpat']));
     				$bool=false;
            //addresse à changer
            header('Location: ../../consulter/centre/formConsultCentre.php');
            exit;
     		} catch (PDOException $e) {
     		   //une erreur s'est produite, $bool le signifiera
          $mess='<p>'.implode(" _ ",$req->errorInfo()).'</p>';

     		}
     		$req->closeCursor() ;
   }
   if($bool){//print si erreur
     require "../../../tools/functionsPrint.php";
    getStart(3);
    echo $bool;
    echo $mess;
    echo'<p><b>'.implode(" ",$mesParams[1]).'</b></p>';
     echo'<p class="display-4">La suppression a échoué, <a href="../../consulter/examen/formConsultCentre.php">retour</a></p>';
     getEnd(3);
   }

}else{//pas connecté
  require "../../../tools/functionsPrint.php";
  getStart(3);
  echo'<h2>403</h2>';
  echo'<p class="display-4">Vous devez etre connecté pour supprimer un élément</p>';
  getEnd(3);
}

 ?>
