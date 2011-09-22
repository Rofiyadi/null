$(document).ready(function() {

	$("#menu").click(function() {
		$("#popUpShader").show();
	});
	
	$("#settings .xImage").click(function() {
		$("#popUpShader").hide();
	});

	if ( window['entries'] != undefined )
	{
		$.each($("#entries .entry"), function(index, value) {

			$(value).find(".importantButton").click(function() {
				var eID = $(this).attr("data-eID");
				$("#entry" + eID + " span").toggleClass("important");
				$.ajax({
					url: "./?entry=" + eID + "&action=important",
					success: function( msg ) {  }
				});
			});

			$(value).find(".doneButton").click(function() {
				var eID = $(this).attr("data-eID");
				$("#entry" + eID + " span").toggleClass("done");
				$.ajax({
					url: "./?entry=" + eID + "&action=done",
					success: function( msg ) {  }
				});
			});

			$(value).find(".deleteButton").click(function() {
				var answer = confirm("Delete selected entry?")
				if ( !answer ) return;

				var eID = $(this).attr("data-eID");
				$("#entry" + eID).remove();
				$.ajax({
					url: "./?entry=" + eID + "&action=drop",
					success: function( msg ) {  }
				});
			});
		});
	}

});
