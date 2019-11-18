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
	}, 300);
});