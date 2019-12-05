<?php 
session_start();
require "../../../tools/functionsPrint.php";
getStart(3);
print '<span class="border">
		<form class = "container" action = "scriptAjoutExamenThesaurus.php"
		method = "GET">
		<legend><h4>Ajouter un Examen</h4></legend>
		<div class="form-group">
			<label for="libexam"> Libellé de l\'examen :</label>
			<input type="text" class="form-control" id="libexam" name="libexam">
		</div>
		<div class="form-group">
			<label for="valmin"> Valeur minimum :</label>
			<input type="number" class="form-control" id="valmin" name="valmin">
		</div>
		<div class="form-group">
			<label for="valmax"> Valeur maximum :</label>
			<input type="text" class="form-control" id="valmax" name="valmax">
		</div>
		<button type="submit" class="btn btn-primary">Ajouter</button>
		</form>
		</span>';
		// utilisation de la méthode GET : affichage du paramètre dans l'URI (permet d'observer le fonctionnement ou non du script)
		// envoi du formulaire et du paramètre au script
getEnd(3);
?>