<?php session_start(); 

//Script consultation centre

require"../../../tools/functionsPrint.php";
require "../../../tools/functionsParams.php";
getStart(3);

$mesParams = verifParams("modifPat",$_GET);
if($mesParams[0]==0){//parametre manquant
	echo $mesParams[1];
}
else if($mesParams[0]==2){//parametre invalide
	echo $mesParams[1];
}
else if($mesParams[0]==1){//parametres bons
	require "../../../tools/connect.php";
	if(isset($_SESSION['coco'])){
	$req = $bdd->prepare('UPDATE patient SET prenom = :nvprenom, nom = :nvnom, ddn = :nvddn, sexe = :nvsexe, consangpar = :nvcons, samen = :nvsamen, pdsnais = :nvpds, taillenais = :nvtaille, pcnais = :nvpc where numpat= :idpat');
$req->execute(array(
	'nvprenom' => if(isset($_GET['prenompat'])){$_GET['prenompat']}else{l'ancienne valeur},
	'nvnom' => $_GET['nompat'],
	'nvddn' => $_GET['ddn'],
	'nvsexe' => $_GET['sexe'],
	'nvcons' => $_GET['consang'],
	'nvsamen' => $_GET['nbame'],
	'nvpds' => $_GET['pdsnaiss'],
	'nvtaille' => $_GET['taillenaiss'],
	'nvpc' => $_GET['pcnaiss'],
	'idpat' => $_GET['numpat']
	));
	echo'patient modifié';
	}else{ 
	echo' Vous devez être connecté(e) pour modifier la base!';}
	
	
}
	
	
	
	
	
getEnd(3);	
?>	