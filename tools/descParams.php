<?php
#############################
//description des restrictions des parametres
#############################

	/*
	descriptif des valeurs possibles suivant les clefs
	nom clef	-	type valeur	-	valeur possibles	-	description
	"type"	-	string	-	["entier","double","string","date","booleen"]	-	type de la variable passé en parametre, obligatoire (pour la valeur date, ne sera verifier que la conformité du string en date)
	"valeurs"	-	array de type de "type"	-	[array()]	-	toutes les valeurs que peut prendre le parametre
	"bornes"	-	 couple de numeric ou date	-	array(numeric,numeric)/array(date,date)	-	bornes [inferieur,superieur] ouvertes ne s'applique qu'a des numerics (eniter,double,float) ou à des dates (mettre string de de date), si pas de limite sur une des bornes alors null
	
	Seul "type" est obligatoire
	"valeurs" disjoint de "bornes" #ontologie
	pour date, format DD-MM-YYYY
	*/
	$parametres = [
		"nomParam1"=>[
			"type"=>"string",
			"valeurs"=>array("Oui","Non","Peut-etre"),
		],
		"nomParam2"=>[
			"type"=>"entier",
			"bornes"=>array(0,null),
		],
		"nomParam3"=>[
			"type"=>"booleen",
		],
		"nomParam4"=>[
			"type"=>"date",
			"bornes"=>array('01-01-1900','31-12-1999'),
		]
	]
?>