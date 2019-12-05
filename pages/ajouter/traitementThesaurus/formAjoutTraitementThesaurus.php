<?php 
session_start();
require "../../../tools/functionsPrint.php";
getStart(3);
print '<span class="border">
		<form class = "container" action = "scriptAjoutTraitementThesaurus.php"
		method = "GET">
		<legend><h4>Ajouter un traitement</h4></legend>
		<div class="form-group">
		<input type="text" class="form-control" id="treatadd" name="treatadd">
		</div>
		<button type="submit" class="btn btn-primary">Ajouter</button>
		</form>
		</span>';
		// utilisation de la méthode GET : affichage du paramètre dans l'URI (permet d'observer le fonctionnement ou non du script)
		// envoi du formulaire et du paramètre au script
getEnd(3);
?>