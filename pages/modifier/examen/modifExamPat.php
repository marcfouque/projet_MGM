<?php
session_start();
require "../../../tools/functionsParams.php";

if(isset($_SESSION['coco'])){
  $bool=true;
  $mesParams = (count($_GET)==0?array(99,"0 parametre",null):verifParams("modifExamPat",$_GET));
  $mess ="";
   if($mesParams[0]==1){
     require "../../../tools/connect.php";

        //construction requete
        $requete = "update rel_patient_biologie set numexam=:nume, numpat=:nump, datexam=:datee ".(isset($mesParams[1]['resexam'])?", res=:resu":"")." where numexam = :nume and numpat=:nump and datexam=:datee;";

     		$req = $bdd->prepare($requete);
     		$arrexec = array(":nume"=>$mesParams[1]['numexam'],":nump"=>$mesParams[1]['numpat'],":datee"=>$mesParams[1]['datexam']);
     		if(isset($mesParams[1]['resexam']))$arrexec['resu']=$mesParams[1]['resexam'];


     		try {
     		    $resultat=$req->execute($arrexec);
            $compt = $req->rowCount();
     			 	//if($compt>0){//requete aboutie
     				     $bool=false;
                 //header('Location: ' . $_SERVER['HTTP_REFERER']);
                 header('Location: ../../consulter/examen/formConsultExamen.php?numexam='.$mesParams[1]['numexam'].'&numpat='.$mesParams[1]['numpat'].'&datexam='.$mesParams[1]['datexam'].'&choixreq=1');
                 exit;
     				//}
            /*
            else{
                //$mess.="<p>".count($req->fetchAll())."</p>";
                $mess = "<p>".$compt."</p>";
                $mess.="<p>".$requete."</p>";
            }
            */
     		} catch (PDOException $e) {
     		   //une erreur s'est produite, $bool le signifiera
           echo "<p>".$e.getError()."</p>";
     		}
     		$req->closeCursor() ;
   }
   if($bool){
     require "../../../tools/functionsPrint.php";
     getStart(3);
     //if($mesParams[0]==1)echo'<p><b>'.$mesParams[1].'</b></p>';
     echo'<p>'.$mess.'</p>';
     echo'<p><b>'.implode(" ",$mesParams[1]).'</b></p>';
     echo'<p class="display-4">La modification a échoué, <a href="../../consulter/examen/formConsultExamen.php">retour</a></p>';
     getEnd(3);
   }

}else{
  require "../../../tools/functionsPrint.php";
  getStart(3);
  echo'<h2>403</h2>';
  echo'<p class="display-4">Vous devez etre connecté pour modifier un élément</p>';
  getEnd(3);
}

 ?>
