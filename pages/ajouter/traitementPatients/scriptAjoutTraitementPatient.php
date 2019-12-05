<?php session_start(); 
//Script consultation centre
require"../../../tools/functionsPrint.php";
require "../../../tools/functionsParams.php";
getStart(3);

$mesParams = verifParams("ajoutTraitPat",$_GET);
//test si les paramètres sont bons
if($mesParams[0]==0){//parametre manquant
	echo $mesParams[1];
}
else if($mesParams[0]==2){//parametre invalide
	echo $mesParams[1];
}
else if($mesParams[0]==1){//parametres bons
	require "../../../tools/connect.php";

	// On ajoute le traitement dans la table relation patient traitement
	if($_GET['datefin']==''){
		$_GET['datefin'] = null;
	}

	//vérifie si les données ne sont pas déjà dans la base;
	$test=$bdd->query('SELECT count(*) as nb from rel_patient_traitement where numpat="'.$_GET['choixid'].'" and numttt="'.$_GET['choixttt'].'" and  datedeb="'.$_GET['datedeb'].'" ');
	$count = $test->fetch();
	//s'ils ne sont pas déjà dans la base
	if($count['nb']==0){
		//on vérifie que la date de debut et de fin sont cohérentes
		if($_GET['datedeb']>$_GET['datefin'] and $_GET['datefin']!=null){
			echo 'La date de fin est antérieure à la date de début ! Veuillez recommencer !
			<form action="formAjoutTraitementPatient.php" method="GET"
			<div class="input-group">
			<input class="btn btn-primary" type="submit" value="Ajouter un autre traitement">
			</div><br/>
			</form>';
		}else{	
			//on ajoute
			$req = $bdd->prepare('INSERT INTO rel_patient_traitement(numpat, numttt, datedeb, datefin) VALUES(:numpat, :numttt, :datedeb, :datefin)');
			$req->execute(array(
					'numpat' => $_GET['choixid'],
					'numttt' => $_GET['choixttt'],
					'datedeb' => $_GET['datedeb'],	
					'datefin' => $_GET['datefin']
					));

			echo 'Vous avez ajouté le traitement '.$_GET['choixttt'].' au patient '.$_GET['choixid'].' !
			<form action="formAjoutTraitementPatient.php" method="GET"
			<div class="input-group">
			<input class="btn btn-primary" type="submit" value="Ajouter un autre traitement">
			</div><br/>
			</form>';
		}
	}else{
			echo 'Ces données sont déjà dans la base !
			<form action="formAjoutTraitementPatient.php" method="GET"
			<div class="input-group">
			<input class="btn btn-primary" type="submit" value="Ajouter un autre traitement">
			</div><br/>
			</form>';
	}

//fermeture elsif du test des parametres de base
}
	getEnd(3);
	?>