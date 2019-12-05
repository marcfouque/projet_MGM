<?php
	session_start();
	require "../../../tools/functionsPrint.php";
	require "../../../tools/functionsParams.php";

	getStart(3);
	echo'<h1>Consultation examens</h1>';
		//si requete vierge + verification des parametres
	$mesParams = (count($_GET)==0?array(99,"0 parametre"):verifParams("consultExam",$_GET));

	if($mesParams[0]==1){//si les parametres sont valides
		require "../../../tools/connect.php";
		$mesParams = $mesParams[1];

		//création d'un tableau clef/valeur permettant la construction de la requete et l'apposition de de libellé
		$parCorresp = array(
			"numexam"=>array('ths_examen.numExam = ',"Examen numéro : "),
			"libexam"=>array('ths_examen.libellexam LIKE ',"libellé examen : "),
			"maxexam"=>array('ths_examen.valmax = ',"valeur maximale de l'examen : "),
			"minexam"=>array('ths_examen.valmin = ',"valeur minimale de l'examen : "),
			"datexam"=>array('rel_patient_biologie.DatExam = ',"date à  laquelle l'examen a été effectué : "),
			"numpat"=>array('rel_patient_biologie.numPat = ',"Numéro du patient : "),
			"resexam"=>array('rel_patient_biologie.res = ',"Résultat de l'examen : ")
		);

		//présentation des parametres de la recherche
		echo'<p>Parametre de la recherche : ';
		foreach (array_keys($parCorresp) as $par){
			if(isset($mesParams[$par])){
				echo '<span class="text-muted">'.$parCorresp[$par][1].'<b class="text-muted">'.$mesParams[$par].'</b>, </span>';
			}
		}
		echo'</p>';

		//constructioin de la requete
		$requete = 'select ';

		//si jointure mais resultat type examen voulu alors distinct resultat
		if(!$mesParams["choixreq"] and (isset($mesParams["datexam"]) or isset($mesParams["numpat"]) or isset($mesParams["resexam"])))$requete.='distinct ths_examen.numExam, libellexam,valmax,valmin';
		else $requete.="*";

		$requete .= ' from ths_examen ';
		//si type examen voulu et qu'une valeur de recherche resultat bio est saisie ou si examen patient voulu alors jointure
		if($mesParams["choixreq"] or (!$mesParams["choixreq"] and (isset($mesParams["datexam"]) or isset($mesParams["numpat"]) or isset($mesParams["resexam"]))))$requete .= ',rel_patient_biologie where ths_examen.numExam=rel_patient_biologie.numExam and ';
		else $requete.='where ';

		//pour gérer le prepare/execute
		$arrexec = array();

		//boucle d'insertion des parametres de/dans la requete
		foreach (array_keys($parCorresp) as $par){
			if(isset($mesParams[$par])){
				$requete .= $parCorresp[$par][0] .':'.$par." and ";
				$arrexec[':'.$par]=$mesParams[$par];//construction de l'array de substitution utilisé dans execute()

			}
		}

		//correction syntaxe requete
		if(substr($requete,-4)=='and ')$requete = substr($requete, 0, -4);
		else if(substr($requete,-4)=='ere ')$requete = substr($requete, 0, -6);

		$req = $bdd->prepare($requete);
		$req->execute($arrexec);
		$resultat = $req->fetch();

		if($resultat){//verif si resultat

			//récupération noms colonnes
			$colonnes = array();
			for ($i = 0; $i < $req->columnCount(); $i++){
				$col = $req->getColumnMeta($i);
				$colonnes[$i] = $col['name'];
			}
			//ajout de la colonne "action"
			$colonnes[$req->columnCount()]="Actions";
			print'
				<div class="table-responsive">
			  	<table class="table table-hover">
			';
			//header du tableau (libellés colonnes)
			print'
				<thead>
			    <tr>';
			foreach($colonnes as $c)echo'<th scope="col">'.$c.'</th>';
			print'
				</tr>
		  </thead>
			';

			//pour stocker les modals
			$modalsModif = "";
			$modalsSupp = "";

			do {//iteration sur toutes les lignes

				$idunique = "";

				echo'<tr>';
				//boucle d'insertion des valeurs dans les cellules du tableau
				for($i=0;$i<count($colonnes)-1;$i++){
					echo'<td>'.$resultat[$i].'</td>';
					$idunique.=$resultat[$i];
				}
				$idunique = 'id'.str_replace(",","",str_replace("-","",$idunique));
				//ajout des boutons de modification/suppression ligne
				print'
				<td>
					<div class="btn-group" role="group" aria-label="Button group with nested dropdown">
					  <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#'.$idunique.'modif" >Modifier</button>
					  <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#'.$idunique.'supp" >Supprimer</button>
					</div>
				</td>
				';

				//pour l'apparition de la fenetre de modification (modalmodif)

				$modalsModif.='
				<div class="modal fade" id="'.$idunique.'modif" tabindex="-1" role="dialog" aria-labelledby="'.$idunique.'modifLabel" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="'.$idunique.'modifLabel">Modification</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<form class="container modal-body" action="../../modifier/examen/'.($mesParams["choixreq"]?'modifExamPat':'modifExamThs').'.php" method="get">
									<div class="modal-body">							';
					if($mesParams["choixreq"]){//ajout formulaire insert rel_patient_biologie
						$modalsModif.='
								<div class="form-group">
									<label for="numexam" >Numéro de l\'examen</label>
									<input type="number" class="form-control" name="numexam" placeholder="saisissez le numéro de l\'examen" value="'.$resultat[0].'" />
							  </div>
								<div class="form-group">
									<label for="numpat" >Numéro du patient</label>
									<input type="number" class="form-control" name="numpat" placeholder="numéro du patient" value="'.$resultat[4].'" />
							  </div>
								<div class="form-group">
									<label for="datexam" >Date de l\'examen</label>
									<input type="date" class="form-control" name="datexam" placeholder="saisissez la date à laquelle l\'examen a été éfféctué" value="'.$resultat[5].'" />
							  </div>
								<div class="form-group">
									<label for="resexam" >Résultat du patient à l\'examen</label>
									<input type="number"  step="0.01" class="form-control" name="resexam" placeholder="saisissez la valeur des résultats du patient" value="'.$resultat[7].'" />
							  </div>
						';
					}
					else{//ajout formulaire insert ths_examen
						$modalsModif.='
								<div class="form-group">
									<label for="numexam" >Numéro de l\'examen</label>
									<input type="number" class="form-control" name="numexam" placeholder="saisissez le numéro de l\'examen" value="'.$resultat[0].'" />
							  </div>
							  <div class="form-group">
									<label for="libexam" >Nom de l\'examen</label>
									<input type="text" class="form-control" name="libexam" placeholder="saisissez le libellé de l\'examen" value="'.$resultat[1].'" />
							  </div>
								<div class="form-group form-inline">
									<label for="minexam" >La valeur minimale de l\'examen</label>
									<input type="number" style="margin-left:10px;" class="form-control" name="minexam" placeholder="saisissez la valeur minimale de l\'examen cherché" value="'.$resultat[2].'" />
									<label for="maxexam" style="margin-left:50px;">La valeur maximale de l\'examen</label>
									<input type="number" style="margin-left:10px;" class="form-control" name="maxexam" placeholder="saisissez la valeur maximale de l\'examen cherché" value="'.$resultat[3].'" />
								</div>
						';
					}
					$modalsModif.='
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
								<button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
							</div>
							</form>
						</div>
					</div>
				</div>';

				//pour l'apparition de la fenetre de suppression (modalmodif)

				$modalsSupp.='
					<div class="modal fade" id="'.$idunique.'supp" tabindex="-1" role="dialog" aria-labelledby="'.$idunique.'suppLabel" aria-hidden="true">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="'.$idunique.'suppLabel">Supprimer l\'enregistrement</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<form class="container modal-body" action="../../supprimer/examen/'.($mesParams["choixreq"]?'suppExamPat':'suppExamThs').'.php" method="get">
										<div class="modal-body">							';
						if($mesParams["choixreq"]){//ajout formulaire delete rel_patient_biologie
							$modalsSupp.='
									<input type="hidden" class="form-control" name="numexam" value="'.$resultat[0].'" />
									<input type="hidden" class="form-control" name="numpat" value="'.$resultat[4].'" />
									<input type="hidden" class="form-control" name="datexam" value="'.$resultat[5].'" />
									<p>
										<span class="text-muted">Numéro examen :<b class="text-muted">'.$resultat[0].'</b>, </span>
										<span class="text-muted">Numéro patient :<b class="text-muted">'.$resultat[4].'</b>, </span>
										<span class="text-muted">Date de l\' examen :<b class="text-muted">'.$resultat[5].'</b>, </span>
										<span class="text-muted">Resultat de l\' examen :<b class="text-muted">'.$resultat[7].'</b>, </span>
									</p>

							';
						}
						else{//ajout formulaire insert ths_examen
							$modalsSupp.='
									<input type="hidden" class="form-control" name="numexam" value="'.$resultat[0].'" />
									<p><span class="text-muted">Numéro examen :<b class="text-muted">'.$resultat[0].'</b>, </span><span class="text-muted">Libellé examen :<b class="text-muted">'.$resultat[1].'</b>, </span><span><span class="text-muted">Borne résulat examen : [<b class="text-muted">'.$resultat[2].'</b>;<b class="text-muted">'.$resultat[3].'</b>] </span></p>
							';
						}
						$modalsSupp.='
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
									<button type="submit" class="btn btn-primary">Supprimer l\'enregistrement</button>
								</div>
								</form>
							</div>
						</div>
					</div>
				';


				echo'</tr>';
			} while ($resultat = $req->fetch());
			//fin du tableau
			print'
			 </table>
		 </div>
			';
			//print des modals de toutes les lignes de résultat
			print '<div>'.$modalsModif.'</div>';
			print '<div>'.$modalsSupp.'</div>';
		}
		else{//si la recherche ne donne pas de résultat (correspond au retour de la suppression d'une ligne pour bien verifier sa suppression)
			echo "<b>La recherche avec les paramètres ⬆ ne donne plus de résultats, ceux-ci ont été supprimés ou n'ont jamais éxisté </b><br/>";
			echo "<a href='formConsultExamen.php'><p> Retour au formulaire</p></a>";
		}
		$req->closeCursor() ;
	}
	else{//si verifParams ne retourne pas 1, affichage du formulaire de recherche
		print'
			<h2>Formulaire de recherche d\'examen</h2>
			<form class="container" action="formConsultExamen.php" method="get">
			  <div class="form-group">
					<label for="numexam" >Numéro de l\'examen</label>
					<input type="number" class="form-control" name="numexam" id="numexam" placeholder="saisissez le numéro de l\'examen" value="'.(isset($_GET["numexam"])?$_GET["numexam"]:"").'" />
			  </div>
			  <div class="form-group">
					<label for="libexam" >Nom de l\'examen</label>
					<input type="text" class="form-control" name="libexam" id="libexam" placeholder="saisissez le libellé de l\'examen" value="'.(isset($_GET["libexam"])?$_GET["libexam"]:"").'" />
			  </div>
				<div class="form-group form-inline">
					<label for="minexam" >La valeur minimale de l\'examen</label>
					<input type="number" style="margin-left:10px;" class="form-control" name="minexam" id="minexam" placeholder="saisissez la valeur minimale de l\'examen cherché" value="'.(isset($_GET["minexam"])?$_GET["minexam"]:"").'" />
					<label for="maxexam" style="margin-left:50px;">La valeur maximale de l\'examen</label>
					<input type="number" style="margin-left:10px;" class="form-control" name="maxexam" id="maxexam" placeholder="saisissez la valeur maximale de l\'examen cherché" value="'.(isset($_GET["maxexam"])?$_GET["maxexam"]:"").'" />
				</div>
				<hr/>
				<div class="form-group">
					<label for="numpat" >Numéro du patient</label>
					<input type="number" class="form-control" name="numpat" id="numpat" placeholder="numéro du patient" value="'.(isset($_GET["numpat"])?$_GET["numpat"]:"").'" />
			  </div>
				<div class="form-group">
					<label for="datexam" >Date de l\'examen</label>
					<input type="date" class="form-control" name="datexam" id="datexam" placeholder="saisissez la date à laquelle l\'examen a été éfféctué" value="'.(isset($_GET["datexam"])?$_GET["datexam"]:"").'" />
			  </div>
				<div class="form-group">
					<label for="resexam" >Résultat du patient à l\'examen</label>
					<input type="number" class="form-control" name="resexam" id="resexam" placeholder="saisissez la valeur des résultats du patient" value="'.(isset($_GET["resexam"])?$_GET["resexam"]:"").'" />
			  </div>
			<div class="form-group form-radio">
	      Sélectionnez le type de resultat désiré :
	      <div class="form-check">
	        <input class="form-check-input" type="radio" value="0" name="choixreq" id="choixreqEx" />
	        <label class="form-check-label" for="choixreqEx">
	          Type d\'examen
	        </label>
	      </div>
	      <div class="form-check">
	        <input class="form-check-input" type="radio" value="1" checked name="choixreq" id="choixreqPat" />
	        <label class="form-check-label" for="choixreqPat">
	          Examen de patients
	        </label>
	      </div>
		  </div>
			  <button type="submit" class="btn btn-primary">Envoyer</button>
			</form>

		';
		//Ajout de notification à l'utilisateur si une erreur est survenue lors de ça recherche
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
	}


	getEnd(3);
		?>
