$(document).ready(function() { 
	
	//Testing Stuff (Delete Later)
	
	//End Testing
	
//----------------------------------- Variables That Can Change -------------------------------
	// Variables
	var siteurl = "http://localhost:8888/ucf_lostandfound/index.php/"
	var addRecordModal = $("#add-item-modal").modal({ backdrop: "static" });
 	var editRecordModal = $("#edit-item-modal").modal({ backdrop: "static" });
 	var addRecordURL = siteurl + "found_items/update_table_with_new_record/";
 	var deleteRecordURL = siteurl + "found_items/delete/";
 	var getFoundItemsURL = siteurl + "found_items/found_items_ajax_listener/";
 	var foundItemTable;
	
	
//----------------------------------- Datatables Scripts --------------------------------------
	
	foundItemTable = $('#found-items-table').dataTable({
		"sDom": "<'row'<'span6'l><'span6'f>r>t<'row'<'span6'i><'span6'p>>",
		"bProcessing": true,
		"bServerSide": true,
		"sPaginationType": "bootstrap",
		"bAutoWidth": false,
		"aaSorting": [[ 3, "desc" ]],
		"sAjaxSource": getFoundItemsURL,
		"fnServerData": function (aSource, aoData, fnCallback) {
			$.ajax({
				"dataType": "json",
				"type": "POST",
				"url": aSource,
				"data": aoData,
				"success": fnCallback
			});
		}
	});
	 
	

//----------------------------------- Tabs Scripts --------------------------------------------

	$('.found_tabs').tabs()

	
//----------------------------------- CRUD Ajax Scripts ---------------------------------------
	
	
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
        success:function() {
        	
        	reload_found_items_table(); 
          	  
       }
     });
	 
		}
		
		function delete_record(record_id)
		{
			
			record_id = $(this).data('id');
			
			confirm_box = confirm("Are you sure you want to delete this item?");
			
			if(confirm_box == true) {
								
				url = deleteRecordURL +  record_id.toString();
				
				$.ajax({
	        url:url,
	        dataType:'post',
	        cache:false,
	        complete: function(callback){
	        	
	        	confirm_box = null;
	        	
	        	reload_found_items_table();
	        	
	        	notify("success", "Item Successfully Deleted."); 
	        }
	     });
				
			} else {
				return;
			}
		}
		
		function reload_found_items_table() 
		{
			if (typeof foundItemTable == 'undefined') {
					foundItemTable = $('#found-items-table').dataTable({
						"sDom": "<'row'<'span6'l><'span6'f>r>t<'row'<'span6'i><'span6'p>>",
						"bProcessing": true,
						"bServerSide": true,
						"sPaginationType": "bootstrap",
						"bAutoWidth": false,
						"aaSorting": [[ 3, "desc" ]],
						"sAjaxSource": getFoundItemsURL,
						"fnServerData": function (aSource, aoData, fnCallback) {
							$.ajax({
								"dataType": "json",
								"type": "POST",
								"url": aSource,
								"data": aoData,
								"success": fnCallback
							});
						}
					});
			 } else {
			 		foundItemTable.fnClearTable( 0 );
					foundItemTable.fnDraw();
			 }
		}
 	
}); 