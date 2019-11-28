<?php session_start(); 
		
require "../../../tools/functionsPrint.php";
require "../../../tools/functionsParams.php";

require "../../../tools/connect.php";
		
		
		$mesParams = verifParams("ajoutTraitThs",$_GET);
		if($mesParams[0]==0){//parametre manquant
			echo $mesParams[1];
		}
		else if($mesParams[0]==2){//parametre invalide
			echo $mesParams[1];
		}
		else if($mesParams[0]==1){//parametres bons
			//print implode(" _ ",$mesParams);

		$requete = "INSERT INTO ths_traitement (LIBELLETTT) VALUES (:tttadd)";
		$req = $bdd->prepare($requete);
		$req->execute(array(':tttadd' => $_GET['treatadd']));
		//$resultat = $req->fetch();
		/*if($resultat){//verif si resultat
			do {//iteration sur toutes les lignes
				echo "<p>".implode(" _ ",$resultat)."</p>";*/
				echo"<h1>C'est ok</h1>";
			/*} while ($resultat = $req->fetch());
		}
		else{
			echo "<b>Erreur dans l'exécution de la requête ou zero resultat</b><br/>";
			echo "<b>Message de mySQL: </b>".$req->errorInfo();
		}*/
		$req->closeCursor() ;}
		
	
		?>