$(document).ready(function() { 
	
	//Testing Stuff (Delete Later)
	
	//End Testing
	
	//Variables
	var addRecordModal = $("#add-item-modal").modal({ backdrop: "static" });
 	var editRecordModal = $("#edit-item-modal").modal({ backdrop: "static" });
 	var addRecordURL = "http://localhost:8888/ucf_lostandfound/index.php/found_items/update_table_with_new_record/";
 	var deleteRecordURL = "http://localhost:8888/ucf_lostandfound/index.php/found_items/delete/"
	
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
            add_new_record(result_id);
            
            // Reset Form Values
            $('#create_found_item').each (function(){
						  this.reset();
						});
						
						// Notify User
            notify("success", "Item Successfully Added."); 
            }
     	});
	});
		
	//Delete an Item
	$('#found-items-table').delegate(".delete", "click", delete_record);	
   
    
  // Functions
  function notify(type, message) {
       $("#alert-area").append($("<div class='alert-message " + type + " fade in' data-alert><p> " + message + " </p></div>"));

     setTimeout(function () {
       $(".alert-message").fadeOut("slow", function () { this.parentNode.removeChild(this); });
     }, 2000);
   }
   
   function add_new_record(result_id) {
   	
   		url = addRecordURL + result_id.toString();
					
	 		$.ajax({
        url:url,
        dataType:'json',
        cache:false,
        success:function(new_record) {
        	
        	//Add new row to table
        	newHtmlRow = "<tr><td>"+ new_record.item +"</td><td>"+ new_record.container +"</td><td>"+ new_record.location +"</td><td>"+ new_record.date +"</td><td><button data-controls-modal=\"edit-item-modal\" data-id=\""+new_record.id+"\" class=\"btn small edit\"><img data-controls-modal=\"edit-record-modal\" src=\"images/edit.png\" alt=\"edit\" width=\"13\" height=\"13\"></button><button data-controls-modal=\"delete-item-modal\" data-id=\""+new_record.id+"\" class=\"btn small delete\"><img src=\"images/trash.png\" alt=\"trash\" width=\"10\" height=\"13\" /></button></td></tr>";    
          $('#found-items-table tbody').prepend(newHtmlRow);
          
          //Update Number of Rows Found
          old_row_count = parseInt($('#found-items-count').text());
          new_row_count = old_row_count + 1;
          
          $('#found-items-count').text(new_row_count);
          	  
       }
     });
	 
		}
		
		function delete_record(record_id)
		{
			
			record_id = $(this).data('id');
			row_being_deleted = $(this).closest('tr');
			
			confirm = confirm("Are you sure you want to delete this item?");
			
			if(confirm == true) {
								
				url = deleteRecordURL +  record_id.toString();
				
				$.ajax({
	        url:url,
	        dataType:'post',
	        cache:false,
	        complete: function(callback){
	        	row_being_deleted.slideUp(4000).remove();	
	        	//Update Number of Rows Found
	          old_row_count = parseInt($('#found-items-count').text());
	          new_row_count = old_row_count - 1;
	          
	          $('#found-items-count').text(new_row_count);
	        	
	        	notify("success", "Item Successfully Deleted."); 
	        }
	     });
				
			} else {
				return;
			}
		}
 	
}); 