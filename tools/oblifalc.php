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
		"consultCentre"=>[
					"obligatoire"=>array("choixville"),
					"facultatif"=>array()
				],
		"consultPatient"=>[
					"obligatoire"=>array("numpat"),
					"facultatif"=>array()
				],
		"modifCentre"=>[
					"obligatoire"=>array("idCentre"),
					"facultatif"=>array("libCentre")
				],
		"suppCentre"=>[
					"obligatoire"=>array("idCentre"),
					"facultatif"=>array()
				],

		"modifTraitPat"=>[
					"obligatoire"=>array("numpat","numttt","datedeb"),
					"facultatif"=>array("datefin")
				],

		"consultPatient"=>[
					"obligatoire"=>array(),
					"facultatif"=>array("numpat","prenompat","nompat"),
				],	
		"ajoutTraitPat"=>[
					"obligatoire"=>array("choixid","choixttt","datedeb"),
					"facultatif"=>array("datefin")
				],
		"suppPat"=>[
					"obligatoire"=>array(),
					"facultatif"=>array("numpat","prenompat","nompat")
				],
<<<<<<< HEAD
		"modifPat"=>[
					"obligatoire"=>array(),
					"facultatif"=>array("numpat","prenompat","nompat","ddn","consang","nbame","pdsnaiss","taillenaiss","pcnaiss","sexe")
				],	
=======
		"supTraitPat"=>[
					"obligatoire"=>array("numpat","numttt","datedeb"),
					"facultatif"=>array("datefin")
				],
>>>>>>> 9617d5d78fd74983993445e201c7c406e35b4664

	];
?>
