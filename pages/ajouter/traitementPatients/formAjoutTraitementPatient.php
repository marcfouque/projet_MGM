<?php session_start(); 
require "../../../tools/functionsPrint.php";
getStart(3);
require "../../../tools/functionsParams.php";
require "../../../tools/connect.php";
		//choix du patient
		print 
		'
		<form action="scriptAjoutTraitementPatient.php" method="GET"
			  <div class="form-group">
		<label for="choixid">Choix du patient</label>
		<select multiple class="form-control" id="choixid">';

		$requete= "SELECT numpat FROM patient";
		$resultat=$bdd->query($requete);

		while ($ligne = $resultat->fetch()){  
			echo "<option value=".$ligne['numpat']."> ".$ligne['numpat']." </option>";
		}
		$resultat->closeCursor();
		
		echo'</select></br>
  		</div>
		
		<div class="form-group">
		<label for="choixttt">Choix du traitement</label>
		<select multiple class="form-control" id="choixttt">';

		$requete= "SELECT libellettt FROM ths_traitement";
		$resultat=$bdd->query($requete);

		while ($ligne = $resultat->fetch()){  
			echo "<option value=".$ligne['libellettt']."> ".$ligne['libellettt']." </option>";
		}
		$resultat->closeCursor();
		
		echo'</select></br>
		<input class="btn btn-primary" type="submit" value="Valider">
  		</div>
  		</form>';
getEnd(3);	
		?>