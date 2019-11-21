<?php
	define('NOM',"root"); // login MySQL
	define('PASSE',""); // mot de passe MySQL
	define('SERVEUR',"localhost"); 	// addresse MySql
	define('BASE',"16_L2_marfouque");// nom base de données
	//tentative connexion à la base
	try{
		$bdd = new PDO('mysql:host='.SERVEUR.';dbname='.BASE, NOM, PASSE, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
	}catch (Exception $e){
        die('Erreur : ' . $e->getMessage());
	};
?>
