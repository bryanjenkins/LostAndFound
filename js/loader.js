$(document).ready(function() { 
	
	//Testing Stuff (Delete Later)
	
	//End Testing
	
	//Variables
	var addRecordModal = $("#add-item-modal").modal({ backdrop: "static" });
 	var editRecordModal = $("#edit-item-modal").modal({ backdrop: "static" });
	
	// Create a found item
	$('#create_found_item_submit_btn').click(function(e) {
				e.preventDefault();
        var formData = {
        	add_record_item: $('#add_record_item').val(),
        	add_record_container: $('#add_record_container').val(),
        	add_record_location: $('#add_record_location').val()
        };
        
        var url = $("#create_found_item").attr('action');
                
        $.ajax({
            url:url,
            type:'post',
            cache:false,
            data:formData,
            success:function(result_id) {
                
                addRecordModal.modal("hide");
                
                //Add New Record to Table
                alert(result_id);
                
                // Reset Form Values
                $('#create_found_item').each (function(){
								  this.reset();
								});
								
								// Notify User
                notify("success", "Item Successfully Added."); 
		            }
		        });
		    });
    
    
    // Functions
    function notify(type, message) {
         $("#alert-area").append($("<div class='alert-message " + type + " fade in' data-alert><p> " + message + " </p></div>"));

       setTimeout(function () {
         $(".alert-message").fadeOut("slow", function () { this.parentNode.removeChild(this); });
       }, 2000);
     }
 	
 	
}); 