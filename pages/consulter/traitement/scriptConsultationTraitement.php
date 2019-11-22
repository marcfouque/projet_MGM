<?php session_start(); 

		//Script consultation traitement


		require "tools/connect.php";
		
		require "tools/functionsParams.php";
		
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
		
		$requete = 'select SELECT patient.NOM FROM patient INNER JOIN (rel_patient_traitement INNER JOIN ths_traitement on rel_patient_traitement.NUMTTT = ths_traitement.NUMTTT) ON patient.NUMPAT = rel_patient_traitement.NUMPAT WHERE LIBELLETTT like "'.trea"  from patient;'
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
		
		echo "<h1>Script consultation traitement</h1>"
		
	
		?>