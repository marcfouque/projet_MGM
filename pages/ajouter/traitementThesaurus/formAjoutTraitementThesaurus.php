<?php 
session_start();
require "../../../tools/functionsPrint.php";
getStart(3);
		print '
		<span class="border">
		<form class = "container" action = "scriptAjoutTraitementThesaurus.php" method = "GET">' //Le formulaire utilise GET pour conserver la valeur saisie afin qu'elle soit utilisé par le script
		'<legend>Ajouter un traitement</legend>
		<div class="form-group">
		<input type="text" class="form-control" id="treatadd" name="treatadd">
		</div>
		<button type="submit" class="btn btn-primary">Ajouter</button>
		</form>
		</span>';
getEnd(3);
?>