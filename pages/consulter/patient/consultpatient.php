<?php
	session_start();
	require "../../../tools/functionsPrint.php";
	getStart(3);
?>
	
  <h1> Consultation</h1>
  <form>

  <div class="form-group">
		<label for="numpat">Identifiant du patient :</label>
		<input type="email" class="form-control" id="numpat" aria-describedby="id">
	</div>

   <div class="form-group">
		<label for="prenom">Prénom du patient :</label>
		<input type="prenom" class="form-control" id="prenom" aria-describedby="prenom">
	</div>
	<div class="form-group">
		<label for="nom">Nom du patient :</label>
		<input type="nom" class="form-control" id="nom" aria-describedby="nom">
	</div>
	<div class="form-group">
		<label for="DDN">Date de Naissance :</label>
		<input type="date" class="form-control" id="DDN" placeholder="Password">
	  </div>
	  <div class="form-group">
		<label for="Sexe">Sexe :</label>
		<select class="form-control" id="Sexe">
		  <option>Homme</option>
		  <option>Femme</option>
		</select>
	  </div>
	  	  <div class="form-group">
		<label for="consangpar">Consanguinité parentale :</label>
		<select class="form-control" id="consangpar">
		  <option>Oui</option>
		  <option>Non</option>
		</select>
	  </div>
	  	  <div class="form-group">
		<label for="samen">Nombre de semaines d'aménorrhée :</label>
		<textarea class="form-control" id="samen" rows="1"></textarea>
	  </div>
	  <div class="form-group">
		<label for="pdsnais">Poids à la naissance :</label>
		<textarea class="form-control" id="pdsnais" rows="1"></textarea>
	  </div>
	  <div class="form-group">
		<label for="taillenais">Taille à la naissance :</label>
		<textarea class="form-control" id="taillenais" rows="1"></textarea>
	  </div>
	  <div class="form-group">
		<label for="idcentre">Numéro du centre :</label>
		<textarea class="form-control" id="idcentre" rows="1"></textarea>
	  </div>
	  Maladie :
	  <div class="form-check">
  <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="Evans" checked>
  <label class="form-check-label" for="exampleRadios1">
    Evans
  </label>
</div>
<div class="form-check">
  <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="AHAI isolée">
  <label class="form-check-label" for="exampleRadios2">
    AHAI isolée
  </label>
</div>
<button type="Valider" class="btn btn-primary">Valider</button>
  </form>
<?php
	getEnd(3)
?>