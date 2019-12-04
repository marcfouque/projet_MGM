<?php 
session_start(); 
require "../../../tools/functionsPrint.php";
getStart(3);
print '<span class="border">
		<form class = "container" action = "scriptConsultationTraitement.php"
		method = "GET">
		<legend><h4>Consulter un traitement</h4></legend>
		<div class="form-group">
		<input type="text" class="form-control" id="libtrait" name="libtrait">
		</div>
		<button type="submit" class="btn btn-primary">Rechercher</button>
		</form>
		</span>';

getEnd(3);
?>

