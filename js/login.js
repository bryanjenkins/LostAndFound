$(document).ready(function() { 

var loginModal = $("#login-modal").modal({ backdrop: "static" });

loginModal.modal("show");


// Create a found item
	$('#login_btn').click(function(e) {
		
		$("form").submit();
	
	});

});
