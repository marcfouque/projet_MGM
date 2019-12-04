<?php session_start(); 
require "../../../tools/functionsPrint.php";
getStart(3);
require "../../../tools/functionsParams.php";
require "../../../tools/connect.php";
		print 
		'
		<span class="border">

		<form class = "container" action="scriptConsultationCentre.php" method="GET"
		<legend><h4>Consulter un centre</h4></legend>
		<div class="form-group">
		<select class="form-control" id="choixville" name="choixville">
		<option selected>Ville</option>';

		$requete= "SELECT LIBELLECENTRE FROM ths_centre";
		$resultat=$bdd->query($requete);

		while ($ligne = $resultat->fetch()){  
			echo "<option value=".$ligne['LIBELLECENTRE'].">".$ligne['LIBELLECENTRE']." </option>";
		}
		$resultat->closeCursor();
		
		echo'</select>
		</div>
		<button type="submit" class="btn btn-primary">Afficher</button>
  		</form>
  		</span>';

getEnd(3);
?>
