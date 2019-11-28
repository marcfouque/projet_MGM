<?php
#############################
//description des restrictions des parametres
#############################

	/*
	descriptif des valeurs possibles suivant les clefs
	nom clef	-	type valeur	-	valeur possibles	-	description
	"type"	-	string	-	["entier","double","string","date","booleen"]	-	type de la variable passé en parametre, obligatoire (pour la valeur date, ne sera verifier que la conformité du string en date)
	"valeurs"	-	array de type de "type"	-	[array()]	-	toutes les valeurs que peut prendre le parametre
	"bornes"	-	 couple de numeric ou date	-	array(numeric,numeric)/array(date,date)	-	bornes [inferieur,superieur] ouvertes ne s'appliquent qu'a des numerics (eniter,double,float) ou à des dates (mettre string de de date), si pas de limite sur une des bornes alors null

	Seul "type" est obligatoire
	"valeurs" disjoint de "bornes" #ontologie
	pour date, format YYYY-MM-DD
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
			"bornes"=>array('1900-01-01','1999-12-31'),
		],
		"numpat"=>[
			"type"=>"entier",
			"bornes"=>array(0,null)
		],
		"dateNaiss"=>[
			"type"=>"date",
			"bornes"=>array('1900-01-01',null),
		],
		"evian"=>[
			"type"=>"string",
			"valeurs"=>array('AHAI isolée','Evans'),
		],
		"numexam"=>[
			"type"=>"entier",
			"bornes"=>array(0,null)
		],
		"libexam"=>[
			"type"=>"string"
		],
		"minexam"=>[
			"type"=>"entier",
			"bornes"=>array(0,null)
		],
		"maxexam"=>[
			"type"=>"entier",
			"bornes"=>array(0,null)
		],
		"resexam"=>[
			"type"=>"double",
			"bornes"=>array(0,null)
		],
		"datexam"=>[
			"type"=>"date",
			"bornes"=>array('1900-01-01',null),
		],
		"choixreq"=>[
			"type"=>"booleen"
		],
		"libtrait"=>[
			"type"=>"string"
		],
		"treatadd"=>[
			"type"=>"string"
		],
	]
?>
