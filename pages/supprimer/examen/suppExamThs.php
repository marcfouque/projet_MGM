<?php
session_start();
require "../../../tools/functionsParams.php";

if(isset($_SESSION['coco'])){
  $bool=true;
  $mess="";
  $mesParams = (count($_GET)==0?array(99,"0 parametre",null):verifParams("suppExamThs",$_GET));
   if($mesParams[0]==1){
     require "../../../tools/connect.php";

        //construction requete
        //$requete = "update ths_examen set numexam = :nume, libellexam = :lab, valmin = :minexam, valmax = :maxexam where numexam = :nume;";
        $requete = "delete from ths_examen where numexam = :nume; ";

     		$req = $bdd->prepare($requete);

     		try {
     		    $resultat=$req->execute(array(":nume"=>$mesParams[1]['numexam']));
     				$bool=false;
            header('Location: ../../consulter/examen/formConsultExamen.php?numexam='.$mesParams[1]['numexam'].'&choixreq=0');
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
     echo'<p class="display-4">La suppression a échoué, <a href="../../consulter/examen/formConsultExamen.php">retour</a></p>';
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
