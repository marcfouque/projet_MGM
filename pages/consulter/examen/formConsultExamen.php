<?php
	session_start();
	require "../../../tools/functionsPrint.php";
	require "../../../tools/functionsParams.php";

	getStart(3);
	echo'<h1>Consultation examens</h1>';
	$mesParams = (count($_GET)==0?array(99,"0 parametre"):verifParams("consultExam",$_GET));

	if($mesParams[0]==1){//si les parametres sont valides
		require "../../../tools/connect.php";
		$mesParams = $mesParams[1];

		$parCorresp = array(
			"numexam"=>array('ths_examen.numExam = ',"Examen numéro : "),
			"libexam"=>array('ths_examen.libellexam LIKE ',"libellé examen : "),
			"maxexam"=>array('ths_examen.valmax = ',"valeur maximale de l'examen : "),
			"minexam"=>array('ths_examen.valmin = ',"valeur minimale de l'examen : "),
			"datexam"=>array('rel_patient_biologie.dateExamen = ',"date à  laquelle l'examen a été effectué : "),
			"numpat"=>array('rel_patient_biologie.numPat = ',"Numéro du patient : "),
			"resexam"=>array('rel_patient_biologie.res = ',"Résultat de l'examen : ")
		);

		//présentation des parametres de la recherche
		echo'<p>Parametre de la recherche : ';
		foreach (array_keys($parCorresp) as $par){
			if(isset($mesParams[$par])){
				echo '<span class="text-muted">'.$parCorresp[$par][1].'<b class="text-muted">'.$mesParams[$par].'</b>, <span>';
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
				//$requete .= $parCorresp[$par] .$mesParams[$par]." and ";
				$requete .= $parCorresp[$par][0] .':'.$par." and ";
				$arrexec[':'.$par]=$mesParams[$par];

			}
		}

		//correction syntaxe requete
		if(substr($requete,-4)=='and ')$requete = substr($requete, 0, -4);
		else if(substr($requete,-4)=='ere ')$requete = substr($requete, 0, -6);
		//print '<p>'. $requete .'</p>';


		$req = $bdd->prepare($requete);
		$req->execute($arrexec);
		$resultat = $req->fetch();

		if($resultat){//verif si resultat

			//récupération noms colonnes
			$colonnes = array();
			for ($i = 0; $i < $req->columnCount(); $i++)$colonnes[$i] = ($req->getColumnMeta($i))['name'];
			$colonnes[$req->columnCount()]="Actions";
			print'
				<div class="table-responsive">
			  	<table class="table table-hover">
			';
			print'
				<thead>
			    <tr>';
			foreach($colonnes as $c)echo'<th scope="col">'.$c.'</th>';
			print'
				</tr>
		  </thead>
			';

			do {//iteration sur toutes les lignes
				echo'<tr>';
				for($i=0;$i<count($colonnes)-1;$i++)echo'<td>'.$resultat[$i].'</td>';

				print'
				<td>
					<div class="btn-group" role="group" aria-label="Button group with nested dropdown">
					  <button type="button" class="btn btn-secondary">Modifier</button>
					  <button type="button" class="btn btn-secondary">Supprimer</button>
					</div>
				</td>
				';

				echo'</tr>';
			} while ($resultat = $req->fetch());

			print'
			 </table>
		 </div>
			';
		}
		else{
			echo "<b>Erreur dans l'exécution de la requête ou zero resultat</b><br/>";
			echo "<b>Message de mySQL: </b>".implode("\n",$req->errorInfo());
			echo "<a href='formConsultExamen.php'><p> Retour au formulaire</p></a>";
		}
		$req->closeCursor() ;

		//print implode(" _ ",$mesParams);
	}
	else{
		print'
			<h2>Formulaire de recherche d\'examen</h2>
			<form class="container" action="formConsultExamen.php" method="get">
			  <div class="form-group">
					<label for="numexam" >Numéro de l\'examen</label>
					<input type="number" class="form-control" name="numexam" id="numexam" placeholder="saisissez le numéro de l\'examen" value="'.(isset($_GET["numexam"])?$_GET["numexam"]:"").'" >
			  </div>
			  <div class="form-group">
					<label for="libexam" >Nom de l\'examen</label>
					<input type="text" class="form-control" name="libexam" id="libexam" placeholder="saisissez le libellé de l\'examen" value="'.(isset($_GET["libexam"])?$_GET["libexam"]:"").'" >
			  </div>
				<div class="form-group form-inline">
					<label for="minexam" >La valeur minimale de l\'examen</label>
					<input type="number" style="margin-left:10px;" class="form-control" name="minexam" id="minexam" placeholder="saisissez la valeur minimale de l\'examen cherché" value="'.(isset($_GET["minexam"])?$_GET["minexam"]:"").'" >
					<label for="maxexam" style="margin-left:50px;">La valeur maximale de l\'examen</label>
					<input type="number" style="margin-left:10px;" class="form-control" name="maxexam" id="maxexam" placeholder="saisissez la valeur maximale de l\'examen cherché" value="'.(isset($_GET["maxexam"])?$_GET["maxexam"]:"").'" >
				</div>
				<hr/>
				<div class="form-group">
					<label for="numpat" >Numéro du patient</label>
					<input type="number" class="form-control" name="numpat" id="numpat" placeholder="numéro du patient" value="'.(isset($_GET["numpat"])?$_GET["numpat"]:"").'" >
			  </div>
				<div class="form-group">
					<label for="datexam" >Date de l\'examen</label>
					<input type="date" class="form-control" name="datexam" id="datexam" placeholder="saisissez la date à laquelle l\'examen a été éfféctué" value="'.(isset($_GET["datexam"])?$_GET["datexam"]:"").'" >
			  </div>
				<div class="form-group">
					<label for="resexam" >Résultat du patient à l\'examen</label>
					<input type="number" class="form-control" name="resexam" id="resexam" placeholder="saisissez la valeur des résultats du patient" value="'.(isset($_GET["resexam"])?$_GET["resexam"]:"").'" >
			  </div>
			<div class="form-group form-radio">
	      Sélectionnez le type de resultat voulue :
	      <div class="form-check">
	        <input class="form-check-input" type="radio" value="0" name="choixreq" id="choixreqEx">
	        <label class="form-check-label" for="choixreqEx">
	          Type d\'examen
	        </label>
	      </div>
	      <div class="form-check">
	        <input class="form-check-input" type="radio" value="1" checked name="choixreq" id="choixreqPat">
	        <label class="form-check-label" for="choixreqPat">
	          Examen de patients
	        </label>
	      </div>
		  </div>
			  <button type="submit" class="btn btn-primary">Envoyer</button>
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
	}


	getEnd(3);
		?>
