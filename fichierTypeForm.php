<?php
	session_start();
	require "tools/functionsPrint.php";
	//require "tools/connect.php";
	require "tools/functionsParams.php";
	
	getStart(0);
	echo'<h1>Fichier Type Formulaire</h1>';
	$mesParams = (count($_GET)==0?array(99,"0 parametre"):verifParams("exempleForm",$_GET));
	
	if($mesParams[0]==1){
		$mesParams = $mesParams[1];
		print '<p class="display-1"> yes we did it !!</p>';
		print implode(" _ ",$mesParams);
	}
	else{
		print'
			<form class="container" action="fichierTypeForm.php" method="get">
			  <div class="form-group">
				<label for="numpat" >Numéro du patient</label>
				<input required type="number" class="form-control" name="numpat" id="numpat" placeholder="numéro du patient" value="'.(isset($_GET["numpat"])?$_GET["numpat"]:"").'" >
			  </div>
			  <div class="form-group">
				<label for="dateNaiss" >Date de naissance</label>
				<input type="date" class="form-control" name="dateNaiss" id="dateNaiss" placeholder="saisissez la date de naissance du patient" value="'.(isset($_GET["dateNaiss"])?$_GET["dateNaiss"]:"").'" >
			  </div>
			  <div class="form-group">
				<label for="evian">la maladie d\'amour</label>
				<select class="form-control" name="evian" id="evian" >
				  <option>AHAI isolée</option>
				  <option>Evans</option>
				</select>
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

	getEnd();
?>
