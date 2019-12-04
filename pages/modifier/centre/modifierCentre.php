<?php
session_start();
require "../../../tools/functionsParams.php";

if(isset($_SESSION['coco'])){
  $bool=true;
  $mess="";
  $mesParams = (count($_GET)==0?array(99,"0 parametre",null):verifParams("modifCentre",$_GET));
   if($mesParams[0]==1){
     require "../../../tools/connect.php";

        //construction requete
        $requete = "update patient set idCentre = :idCentre where nom=:nompat and prenom=:prenompat and ddn=:ddn;";

     		$req = $bdd->prepare($requete);
     		try {
            $resultat=$req->execute(array(":nompat"=>$mesParams[1]['nompat'],":prenompat"=>$mesParams[1]['prenompat'],":ddn"=>$mesParams[1]['ddn'],":idCentre"=>$mesParams[1]['idCentre']));
     				$bool=false;
            //adresse retour à changer
            header('Location: ../../consulter/centre/formConsultCentre.php');
            exit;
     		} catch (PDOException $e) {
     		   //une erreur s'est produite, $bool le signifiera
          $mess='<p>'.implode(" _ ",$req->errorInfo()).'</p>';

     		}
     		$req->closeCursor() ;
   }
   if($bool){
     require "../../../tools/functionsPrint.php";
    getStart(3);
    echo $bool;
    echo $mess;
    //if($mesParams[0]==1)echo'<p><b>'.$mesParams[1].'</b></p>';
    echo'<p><b>'.$mesParams[1].'</b></p>';
     echo'<p class="display-4">La modification a échoué, <a href="../../consulter/examen/formConsultExamen.php">retour</a></p>';
     getEnd(3);
   }
}
else{
  require "../../../tools/functionsPrint.php";
  getStart(3);
  echo'<h2>403</h2>';
  echo'<p class="display-4">Vous devez etre connecté pour modifier un élément</p>';
  getEnd(3);
}

 ?>
