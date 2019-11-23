<?php
			session_start();
			/*
			script d'authentification
			retour
				- 0 si parametre absent
				- 1 si authentification réussi + initialisation de la varaible session coco
				- 2 si parametre invalide
			*/
			if(isset($_POST) and isset($_POST["n"]) and isset($_POST["p"])){
				$n=$_POST['n'];
				$p=$_POST['p'];

				require "connect.php";
				$req = $bdd->prepare("select * from utilisateur where nomutilisateur=:n and motdepasseU=AES_ENCRYPT(:p,'Evian&Chi1');");
				//$req = $bdd->prepare("select * from utilisateur where nomutilisateur='marc' and motdepasseU=AES_ENCRYPT('jemaime','Evian&Chi1');");
				$req->execute(array(":n"=>$n,":p"=>$p));
				//$req->execute();
				$resultat = $req->fetch();

				if($resultat){
						$_SESSION['coco']=$resultat[0];
						echo'1';
				}
				else{
					echo'2';
				}
			}

			else{
				echo 0;
			}

?>
