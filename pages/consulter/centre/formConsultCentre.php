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
		<form action="scriptConsultationCentre.php" method="GET"
		Ville : 
		<div class="input-group">
		<select class="custom-select" id="choixville" name="choixville" aria-label="Example select with button addon">
		<option selected>Ville</option>';

		$requete= "SELECT LIBELLECENTRE FROM ths_centre";
		$resultat=$bdd->query($requete);

		while ($ligne = $resultat->fetch()){  
			echo "<option value=".$ligne['LIBELLECENTRE']."> ".$ligne['LIBELLECENTRE']." </option>";
		}
		$resultat->closeCursor();
		
		echo'</select></br>
		<input class="btn btn-primary" type="submit" value="Afficher">
  		</div>
  		</form>';


	





		getEnd(3);
		?>
