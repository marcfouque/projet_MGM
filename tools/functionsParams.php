<?php



function verifParams($nomPage,$params){
	/*fonction verifiant la conformité des parametres (abscence,type,restriction)
	retour
		-	[0,string erreur,NomParamManquant] si parametre manquant
		-	[1,params] si bon
		-	[2,string erreur,param,[NomParamManquant,ValeurErrone]] si parametre errone
	*/
	require "oblifalc.php";

	//bouvle sur les params obligatoires pour verifier leur presence, retour 0 sinon
	foreach ($obliFalc[$nomPage]["obligatoire"] as $obli) {
		if(!isset($params[$obli]) or strlen($params[$obli])==0)return array(0,"Parametre manquant :".$obli,$obli);
	}
	//constitution d'un vecteurs de parametres obligatoires et facultatifs
	$listParamsPoss = array_merge($obliFalc[$nomPage]["obligatoire"],$obliFalc[$nomPage]["facultatif"]);
	//boucle sur tous les params pour verifier leur validiter, retour 2 sinon
	foreach ($listParamsPoss as $p){
		if(isset($params[$p])){
			if(!paramValid($p,$params[$p]))return array(2,"Parametre invalide :".$p,array($p,$params[$p]));
		}
	}
	//retour des parametres valides recasté
	return array(1,recastParams($params));
}

function paramValid($clef,$valeur){
	/*
	Fonction prenant le nom d'un parametre et sa valeur, et verifiant la validité du parametre

	*/
		require "descParams.php";
		/*
		echo gettype($valeur);
		echo is_string($valeur);
		echo $valeur;
		*/

		//condition checkant la valeur "type" du parametre et appliquant des verifications selon.
		switch ($parametres[$clef]["type"]) {
			case "string":
				if(!is_string($valeur)){return false;}
				break;
			case "entier":
				if((integer)$valeur==0 and $valeur!='0')return false;
				break;
			case "double":
				if((double)$valeur==0)return false;
				break;
			case "date":
				if(!is_string($valeur) or !date_parse($valeur))return false;
				break;
			case "booleen":
				if(!in_array($valeur, array('0','1','false','true','False','True')))return false;
				break;
		}
	//condition checkant la valeur "valeurs" du parametre et appliquant des verifications selon.
		if(isset($parametres[$clef]["valeurs"])){
			if(!in_array($valeur,$parametres[$clef]["valeurs"]))return false;
		}
		//condition checkant la valeur "type" du parametre et appliquant des verifications selon.
		else if (isset($parametres[$clef]["bornes"])){
			if($parametres[$clef]["type"]=="date"){
				$valeurDate = strtotime($valeur);
				if(count(explode("-",$valeur))!=3)return false;
				if(!is_null($parametres[$clef]["bornes"][0])){
					if($valeurDate < strtotime($parametres[$clef]["bornes"][0]))return false;
				}
				if(!is_null($parametres[$clef]["bornes"][1])){
					if($valeurDate > strtotime($parametres[$clef]["bornes"][1]))return false;
				}
			}
			else{
				if(!is_null($parametres[$clef]["bornes"][0])){
					if($valeur < $parametres[$clef]["bornes"][0])return false;
				}
				if(!is_null($parametres[$clef]["bornes"][1])){
					if($valeur > $parametres[$clef]["bornes"][0])return false;
				}
			}
		}
		return true;
	}

function recastParams($params){
	/*
	fonction prenant un tableau clef/valeur et ressortant celui-ci mais avec des valeurs recastés selon le type de valeurs renseigné
	*/
	require "descParams.php";

	$resultat = $params;
	foreach(array_keys($resultat) as $clef){
		if($parametres[$clef]["type"]=="entier")$resultat[$clef]=(integer)$resultat[$clef];
		if($parametres[$clef]["type"]=="double")$resultat[$clef]=(double)$resultat[$clef];
		if($parametres[$clef]["type"]=="booleen")$resultat[$clef]=(bool)$resultat[$clef];
	}
    return $resultat;
}
?>
