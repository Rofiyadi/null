$(document).ready(function() {

	$("#menu").click(function() {
		$("#settings").show();
	});

	$("#settings .xImage").click(function() {
		$("#settings").hide();
	});

	$("#logout").click(function() {
		window.location = "?user&action=logout";
	});

	$("#cancel").click(function() {
		$("#confirmBox").hide();
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
				var eID = $(this).attr("data-eID");
				$("#confirmBox").show();
				$("#confirmBox .popUpContent > div > span").text( $("#entry" + eID + " > span").text() );

				$("#delete").unbind('click');
				$("#delete").click(function() {
					$("#entry" + eID).remove();
					$.ajax({
						url: "./?entry=" + eID + "&action=drop",
						success: function( msg ) {  }
					});
					$("#confirmBox").hide();
				});
			});
		});
	}

});
