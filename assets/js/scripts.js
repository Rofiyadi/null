$(document).ready(function() {

	$("#menu").click(function() {
		$("#shader").show();
		$("#settings").show();
		return false;
	});

	if ( window['elements'] != undefined )
	{
		$.each($("#elements .element"), function(index, value) {

			$(value).find(".importantButton").click(function() {
				var eID = $(this).attr("data-eID");
				$("#element" + eID + " span").toggleClass("important");
				$.ajax({
					url: "./?element=" + eID + "&action=important",
					success: function( msg ) {  }
				});
			});

			$(value).find(".doneButton").click(function() {
				var eID = $(this).attr("data-eID");
				$("#element" + eID + " span").toggleClass("done");
				$.ajax({
					url: "./?element=" + eID + "&action=done",
					success: function( msg ) {  }
				});
			});

			$(value).find(".deleteButton").click(function() {
				var answer = confirm("Delete selected element?")
				if ( !answer ) return;

				var eID = $(this).attr("data-eID");
				$("#element" + eID).remove();
				$.ajax({
					url: "./?element=" + eID + "&action=drop",
					success: function( msg ) {  }
				});
			});
		});
	}

});
