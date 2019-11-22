<?php
	session_start();
	require "../tools/functionsPrint.php";
	getStart(1);
	?>
  <h1> Aide utilisation</h1>
  <div class="card-columns">
  <div class="card">
    <div class="card-body">
      <h5 class="card-title">Comment ajouter un élément?</h5>
      <p class="card-text">Vous devez vous rendre sur la <a href="../index.php">page d'accueil</a> et choisir ce que vous souhaitez ajouter grâce au menu Ajouter. Compléter ensuite, 	les informations 
	  de l'élément à ajouter. Attention l'élément ne peut être ajouté que lorsque certains paramètres obligatoires sont complétés.</p>
    </div>
	
  </div>
  <div class="card">
    <div class="card-body">
      <h5 class="card-title">Comment supprimer un élément?</h5>
      <p class="card-text">Vous devez vous rendre sur la <a href="../index.php">page d'accueil</a> et choisir ce que vous souhaitez supprimer grâce au menu Consulter. Compléter ensuite, 	les informations 
	  de l'élément à supprimer.</p>
    </div>
  </div>
  
  <div class="card">
    <div class="card-body">
      <h5 class="card-title">Comment supprimer un élément?</h5>
      <p class="card-text">Vous devez vous rendre sur la <a href="../index.php">page d'accueil</a> et choisir ce que vous souhaitez supprimer grâce au menu Consulter. Compléter ensuite, 	les informations 
	  de l'élément à supprimer.</p>
    </div>
  </div>
  <div class="card bg-primary text-white text-center p-3">
    <blockquote class="blockquote mb-0">
      <p>Une question? <br/> La réponse est ici.</p>
      <footer class="blockquote-footer text-white">
        <small>
          Gregory, Marc, Manon in <cite title="Source Title">SITIS</cite>
        </small>
      </footer>
    </blockquote>
  </div>
  <div class="card">
    <div class="card-body">
      <h5 class="card-title">Comment modifier une information?</h5>
<p class="card-text">Vous devez vous rendre sur la <a href="../index.php">page d'accueil</a> et choisir ce que vous souhaitez modifier grâce au menu Consulter. Compléter ensuite, 	les informations 
	  de l'élément à modifier.</p>    </div>
  </div>
  <div class="card">
    <img src="resources/chienquestion.png" class="card-img-top" alt="...">
  </div>
  <div class="card">
    <div class="card-body">
      <h5 class="card-title">Où vont mes données lorsque je les supprime?</h5>
      <p class="card-text">Lorsque vous supprimez une informations, elle n'est pas perdue. Elle est en réalité archivé dans une autre table.</p>
    </div>
  </div>
  <div class="card">
    <div class="card-body">
      <h5 class="card-title">J'ai supprimé une donnée sans le vouloir, puis-je la récupérer?</h5>
      <p class="card-text">Vous pouvez la retrouver dans une des tables d'archivages et la ré-ajouter.</p>
    </div>
  </div>
</div>
<?php
getEnd(1);
?>