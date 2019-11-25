//js
jQuery.expr.filters.offscreen = function(el) {
  var rect = el.getBoundingClientRect();
  return (
           (rect.x + rect.width) < 0
             || (rect.y + rect.height) < 0
             || (rect.x > window.innerWidth || rect.y > window.innerHeight)
         );
};

$('#chi').ready(function(){
	setInterval(function(){
		$("#chi").animate({left: '+=30px'}, 0);
		if($("#chi").is(':offscreen')){
			console.log("offset");
			var l = -190;
			$("#chi").css({left:l})
			//$("#chi").css({ top:50px, left: 0px});

		}
	}, 310);
});


$("#formauthen").submit(function(event){
    // arrete l'envoi
    event.preventDefault();
    //recup valeurs
    const donn ={
      "n":($("#nomu").val()),
      "p":($("#motp").val())
    };
    console.log(donn);
    //requete ajax
    $.ajax({
        type: "POST",
        url: "/projet_MGM/tools/authenti.php",
        data:donn,
        success : function(retour){
          console.log(retour);
          if(retour==1){
            console.log("connecté");
            /*
            $("#formauthen").hide();
            $("#formdeco").show();
            */
            $('#formauthen').replaceWith('<form class="form-inline navbar-nav ml-auto justify-content-end" id="formdeco"><button type="submit" class="btn btn-outline-success">Se Deconnecter</button></form>');
          }
          else if(retour==2){
            console.log("identifiants incorrects")
            alert("identifiants incorrects");
          }
          else{
            console.log("nope")
          }

        }
    });
});
$("#formdeco").submit(function(event){
    // arrete l'envoi
    event.preventDefault();
    //requete ajax
    $.ajax({
        type: "GET",
        url: "/projet_MGM/tools/deco.php",
        success : function(retour){
          console.log(retour);
          if(retour==1){
            console.log("connecté");
            /*
            $("#formdeco").hide();
            $("#formauthen").show();
            */
            $('#formdeco').replaceWith('<form class="form-inline navbar-nav ml-auto" id="formauthen"><div class="form-group nav-item justify-content-end"><input class="w-25 form-control" type="text" id="nomu" required placeholder="nom utilisateur" /><input class="w-25 form-control" type="password"  id="motp" required placeholder="mot de passe" /></div>	<button type="submit" class="btn btn-primary">Se Connecter</button></form>');
          }
          else{
            console.log("nope")
          }

        }
    });
});
