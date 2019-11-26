

<form action = "scriptConsultationTraitement.php" method = "POST">
	<label><input type = "text" name="user"></label></br>
	<input type="submit" value="Rechercher">
	</form>

	<?php
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
				//print des noms colonnes
		foreach($colonnes as $c)echo'<th scope="col">'.$c.'</th>';
		print'
			</tr>
		</thead>
		';
		do {//iteration sur toutes les lignes
			//debut ligne tableau
			echo'<tr>';
			for($i=0;$i<count($colonnes)-1;$i++){
				echo'<td>'.$resultat[$i].'</td>';
			}
			print'
			<td>
				<div class="btn-group" role="group" aria-label="Button group with nested dropdown">
					<button type="button" class="btn btn-secondary">Modifier</button>
					<button type="button" class="btn btn-secondary">Supprimer</button>
				</div>
			</td>
			';
			//fin ligne tableau
			echo'</tr>';
		} while ($resultat = $req->fetch());

		print'
		 </table>
	 </div>
		';


	?>
