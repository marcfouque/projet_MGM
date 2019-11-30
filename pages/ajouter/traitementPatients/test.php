<?php session_start(); 
require "../../../tools/functionsPrint.php";
getStart(3);
require "../../../tools/functionsParams.php";
require "../../../tools/connect.php";
		//choix du patient
		print 
		'
		<form action="formAjoutTraitementPatient.php" method="GET"
		<h1>Choix du Patient : </h1>
		<div class="input-group">
		<select class="custom-select" id="choixid" name="choixid" aria-label="Example select with button addon">
		<option selected>ID</option>';

		$requete= "SELECT numpat FROM patient";
		$resultat=$bdd->query($requete);

		while ($ligne = $resultat->fetch()){  
			echo "<option value=".$ligne['numpat']."> ".$ligne['numpat']." </option>";
		}
		$resultat->closeCursor();
		
		echo'</select></br>
		<input class="btn btn-primary" type="submit" value="Afficher">
  		</div>
  		</form>';

if(!empty($_GET['choixid'])){
		$requete = 'SELECT * FROM `patient` WHERE patient.numpat LIKE :idpat';
		$req = $bdd->prepare($requete);
		$req->execute(array(':idpat' => $_GET['choixid']));	
		$resultat = $req->fetch();
		if($resultat){//verif si resultat
			
    echo '<div class="table-responsive">
    <table class="table table-hover">
    
    <thead>
    <tr>
	  <td>NumPat</td>
      <td>Nom</td>
      <td>Prénom</td>
      <td></td>
    </tr>
    </thead>
    ';
    
    do {//iteration sur toutes les lignes
      //debut ligne tableau
      echo'<tr>';
      echo'<td>'.$resultat[0].'</td>';
      echo'<td>'.$resultat[1].'</td>';
      echo'<td>'.$resultat[2].'</td>
	  <td>
        <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
          <button type="button" class="btn btn-secondary">Confirmer</button>
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

  print 
		//choix du traitement
'		</form>
				<form action="formAjoutTraitementPatient.php?choixid='.$_GET['choixid'].'" method="GET"
<h1>Choix du traitement </h1>
		<div class="input-group">
		<select class="custom-select" id="choixttt" name="choixttt" aria-label="Example select with button addon">
		<option selected>Traitement</option>';

		$requete= "SELECT libellettt FROM ths_traitement";
		$resultat=$bdd->query($requete);

		while ($ligne = $resultat->fetch()){  
			echo "<option value=".$ligne['libellettt']."> ".$ligne['libellettt']." </option>";
		}
		$resultat->closeCursor();
		
		echo'</select></br>
		<input class="btn btn-primary" type="submit" value="Confirmer">
  		</div>		
</form>';}

if(!empty($_GET['choixid']) AND !empty($_GET['choixttt'])){
				'<p>Vous avez choisi dajouter le traitement '.$_GET['choixttt'].' au patient '.$_GET['choixid'].'</p>';
		

}
getEnd(3);	
		?>