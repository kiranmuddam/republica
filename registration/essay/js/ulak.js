$(function() {
  
	var ulakTimeout;
	
	ulak = function(options) {
		
		if($("#ulak-container").length) {
			ulak.close();
		}
		
		$("body").prepend("<div id='ulak-container'><div id='ulak-center'><div id='ulak-message-container'>"+options.text+"</div><div id='ulak-button-container'></div></div></div><div id='ulak-modal'></div>");
		
		switch(options.type) {
			case "error":
				$("#ulak-container").addClass("ulak-error");
				break;
			case "success":
				$("#ulak-container").addClass("ulak-success");
				break;
			case "warning":
				$("#ulak-container").addClass("ulak-warning");
				break;
			case "info":
				$("#ulak-container").addClass("ulak-info");
				break;
			default:
				$("#ulak-container").addClass("ulak-error");
		}
		
		if(options.buttons) {
			$.each(options.buttons, function(buttonID) {
				var button = options.buttons[buttonID];
				var buttonCallback = button[0].callback;
				var buttonText = button[0].text;
				var buttonID = "ulak-button"+buttonID;
				var buttonClass = button[0].className;
				$('#ulak-button-container').append("<div id='"+buttonID+"' class='ulak-button'>"+buttonText+"</div>");
				if(buttonClass) {
					$("#"+buttonID).addClass(buttonClass);
				}
				$("#"+buttonID).click(function() {
					buttonCallback();
					ulak.close();
				});
			});
		}
		
		$("#ulak-container").slideToggle("slow");
		
		if(options.modal) {
			$("#ulak-modal").fadeIn("slow");
		}
		
		if(!options.buttons) {
				$("#ulak-container").mouseenter(function() {
					ulak.close();
				});
			$("#ulak-container, #ulak-modal").click(function() {
				ulak.close();
			}); 
		}	
		
		if(options.timeout || options.timeout===false) {
			if(options.timeout!==false) {
				ulakTimeout = setTimeout("ulak.close()",options.timeout);
			}
		} else {
			ulakTimeout = setTimeout("ulak.close()",3000);
		}

	}

	ulak.close = function() {
		clearTimeout(ulakTimeout);
		$("#ulak-container:first").slideToggle("slow", function() {
			$(this).remove();
		});
		$("#ulak-modal:first").fadeOut("slow", function() {
			$(this).remove();
		});
	}
	
});