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


$('#teck').ready(function(){
	setInterval(function(){
		$("#teck").animate({left: '+=30px'}, 0);
		if($("#teck").is(':offscreen')){
			console.log("offset");
			var l = -50;
			$("#teck").css({left:l})
			//$("#chi").css({ top:50px, left: 0px});

		}
	}, 100);
});



/*
$('#chi').click(function(){
	alert("Vous venez de casser php");
});
*/

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
        cache: false,
        success : function(retour){
          console.log(retour);
          if(retour==1){
            console.log("connecté");
            $( "#formauthen" ).removeClass( "notGriffin" ).addClass( "griffin" );
            $( "#formdeco" ).removeClass( "griffin" ).addClass( "notGriffin" );
            $('#nomutil').text(donn["n"])
            console.log("remplacement form")

          }
          else if(retour==2){
            console.log("identifiants incorrects")
            alert("identifiants incorrects");

          }
          else{
            console.log("nope")
          }
          return retour;

        }
    });
});
$("#formdeco").submit(function(event){
    // arrete l'envoi
    event.preventDefault();
    //requete ajax
    $.ajax({
        type: "GET",
        cache: false,
        url: "/projet_MGM/tools/deco.php",
        success : function(retour){
          console.log(retour);
          if(retour==1){
            console.log("connecté");
            $( "#formdeco" ).removeClass( "notGriffin" ).addClass( "griffin" );
            $( "#formauthen" ).removeClass( "griffin" ).addClass( "notGriffin" );
            console.log("remplacement form")
          }
          else{
            console.log("nope")
          }
          return retour;
        },
        error :function(retour){
          console.log("Erreur");
          console.log(retour);
        },
        complete :function(retour){
          console.log("complete")
        }
    });
});

document.querySelector('#teck').addEventListener("click",()=>{
  document.querySelector("audio").play();
});
