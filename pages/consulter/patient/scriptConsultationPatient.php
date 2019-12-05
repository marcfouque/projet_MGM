<?php session_start(); 

//Script consultation centre

require"../../../tools/functionsPrint.php";
require "../../../tools/functionsParams.php";
getStart(3);

$mesParams = verifParams("consultPatient",$_GET);
//modifier oblifalc, descParam, functionsParam
if($mesParams[0]==0){//parametre manquant
	echo $mesParams[1];
}
else if($mesParams[0]==2){//parametre invalide
	echo $mesParams[1];
}
else if($mesParams[0]==1){//parametres bons
	require "../../../tools/connect.php";
	
	//identifiant renseigné	
	if($_GET['numpat']!=''){
		$requete = 'SELECT * FROM `patient` WHERE patient.numpat LIKE :idpat';
		$req = $bdd->prepare($requete);
		$req->execute(array(':idpat' => $_GET['numpat']));	
	//prenom ET nom 	
	}elseif($_GET['nompat']!='' AND $_GET['prenompat']!=''){
		$requete = 'SELECT * FROM `patient` WHERE patient.NOM LIKE :nomp and patient.PRENOM LIKE :prenomp';
		$req = $bdd->prepare($requete);
		$req->execute(array(':nomp' => $_GET['nompat'],':prenomp' => $_GET['prenompat']));	
	//prenom OU nom
	}else{
		$requete = 'SELECT * FROM `patient` WHERE patient.NOM LIKE :nomp or patient.PRENOM LIKE :prenomp';
		$req = $bdd->prepare($requete);
		$req->execute(array(':nomp' => $_GET['nompat'],':prenomp' => $_GET['prenompat']));	
	}

	$resultat = $req->fetch();

	if($resultat){//verif si resultat

		echo '<h3>Liste des patients</h3>
		<div class="table-responsive">
		<table class="table table-hover">

		<thead>
		<tr>
		<td>NumPat</td>
		<td>Prénom</td>
		<td>Nom</td>
		<td>Date de naissance</td>
		<td>Sexe</td>
		<td>Consanguinité parentale</td>
		<td>Nb semaines daménorrhée</td>
		<td>Poids à la naissance</td>
		<td>Taille à la naissance</td>
		<td>PCNais</td>
		<td>Id du centre</td>
		<td>Maladie contractée</td>
		<td>Actions</td>
		</tr>
		</thead>
		';

		do {//iteration sur toutes les lignes
			//debut ligne tableau
			echo'<tr>';
			echo'<td>'.$resultat[0].'</td>';
			echo'<td>'.$resultat[1].'</td>';
			echo'<td>'.$resultat[2].'</td>';
			echo'<td>'.$resultat[3].'</td>';
			echo'<td>'.$resultat[4].'</td>';
			echo'<td>'.$resultat[5].'</td>';
			echo'<td>'.$resultat[6].'</td>';
			echo'<td>'.$resultat[7].'</td>';
			echo'<td>'.$resultat[8].'</td>';
			echo'<td>'.$resultat[9].'</td>';
			echo'<td>'.$resultat[10].'</td>';
			echo'<td>'.$resultat[11].'</td>
			<td>
			<div class="btn-group" role="group" aria-label="Button group with nested dropdown">
			<button type="button" data-toggle="modal" data-target="#modif" class="btn btn-secondary">Modifier</button>
			<button type="button" data-toggle="modal" data-target="#supp" class="btn btn-secondary">Supprimer</button>';

			//ouverture fenetre modale pour supprimer;
			echo '<div class="modal" id="supp">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
						<h4 class="modal-title">Attention</h4>
						</div>

						<div class="modal-body">
							Etes-vous sûr(e) de vouloir supprimer cette ligne?      </div>
							<form class="container modal-body" action="../../supprimer/patient/suppPat.php" method="get">
								<div class="modal-body">
									<input type="hidden" value="'.$resultat[0].'" class="form-control" name="numpat">
								</div>
								<div class="modal-footer">
									<button type="button" id="4" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
									<button type="submit" class="btn btn-primary">Supprimer l\'enregistrement</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>';
			//ouverture boite de dialogue pour modifier;
			echo'<div class="modal" id="modif">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
						<h4 class="modal-title">Attention</h4>
						</div>
						<div class="modal-body">
							Indiquez les modifications  :			
							<form class="container modal-body" action="../../modifier/patient/modifPat.php" method="get">
								<input type="hidden" value="'.$resultat[0].'" class="form-control" name="numpat">
								<div class="form-group">
									<div>
										<label for="prenompat">Prénom du patient: </label>
											<input class="form-control" id="prenompat" placeholder="Prenom du patient" name="prenompat" value="'.$resultat[1].'">
									</div>
									<div>
										<label for="nompat">Nom du patient: </label>
											<input class="form-control" id="nompat" placeholder="Nom du patient" name="nompat" value="'.$resultat[2].'">
									</div>
									<div>
										<label for="ddn">Date de naissance du patient: </label>
											<input type=date class="form-control" id="ddn" name="ddn" value="'.$resultat[3].'">
									</div>
									<div>
										<label  for="sexe">Sexe: </label>
											<select class="form-control" name="sexe" value="'.$resultat[4].'">
											<option selected value="'.$resultat[4].'" >'.$resultat[4].'</option>';
											if ($resultat[4]==1){
											echo'<option value="2" >2</option>';}
											else{echo'<option value="1" >1</option>';}
											echo'</select>
									</div>
									<div>
										<label  for="consang">Consanguinité: </label>
											<select class="form-control" name="consang">
											<option selected value="'.$resultat[5].'" >'.$resultat[5].'</option>';
											if ($resultat[5]=='oui'){
											echo'<option value="non" >non</option>';}
											else{echo'<option value="oui" >oui</option>';}
											echo'</select>			
									</div>
									<div>
										<label for="nbame">Nb semaines d\'aménorrhée : </label>
											<input type= number min=23 max=43 class="form-control" id="nbame" name="nbame" value="'.$resultat[6].'">
									</div>
									<div>
										<label for="pdsnaiss">Poids à la naissance: </label>
											<input class="form-control" type=number id="pdsnaiss" name="pdsnaiss" value="'.$resultat[7].'">
									</div>
									<div>
										<label for="taillenaiss">Taille à la naissance: </label>
											<input class="form-control" type= number id="taillenaiss" name="taillenaiss" value="'.$resultat[8].'">
									</div>
									<div>
										<label for="pcnaiss">Périmètre cranien: </label>
										<input class="form-control" type=number id="pcnaiss" name="pcnaiss" value="'.$resultat[9].'">
									</div>
									<div class="modal-footer">
										<button type="submit" class="btn btn-primary">Modifier l\'enregistrement</button>
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			</div>

			</td>
			</tr>';
		} while ($resultat = $req->fetch());

		print'
		</table>
		</div>
		';
	} else {
		echo "Aucun patient n'a été trouvé <br/>";
	}
	$req->closeCursor() ;
}
print 
'
<form action="formConsultPatient.php" method="GET"
<div class="input-group">
<input class="btn btn-primary" type="submit" value="Rechercher un autre patient">
</div><br/>
</form>';

getEnd(3);	
?>