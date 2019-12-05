<?php
session_start();
require "../../../tools/functionsParams.php";

if(isset($_SESSION['coco'])){//verification user connecté
  $bool=true;
  $mess="";
  $mesParams = (count($_GET)==0?array(99,"0 parametre",null):verifParams("modifCentre",$_GET));
   if($mesParams[0]==1){//si les parametres sont bons
     require "../../../tools/connect.php";

        //construction requete
        $requete = "update patient set idCentre = :idCentre where numpat=:numpat;";

     		$req = $bdd->prepare($requete);
     		try {
            $resultat=$req->execute(array(":numpat"=>$mesParams[1]['numpat'], ":idCentre" => $mesParams[1]['idCentre'] ));
     				$bool=false;
            //redirection automatique
            header('Location: ../../consulter/centre/formConsultCentre.php');
            exit;
     		} catch (PDOException $e) {
     		   //une erreur s'est produite, $bool le signifiera
          $mess='<p>'.implode(" _ ",$req->errorInfo()).'</p>';

     		}
     		$req->closeCursor() ;
   }
   if($bool){//si erreur
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
else{//si utilisateur non connecté
  require "../../../tools/functionsPrint.php";
  getStart(3);
  echo'<h2>403</h2>';
  echo'<p class="display-4">Vous devez etre connecté pour modifier un élément</p>';
  getEnd(3);
}

 ?>
