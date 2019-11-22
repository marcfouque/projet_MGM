<?php
	session_start();
	require "tools/functionsPrint.php";
	getStart();
	?>
<div class="card-deck mx-auto w-50">
  <div class="card">
    <img src="resources/dossier.png" class="card-img-top" alt="logo dossier">
    <div class="card-body">
      <h5 class="card-title">AJOUTER</h5>
      <p class="card-text">Ajouter un élément à la base</p>
    </div>
	<ul class="list-group list-group-flush">
    <li class="list-group-item"> <a href="#" >Nouveau Traitement</a></li>
    <li class="list-group-item"><a href="#"  >Nouvel Examen</a></li>
		<li class="list-group-item"><a href="#"  >Traitement à un Patient</a></li>
		<li class="list-group-item"><a href="#"  >Examen à un Patient</a></li>
  </ul>
  </div>
  <div class="card">
    <img src="resources/patient.png" class="card-img-top" alt="logo patient">
    <div class="card-body">
      <h5 class="card-title">CONSULTER</h5>
      <p class="card-text">Consulter ou modifier la base de données</p>
    </div>
	  <ul class="list-group list-group-flush">
    	<li class="list-group-item"> <a href="pages/consulter/patient/consultpatient.php" >Patient</a></li>
	    <li class="list-group-item"><a href="#"  >Examen</a></li>
	    <li class="list-group-item"><a href="#"  >Centre</a></li>
		  <li class="list-group-item"><a href="#"  >Traitement</a></li>
  	</ul>
	</div>
</div>
  <?php
  getEnd()
  ?>
