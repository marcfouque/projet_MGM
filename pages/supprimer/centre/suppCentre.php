<?php
session_start();
require "../../../tools/functionsParams.php";

if(isset($_SESSION['coco'])){
  $bool=true;
  $mess="";
  $mesParams = (count($_GET)==0?array(99,"0 parametre",null):verifParams("suppCentre",$_GET));
   if($mesParams[0]==1){
     require "../../../tools/connect.php";

        //construction requete
        //$requete = "update ths_examen set numexam = :nume, libellexam = :lab, valmin = :minexam, valmax = :maxexam where numexam = :nume;";
        $requete = "UPDATE patient SET idcentre = null WHERE NOM=:nompat and PRENOM=:prenompat and ddn=:ddnpat;";

     		$req = $bdd->prepare($requete);

     		try {
     		    $resultat=$req->execute(array(":nompat"=>$mesParams[1]['nompat'],":prenompat"=>$mesParams[1]['prenompat'],":ddnpat"=>$mesParams[1]['ddn']));
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
   if($bool){
     require "../../../tools/functionsPrint.php";
    getStart(3);
    echo $bool;
    echo $mess;
    //if($mesParams[0]==1)echo'<p><b>'.$mesParams[1].'</b></p>';
    echo'<p><b>'.implode(" ",$mesParams[1]).'</b></p>';
     echo'<p class="display-4">La suppression a échoué, <a href="../../consulter/examen/formConsultCentre.php">retour</a></p>';
     getEnd(3);
   }

}else{
  require "../../../tools/functionsPrint.php";
  getStart(3);
  echo'<h2>403</h2>';
  echo'<p class="display-4">Vous devez etre connecté pour supprimer un élément</p>';
  getEnd(3);
}

 ?>
