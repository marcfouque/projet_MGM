<?php
#############################
//Enumération des parametres obligatoires et falcutatifs par pages
#############################

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
		"consultExam"=>[
					"obligatoire"=>array("choixreq"),
					"facultatif"=>array("numexam","libexam","maxexam","minexam","datexam","numpat","resexam")
				],
		"ajoutExamPat"=>[
					"obligatoire"=>array("numexam","datexam","numpat"),
					"facultatif"=>array("resexam")
				],
		"modifExamPat"=>[
					"obligatoire"=>array("numexam","datexam","numpat"),
					"facultatif"=>array("resexam")
				],
		"modifExamThs"=>[
					"obligatoire"=>array("numexam","libexam","maxexam","minexam"),
					"facultatif"=>array()
				],
		"suppExamPat"=>[
					"obligatoire"=>array("numexam","datexam","numpat"),
					"facultatif"=>array()
				],
		"suppExamThs"=>[
					"obligatoire"=>array("numexam"),
					"facultatif"=>array()
				],
		"consultTrait"=>[
					"obligatoire"=>array("libtrait"),
					"facultatif"=>array()
				],
	];
?>
