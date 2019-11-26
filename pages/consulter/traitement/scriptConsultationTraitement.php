<?php session_start();

		//Script consultation traitement

		require "../../../tools/functionsPrint.php";
		getStart(3);
		require "../../../tools/functionsParams.php";


		$mesParams = verifParams("formConsultationTraitement",$_GET);
		if($mesParams[0]==0){//parametre manquant
			print '
				<p class="display-4"> Parametre manquant <a href="#'.$mesParams[2].'"> Voir le paramètre manquant</a></p>';
		}
		else if($mesParams[0]==2){//parametre invalide
			print ' <p> Le paramètre est invalide </p>';
		}
		else if($mesParams[0]==1){//parametres bons
		require "../../../tools/connect.php";

			$requete = "SELECT patient.NOM, patient.PRENOM FROM patient INNER JOIN (rel_patient_traitement INNER JOIN ths_traitement on rel_patient_traitement.NUMTTT = ths_traitement.NUMTTT) ON patient.NUMPAT = rel_patient_traitement.NUMPAT WHERE LIBELLETTT like :nom_traitement";
			$req = $bdd->prepare($requete);
			$req->execute(array(':nom_traitement' => $_GET['libtrait']));
			$resultat = $req->fetch();
		if($resultat){
			do {
				echo "<p>".implode(" _ ",$resultat)."</p>";
			} while ($resultat = $req->fetch());
		}
		else {
			echo "<b>Erreur dans l'exécution de la requête ou zero resultat</b><br/>";
			echo "<b>Message de mySQL: </b>".implode(" $ ",$req->errorInfo());
		}
		$req->closeCursor() ;
			print implode(" _ ",$mesParams[1]);
		}


		?>
