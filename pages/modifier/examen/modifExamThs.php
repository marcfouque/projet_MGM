<?php
session_start();
require "../../../tools/functionsParams.php";

if(isset($_SESSION['coco'])){//si connecté
  $bool=true;
  $mess="";
  $mesParams = (count($_GET)==0?array(99,"0 parametre",null):verifParams("modifExamThs",$_GET));
   if($mesParams[0]==1){
     require "../../../tools/connect.php";

        //construction requete
        $requete = "update ths_examen set numexam = :nume, libellexam = :lab, valmin = :minexam, valmax = :maxexam where numexam = :nume;";

     		$req = $bdd->prepare($requete);

     		try {
     		    $resultat=$req->execute(array(":nume"=>$mesParams[1]['numexam'],":lab"=>$mesParams[1]['libexam'],":minexam"=>$mesParams[1]['minexam'],":maxexam"=>$mesParams[1]['maxexam']));
     				$bool=false;
            header('Location: ../../consulter/examen/formConsultExamen.php?numexam='.$mesParams[1]['numexam'].'&choixreq=0');
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
    echo'<p><b>'.implode(" ",$mesParams[1]).'</b></p>';
     echo'<p class="display-4">La modification a échoué, <a href="../../consulter/examen/formConsultExamen.php">retour</a></p>';
     getEnd(3);
   }

}else{//non connecté
  require "../../../tools/functionsPrint.php";
  getStart(3);
  echo'<h2>403</h2>';
  echo'<p class="display-4">Vous devez etre connecté pour modifier un élément</p>';
  getEnd(3);
}

 ?>
