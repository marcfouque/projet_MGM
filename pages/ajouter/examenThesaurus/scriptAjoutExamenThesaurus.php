<?php session_start(); 
//Script consultation centre
require"../../../tools/functionsPrint.php";
require "../../../tools/functionsParams.php";
getStart(3);

$mesParams = verifParams("ajoutExam",$_GET);
//test si les paramètres sont bons
if($mesParams[0]==0){//parametre manquant
	echo $mesParams[1];
}
else if($mesParams[0]==2){//parametre invalide
	echo $mesParams[1];
}
else if($mesParams[0]==1){//parametres bons
	require "../../../tools/connect.php";
if(isset($_SESSION['coco'])){
	// On ajoute le traitement dans la table relation patient traitement

	//vérifie si les données ne sont pas déjà dans la base;
	$test=$bdd->query('SELECT count(*) as nb from ths_examen where libellexam="'.$_GET['libexam'].'" and valmin="'.$_GET['valmin'].'" and  valmax="'.$_GET['valmax'].'" ');
	$count = $test->fetch();
	//s'ils ne sont pas déjà dans la base
	if($count['nb']==0){
		//on vérifie que la date de debut et de fin sont cohérentes
		if($_GET['valmin']>$_GET['valmax']){
			echo 'La valeur maximale est supérieure à la valeur minimale ! Veuillez recommencer !
			<form action="formAjoutExamenThesaurus.php" method="GET"
			<div class="input-group">
			<input class="btn btn-primary" type="submit" value="Ajouter un autre examen">
			</div><br/>
			</form>';
		}else{	
			//on ajoute
				$test2=$bdd->query('SELECT count(*) as nb from ths_examen');
				$count2 = $test2->fetch();
			$req = $bdd->prepare('INSERT INTO ths_examen(numexam, libellexam, valmin, valmax) VALUES(:id, :lib, :vmin, :vmax)');
			$req->execute(array(
					'id' => $count2['nb']+1,
					'lib' => $_GET['libexam'],
					'vmin' => $_GET['valmin'],	
					'vmax' => $_GET['valmax']
					));

			echo 'Vous avez ajouté l\'examen '.$_GET['libexam'].' au thesaurus !
			<form action="formAjoutExamenThesaurus.php" method="GET"
			<div class="input-group">
			<input class="btn btn-primary" type="submit" value="Ajouter un autre examen">
			</div><br/>
			</form>';
		}
	}else{
			echo 'Ces données sont déjà dans la base !
			<form action="formAjoutExamenThesaurus.php" method="GET"
			<div class="input-group">
			<input class="btn btn-primary" type="submit" value="Ajouter un autre examen">
			</div><br/>
			</form>';
	}
}else{
'Vous devez être connecté pour ajouter !
			<form action="formAjoutExamenThesaurus.php" method="GET"
			<div class="input-group">
			<input class="btn btn-primary" type="submit" value="Ajouter un autre examen">
			</div><br/>
			</form>';

}

//fermeture elsif du test des parametres de base
}
	getEnd(3);
	?>