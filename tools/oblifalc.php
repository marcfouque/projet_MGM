<?php
#############################
//Enumération des parametres obligatoires et falcutatifs par pages
#############################

	/*
	-mettre un nom de page (unique) qui sera appelé dans le fichier php qui affichera la page
	-mettre dans les array le nom des parametres obligatoire et/ou facultatif
	*/
	$obliFalc = [
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
		"ajoutTraitThs"=>[
					"obligatoire"=>array("treatadd"),
					"facultatif"=>array()
				],
	];
?>
