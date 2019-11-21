<?php 
	/*
	-mettre un nom de page (unique) qui sera appelé dans le fichier php qui affichera la page
	-mettre dans les array le nom des parametres obligatoire et/ou facultatif
	*/
	$obliFalc = [
		"nomPage1"=>[
					"obligatoire"=>array("nomParam1","nomParam2","nomParam3"),
					"facultatif"=>array("nomParamA","nomParamB","nomParamC","nomParam4")
				],
		"nomPage2"=>[
					"obligatoire"=>array("nomParam1"),
					"facultatif"=>array()
				],
		"nomPage3"=>[
					"obligatoire"=>array(),
					"facultatif"=>array("nomParamA","nomParamB")
				],
		"exempleForm"=>[
					"obligatoire"=>array("numpat"),
					"facultatif"=>array("dateNaiss","evian")
				],
	];
?>