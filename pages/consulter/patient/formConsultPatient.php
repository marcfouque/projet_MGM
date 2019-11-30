<?php session_start(); 
require "../../../tools/functionsPrint.php";
getStart(3);
require "../../../tools/functionsParams.php";
require "../../../tools/connect.php";
		/*
		$mesParams = verifParams("nomPage1",$_GET);
		if($mesParams[0]==0){//parametre manquant
			echo $mesParams[1];
		}
		else if($mesParams[0]==2){//parametre invalide
			echo $mesParams[1];
		}
		else if($mesParams[0]==1){//parametres bons
			$mesParams = $mesParams[1];
			print implode(" _ ",$mesParams);
		}
		*/
		/*
		$requete = 'select * from patient;'
		$req = $bdd->prepare($requete);
		$req->execute(array(':p_user' => $_POST['utilisateur']));
		$resultat = $req->fetch();
		if($resultat){//verif si resultat
			do {//iteration sur toutes les lignes
				echo"<p>mmon resultatofjfiijeifhdihgdihsihgi $resultat</p>";
			} while ($resultat = $req->fetch(););
		}
		else{
			echo "<b>Erreur dans l'exécution de la requête ou zero resultat</b><br/>";
			echo "<b>Message de mySQL: </b>".$req->errorInfo();
		}
		$req->closeCursor() ;
		*/
		print 
		'
		<form action="scriptConsultationPatient.php" method="GET"
		<div class="input-group">
		<label for="numpat">Consulter un patient par id : </label>
		<input class="form-control" id="numpat" placeholder="ID du patient" name="numpat" aria-describedby="id">
		<input class="btn btn-primary" type="submit" value="Afficher">
  		</div><br/>
  		</form>';
		getEnd(3);
		?>
