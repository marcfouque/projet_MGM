<?php session_start(); 
require "../../../tools/functionsPrint.php";
getStart(3);
require "../../../tools/functionsParams.php";
require "../../../tools/connect.php";
		//choix du patient
		print 
		'
		<form action="scriptAjoutTraitementPatient.php" method="GET">
		<div>
		<label for="choixid">Choix du patient</label>
		<select required class="form-control" name="choixid" id="choixid" >';

		$requete= "SELECT numpat, prenom, nom FROM patient";
		$resultat=$bdd->query($requete);

		while ($ligne = $resultat->fetch()){  
			echo "<option value=".$ligne['numpat']."> ".$ligne['numpat']." - ".$ligne['prenom']." ".$ligne['nom']."</option>";
		}
		$resultat->closeCursor();
		
		//choix du traitement
		echo'</select></div></br>
		<div>
		<label for="choixttt">Choix du traitement</label>
		<select required class="form-control" name="choixttt" id="choixttt" >';

		$requete= "SELECT numttt, libellettt FROM ths_traitement";
		$resultat=$bdd->query($requete);

		while ($ligne = $resultat->fetch()){  
			echo "<option value=".$ligne['numttt']."> ".$ligne['libellettt']." </option>";
		}
		$resultat->closeCursor();
		
		echo'</select></div></br>';
		//date debut et date de fin de traitement date debut oblig, date fin facult

		echo'<div><label for="datedeb">Date de début de traitement</label>
		<input type="date" name="datedeb"></div></br>
		<div><label for="datefin">Date de fin de traitement</label>
		<input type="date" name="datefin"></div></br>
		<input class="btn btn-primary" type="submit" value="Valider">
  		</form>';
		
getEnd(3);	
		?>