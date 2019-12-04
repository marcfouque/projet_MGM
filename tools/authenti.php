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
				$req = $bdd->prepare("select * from utilisateur where nomutilisateur=:n and motdepasseU=cryptMdp(:p);");
				$req->execute(array(":n"=>$n,":p"=>$p));
				$resultat = $req->fetch();

				if($resultat){//si bon
						$_SESSION['coco']=$resultat[0];
						echo'1';
				}
				else{//si erroné
					echo'2';
				}
			}
			else{//si pas de params
				echo '0';
			}

?>
