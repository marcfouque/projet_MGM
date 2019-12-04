<?php
	session_start();
	require "../../../tools/functionsPrint.php";
	require "../../../tools/functionsParams.php";
	require "../../../tools/connect.php";
	getStart(3);

	//fonction pour afficher un message personnalisé apres envoie du formulaire (inserer ou erreur)
	function messageInsert($s,$b=0){
		print '
			<aside class="alert '.($b==0?'alert-danger':'alert-success').' alertParam" role="alert">
				<p>'.$s.'
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</p>
			</aside>
		';
	}
	echo'<h1>Ajout examen</h1>';
	//si requete vierge
	$mesParams = (count($_GET)==0?array(99,"0 parametre"):verifParams("ajoutExamPat",$_GET));
	if($mesParams[0]==1 and isset($_SESSION['coco']) ){//si les parametres sont valides

		//requete d'insertion avec verification que res soit entre min et max
		$requete3 = "insert into rel_patient_biologie (numexam,numpat,datexam".(isset($mesParams[1]['resexam'])?",res":"").") select :nume, :nump, :datee".(isset($mesParams[1]['resexam'])?", :resu":"");
		$requete3.= " where exists (select 1 from ths_examen where numexam=:nume and valmin<=:resu and valmax>=:resu)";

		$req3 = $bdd->prepare($requete3);
		$arrexec = array(":nume"=>$mesParams[1]['numexam'],":nump"=>$mesParams[1]['numpat'],":datee"=>$mesParams[1]['datexam']);
		if(isset($mesParams[1]['resexam']))$arrexec['resu']=$mesParams[1]['resexam'];


		try {
		    $resultat=$req3->execute($arrexec);
			 	if($req3->rowCount()==0){
					messageInsert("Une erreur s'est produite, veuillez verifier que le resultat du patient se trouve entre les bornes de l'examen selectionné");
				}
				else messageInsert("Examen :".$mesParams[1]['numexam'].", Patient :".$mesParams[1]['numpat'].", Date :".$mesParams[1]['datexam'].(isset($mesParams[1]['resexam'])?", Resultat:".$mesParams[1]['resexam']:"")."<br/>Examen ajouté au patient",1);
		} catch (PDOException $e) {
			$temp=$req3->errorInfo();
		    if ($e->getCode() == 1062 or temp[1]==1062) {
		         messageInsert("Le patient ".$mesParams[1]['numpat']." a déjà effectué l' examen ".$mesParams[1]['numexam']." à la date ".$mesParams[1]['datexam']."<br/> <a href='../../consulter/examen/formConsultExamen.php?numexam=".$mesParams[1]['numexam']."&numpat=".$mesParams[1]['numpat']."&datexam=".$mesParams[1]['datexam']."&choixreq=1'>Modifier l'examen</a>");
		    }
				else if ($e->getCode() == 1452 or temp[1]==1452) {
 		        messageInsert("une des valeurs transmises ne correspond pas à un patient ou un examen présent dans la base.<br/><a href='#'>Ajouter patient</a><br/><a href='#'>Ajouter Examen</a>");
 		    }
				else messageInsert("Une erreur s'est produite<br><b>".implode(' __ ',$req3->errorInfo())."</b>");
		}

		$req3->closeCursor() ;
		//print $requete3;
		//print ($req3->errorInfo())[1];
		//print ($req3->errorInfo())[1]==1062;
	}
		print'
			<h2>Formulaire d\'ajout d\'examen à un patient</h2>
			<form class="container" action="formAjoutExam.php" method="get">
			  <div class="form-group">
					<label for="numexam" >Numéro de l\'examen</label>
					<select required class="form-control" name="numexam" id="numexam"  value="'.(isset($_GET["numexam"])?$_GET["numexam"]:"").'" >';
					//recuperation de tous les types d'examen
		$req = $bdd->prepare("Select * from ths_examen");
		$req->execute();
		$resultat = $req->fetch();
		if($resultat){//verif si resultat
			do {//iteration sur toutes les lignes
				print'<option value="'.$resultat[0].'">'.$resultat[0].' - '.$resultat[1].'</option>';
			} while ($resultat = $req->fetch());
		}
		else{
			echo "<b>Erreur dans l'exécution de la requête ou zero resultat</b><br/>";
			echo "<b>Message de mySQL: </b>".implode("\n",$req->errorInfo());
		}
		$req->closeCursor() ;
		print'
					</select>
			  </div>
				<div class="form-group">
					<label for="numpat" >Numéro du patient</label>
					<select required class="form-control" name="numpat" id="numpat" value="'.(isset($_GET["numpat"])?$_GET["numpat"]:"").'" >
				';
				//recuperationde tous les patients
		$req2 = $bdd->prepare("Select numpat,prenom,nom from patient;select * from ths_examen;");
		$req2->execute();
		$resultat2 = $req2->fetch();
		if($resultat2){//verif si resultat
			do {//iteration sur toutes les lignes
				print'<option value="'.$resultat2[0].'">'.$resultat2[0].' - '.$resultat2[1].' '.$resultat2[2].'</option>';
				echo'1';
			} while ($resultat2 = $req2->fetch());
		}
		else{
			echo "<b>Erreur dans l'exécution de la requête ou zero resultat</b><br/>";
			echo "<b>Message de mySQL: </b>".implode("\n",$req->errorInfo());
		}
		$req2->closeCursor() ;
		print'
					</select>
				</div>
			  <div class="form-group">
					<label for="datexam" >Date de l\'examen</label>
					<input required type="date" class="form-control" name="datexam" id="datexam" placeholder="saisissez la date de l\'examen" value="'.(isset($_GET["datexam"])?$_GET["datexam"]:"").'" >
			  </div>
				<div class="form-group">
					<label for="resexam" >Résultat de l\'examen</label>
					<input type="number" step="0.01" min=0 class="form-control" name="resexam" id="resexam" placeholder="saisissez le resutlat de l\'examen" value="'.(isset($_GET["resexam"])?$_GET["resexam"]:"").'" >
			  </div>
			  <button type="submit" class="btn btn-primary">Ajouter l\'examen</button>
			</form>

		';
		if($mesParams[0]==0){//parametre manquant
			print '
				<aside class="alert alert-warning alertParam container-fluid " role="alert">
					<p class="display-4"> Parametre manquant. <a href="#'.$mesParams[2].'"> Voir le paramètre manquant</a>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true" class="display-4">&times;</span>
						</button>
					</p>
				</aside>
			';
		}
		else if($mesParams[0]==2){//parametre invalide
			print '
				<aside class="alert alert-warning alertParam" role="alert">
					<p class="display-4">Parametre invalide, la valeur "'.$mesParams[2][1].'" ne convient pas. <a href="#'.$mesParams[2][0].'"> Voir le paramètre invalide</a>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true" class="display-4">&times;</span>
						</button>
					</p>
				</aside>
			';
		}
		else if(!isset($_SESSION['coco'])){//parametre invalide
			print '
				<aside class="alert alert-warning alertParam" role="alert">
					<p class="display-4">Vous devez être connecté-e pour ajouter un examen
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true" class="display-4">&times;</span>
						</button>
					</p>
				</aside>
			';
		}

		getEnd(3);
		?>
