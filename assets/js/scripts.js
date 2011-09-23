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

	$("#addEntry > button").click(function() {
		$("#confirmBox .popUpWindowTitleBar").text( "Add New Entry" );
		$("#addContent > div > input").val( "" );

		$("#ok").text("Add");
		$("#ok").unbind('click');
		$("#ok").click(function() {
			$("#addContent").submit();
			/*
			$("#entry" + eID).remove();
			$.ajax({
				url: "./?entry=" + eID + "&action=drop",
				success: function( msg ) {  }
			});
			$("#deleteContent").hide();
			$("#confirmBox").hide();
			*/
		});

		$("#addContent").show();
		$("#confirmBox").show();
	});

	$("#cancel").click(function() {
		$("#addContent").hide();
		$("#deleteContent").hide();
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
				$("#confirmBox .popUpWindowTitleBar").text( "Confirm Deletion" );
				$("#confirmBox .popUpContent > div > span").text( $("#entry" + eID + " > span").text() );

				$("#ok").text("Delete");
				$("#ok").unbind('click');
				$("#ok").click(function() {
					$("#entry" + eID).remove();
					$.ajax({
						url: "./?entry=" + eID + "&action=drop",
						success: function( msg ) {  }
					});
					$("#deleteContent").hide();
					$("#confirmBox").hide();
				});

				$("#deleteContent").show();
				$("#confirmBox").show();
			});
		});
	}

});
