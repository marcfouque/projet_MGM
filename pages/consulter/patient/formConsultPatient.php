<?php session_start(); 
require "../../../tools/functionsPrint.php";
getStart(3);
require "../../../tools/functionsParams.php";
require "../../../tools/connect.php";

		print 
		'
		<form action="scriptConsultationPatient.php" method="GET">
		<div class="input-group">';
		//recherche par id;
		echo'<label for="numpat">Consulter un patient par id : </label>
		<input class="form-control" id="numpat" placeholder="ID du patient" name="numpat" aria-describedby="id">
		</div><br/>';
		//recherche par nom et prenom;
		echo'<label for="nompat">Si vous ne connaissez pas l\'identifiant du patient, rechercher par nom et/ou prénom : </label>
		<input class="form-control" id="nompat" placeholder="Nom du patient" name="nompat">
		<input class="form-control" id="prenompat" placeholder="Prénom du patient" name="prenompat">
		<input class="btn btn-primary" type="submit" value="Afficher">
  		</div><br/>
  		</form>';
		getEnd(3);
		?>
