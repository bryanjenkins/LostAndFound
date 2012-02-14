$(document).ready(function() { 
	
	//Testing Stuff (Delete Later)
	
	//End Testing
	
//----------------------------------- Variables That Can Change -------------------------------
	// Variables
	var siteurl = "http://localhost:8888/ucf_lostandfound/index.php/"
	
	var addRecordModal = $("#add-item-modal").modal({ backdrop: "static" });
	var addLocationModal = $("#add-location-modal").modal({ backdrop: "static" });
	var addContainerModal = $("#add-container-modal").modal({ backdrop: "static" });
 	var editRecordModal = $("#edit-item-modal").modal({ backdrop: "static" });
 	var claimRecordModal = $("#claim-item-modal").modal({ backdrop: "static" }).on('hide', clear_claimed_item_header);
 	
 	// Found Items
  // var addRecordURL = siteurl + "found_items/update_table_with_new_record/";
 	//var editRecordURL = siteurl + "found_items/edit_found_item/";
 	var deleteRecordURL = siteurl + "found_items/delete/";
 	var getUnclaimedFoundItemsURL = siteurl + "found_items/found_items_ajax_listener/";
 	var getClaimedFoundItemsURL = siteurl + "found_items/claimed_found_items_ajax_listener/";
 	var getExpiredFoundItemsURL = siteurl + "found_items/expired_found_items_ajax_listener/";
 	
 	var getJsonSingleFoundItemURL = siteurl + "found_items/json_get_found_item/";
 	var getJsonListOfContainersURL = siteurl + "found_items/json_containers_list/";
 	var getJsonListOfLocationsURL = siteurl + "found_items/json_locations_list/";
 
 	// Lost Items
 	// var addRecordURL = siteurl + "lost_items/update_table_with_new_record/";
 	//var editRecordURL = siteurl + "lost_items/edit_found_item/";
 	var returnLostRecordURL = siteurl + "lost_items/return_lost_item/";
 	var deleteLostRecordURL = siteurl + "lost_items/delete/";
 	var getUnclaimedLostItemsURL = siteurl + "lost_items/lost_items_ajax_listener/";
 	var getClaimedLostItemsURL = siteurl + "lost_items/returned_lost_items_ajax_listener/";
 	var getExpiredLostItemsURL = siteurl + "lost_items/expired_lost_items_ajax_listener/";
 	var getJsonSingleLostItemURL = siteurl + "lost_items/json_get_lost_item/";
 	
 	var foundItemTable;
 	var foundItemClaimedTable;
 	var expiredItemTable;
 	var lostItemTable;
 	var lostItemClaimedTable;
 	var lostExpiredItemTable;
	
	
//----------------------------------- Datatables Scripts --------------------------------------
	
	foundItemTable = $('#found-items-table').dataTable({
		"sDom": "<'row'<'span6'l><'span6'f>r>t<'row'<'span6'i><'span6'p>>",
		"bProcessing": true,
		"bServerSide": true,
		"sPaginationType": "bootstrap",
		"bAutoWidth": false,
		"aaSorting": [[ 3, "desc" ]],
		"sAjaxSource": getUnclaimedFoundItemsURL,
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
	
	foundItemClaimedTable = $('#found-items-claimed-table').dataTable({
		"sDom": "<'row'<'span6'l><'span6'f>r>t<'row'<'span6'i><'span6'p>>",
		"bProcessing": true,
		"bServerSide": true,
		"sPaginationType": "bootstrap",
		"bAutoWidth": false,
		"aaSorting": [[ 4, "desc" ]],
		"sAjaxSource": getClaimedFoundItemsURL,
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
	
	expiredItemTable = $('#expired-items-table').dataTable({
		"sDom": "<'row'<'span6'l><'span6'f>r>t<'row'<'span6'i><'span6'p>>",
		"bProcessing": true,
		"bServerSide": true,
		"sPaginationType": "bootstrap",
		"bAutoWidth": false,
		"aaSorting": [[ 4, "desc" ]],
		"sAjaxSource": getExpiredFoundItemsURL,
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
	
	// Lost Items
	
	lostItemTable = $('#lost-items-table').dataTable({
		"sDom": "<'row'<'span6'l><'span6'f>r>t<'row'<'span6'i><'span6'p>>",
		"bProcessing": true,
		"bServerSide": true,
		"sPaginationType": "bootstrap",
		"bAutoWidth": false,
		"aaSorting": [[ 4, "desc" ]],
		"sAjaxSource": getUnclaimedLostItemsURL,
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
	
	lostItemClaimedTable = $('#lost-items-claimed-table').dataTable({
		"sDom": "<'row'<'span6'l><'span6'f>r>t<'row'<'span6'i><'span6'p>>",
		"bProcessing": true,
		"bServerSide": true,
		"sPaginationType": "bootstrap",
		"bAutoWidth": false,
		"aaSorting": [[ 4, "desc" ]],
		"sAjaxSource": getClaimedLostItemsURL,
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
	
	lostExpiredItemTable = $('#lost-expired-items-table').dataTable({
		"sDom": "<'row'<'span6'l><'span6'f>r>t<'row'<'span6'i><'span6'p>>",
		"bProcessing": true,
		"bServerSide": true,
		"sPaginationType": "bootstrap",
		"bAutoWidth": false,
		"aaSorting": [[ 4, "desc" ]],
		"sAjaxSource": getExpiredLostItemsURL,
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
	
	
	
	//----------------------------------- Found Items ---------------------------------------
	
	// Create a found item
	$('#create_found_item_submit_btn').click(function(e) {
			e.preventDefault();
	    var formData = {
	    	add_record_item: $('#add_record_item').val(),
	    	add_record_container: $('#add_record_container').val(),
	    	add_record_location: $('#add_record_location').val()
	    };
	    	    	    
	    var url = $('#create_found_item').attr('action');
	            
	    $.ajax({
        url:url,
        type:'post',
        cache:false,
        data:formData,
        success:function() {
            
            addRecordModal.modal("hide");
            
            reload_found_items_table(); 
            
            // Reset Form Values
            $('#create_found_item').each (function(){
						  this.reset();
						});
						
						// Notify User
            notify("success", "New Found Item Successfully Added."); 
            }
     	});
	});
	
	//Edit a Found Item
	$('#found-items-table').delegate(".edit", "click", edit_item_record);	
	
	$('#update_found_item_submit_btn').click(function(e) {
		e.preventDefault();
		var formData = {
				edit_record_id: $('#edit_record_id').val(),
	    	edit_record_item: $('#edit_record_item').val(),
	    	edit_record_container: $('#edit_record_container').val(),
	    	edit_record_location: $('#edit_record_location').val()
	  };
	  
	  var url = $('#edit_found_item').attr('action');
	  
	  $.ajax({
        url:url,
        type:'post',
        cache:false,
        data:formData,
        success:function() {
            
            editRecordModal.modal("hide");
                        
            reload_found_items_table(); 
            
            // Reset Form Values
            $('#edit_found_item').each (function(){
						  this.reset();
						});
						
						// Notify User
            notify("success", "Item Successfully Updated."); 
            }
     	});
	  
	  
	});
	
	//Claim an Item
	$('#found-items-table').delegate(".return", "click", claim_item_record);
	
	$('#claim_found_item_submit_btn').click(function(e) {
		e.preventDefault();
		var formData = {
				claim_record_id: $('#claim_record_id').val(),
				returned_to: $('#returned_to').val(),
	    	returned_to_phone: $('#returned_to_phone').val()
	  };
	  
	  console.log(formData);
	  
	  var url = $('#claim_found_item').attr('action');
	  
	  $.ajax({
        url:url,
        type:'post',
        cache:false,
        data:formData,
        success:function() {
            
            claimRecordModal.modal("hide");
                        
            reload_found_items_table(); 
            reload_claimed_found_items_table();
            
            // Reset Form Values
            $('#claim_found_item').each (function(){
						  this.reset();
						});
						
						// Notify User
            notify("success", "Item Successfully Claimed."); 
            }
     	});
	  
	  
	});
	
	
		
	//Delete a Found Item
	$('#found-items-table').delegate(".delete", "click", delete_item_record);	
   

//----------------------------------- Lost Items ---------------------------------------
	
	// Create a Lost Item
	$('#create_lost_item_submit_btn').click(function(e) {
			e.preventDefault();
	    var formData = {
	    	add_record_item: $('#add_record_item').val(),
	    	add_record_location: $('#add_record_location').val(),
	    	add_record_name: $('#add_record_name').val(),
	    	add_record_phone: $('#add_record_phone').val(),
	    	add_record_email: $('#add_record_email').val()
	    };
	    	    	    
	    var url = $('#create_lost_item').attr('action');
	            
	    $.ajax({
        url:url,
        type:'post',
        cache:false,
        data:formData,
        success:function() {
            
            addRecordModal.modal("hide");
            
            reload_lost_items_table(); 
            
            // Reset Form Values
            $('#create_lost_item').each (function(){
						  this.reset();
						});
						
						// Notify User
            notify("success", "New Lost Item Successfully Added."); 
            }
     	});
	});
	
	//Edit a Lost Item
	$('#lost-items-table').delegate(".edit", "click", edit_lost_item_record);	
	
	$('#update_lost_item_submit_btn').click(function(e) {
		e.preventDefault();
		var formData = {
				edit_record_id: $('#edit_record_id').val(),
	    	edit_record_item: $('#edit_record_item').val(),
	    	edit_record_location: $('#edit_record_location').val(),
	    	edit_record_name: $('#edit_record_name').val(),
	    	edit_record_phone: $('#edit_record_phone').val(),
	    	edit_record_email: $('#edit_record_email').val()
	  };
	  
	  var url = $('#edit_lost_item').attr('action');
	  
	  $.ajax({
        url:url,
        type:'post',
        cache:false,
        data:formData,
        success:function() {
            
            editRecordModal.modal("hide");
                        
            reload_lost_items_table(); 
            
            // Reset Form Values
            $('#edit_lost_item').each (function(){
						  this.reset();
						});
						
						// Notify User
            notify("success", "Item Successfully Updated."); 
            }
     	});
	  
	  
	});
	
	//Return a Lost Item
	$('#lost-items-table').delegate(".return", "click", return_lost_item_record);
	
	/*
$('#claim_found_item_submit_btn').click(function(e) {
		e.preventDefault();
		var formData = {
				claim_record_id: $('#claim_record_id').val(),
				returned_to: $('#returned_to').val(),
	    	returned_to_phone: $('#returned_to_phone').val()
	  };
	  
	  console.log(formData);
	  
	  var url = $('#claim_found_item').attr('action');
	  
	  $.ajax({
        url:url,
        type:'post',
        cache:false,
        data:formData,
        success:function() {
            
            claimRecordModal.modal("hide");
                        
            reload_found_items_table(); 
            reload_claimed_found_items_table();
            
            // Reset Form Values
            $('#claim_found_item').each (function(){
						  this.reset();
						});
						
						// Notify User
            notify("success", "Item Successfully Claimed."); 
            }
     	});
	  
	  
	});
*/
	
	
		
	//Delete a Lost Item
	$('#lost-items-table').delegate(".delete", "click", delete_lost_item_record);	   
  
  //----------------------------------- Containers ---------------------------------------
  
 	// Get Json Container List Items And Add Them To The Select Element As Options
 	getJsonListAndAddItToNode(getJsonListOfContainersURL, $('#add_record_container'), "container");
 	 	
  
  // Create a Container
	$('#create_container_submit_btn').click(function(e) {
			e.preventDefault();
	    var formData = {
	    	add_container: $('#add_container').val()
	    };
	    	    	    	    
	    var url = $('#create_new_container').attr('action');
	            
	    $.ajax({
        url:url,
        type:'post',
        cache:false,
        data:formData,
        success:function() {
            
            addContainerModal.modal("hide");
                        
            // Reset Form Values
            $('#create_new_location').each (function(){
						  this.reset();
						});
						
						// Reload The Available Container List
						getJsonListAndAddItToNode(getJsonListOfContainersURL, $('#add_record_container'), "container");
						
						// Notify User
            notify("success", "New Container Successfully Added."); 
            }
     	});
	});
  

 
  //----------------------------------- Locations ---------------------------------------
  
  // Get Json Location List Items And Add Them To The Select Element As Options
 	getJsonListAndAddItToNode(getJsonListOfLocationsURL, $('#add_record_location'), "location");
  
  // Create a Location
	$('#create_location_submit_btn').click(function(e) {
			e.preventDefault();
	    var formData = {
	    	add_location: $('#add_location').val()
	    };
	    	    	    	    
	    var url = $('#create_new_location').attr('action');
	            
	    $.ajax({
        url:url,
        type:'post',
        cache:false,
        data:formData,
        success:function() {
            
            addLocationModal.modal("hide");
                        
            // Reset Form Values
            $('#create_new_location').each (function(){
						  this.reset();
						});
						
						// Reload The Available Locations List
						getJsonListAndAddItToNode(getJsonListOfLocationsURL, $('#add_record_location'), "location");
						
						// Notify User
            notify("success", "New Location Successfully Added."); 
            }
     	});
	});
    
  //----------------------------------- Functions ---------------------------------------
  function notify(type, message) {
       $("#alert-area").append($("<div class='alert-message " + type + " fade in' data-alert><p> " + message + " </p></div>"));

     setTimeout(function () {
       $(".alert-message").fadeOut("slow", function () { this.parentNode.removeChild(this); });
     }, 3000);
  }
   
  
  function edit_item_record()
  {
  	record_id = $(this).data('id');
  	
  	url = getJsonSingleFoundItemURL +  record_id.toString();
  	
  	// Populate the Container and Location Select Boxes
 		getJsonListAndAddItToNode(getJsonListOfContainersURL, $('#edit_record_container'), "container");
 		getJsonListAndAddItToNode(getJsonListOfLocationsURL, $('#edit_record_location'), "location");
 		
  	getJsonRecord(url, "edit");
 
  }
  
  function edit_lost_item_record()
  {
  	record_id = $(this).data('id');
  	
  	url = getJsonSingleLostItemURL +  record_id.toString();
  	
  	// Populate the Container and Location Select Boxes
 		getJsonListAndAddItToNode(getJsonListOfContainersURL, $('#edit_record_container'), "container");
 		getJsonListAndAddItToNode(getJsonListOfLocationsURL, $('#edit_record_location'), "location");
 		
  	getJsonLostItemRecord(url, "edit");
 
  }
  
  function claim_item_record()
  {
  	
  	id 	 = $(this).data('id');
  	item = $(this).data('name');
  	
  	$("#claim_record_id").val(id);
  	
  	$("#claimed-item-header").append("Claim: " + item);
  	
  	claimRecordModal.modal('show');
  }
  
  function clear_claimed_item_header()
  {
  	$("#claimed-item-header").empty()
  }
		
	function return_lost_item_record()
	{
		
		record_id = $(this).data('id');
		
		item_name = $(this).data('name');
		
		confirm_box = confirm("Are you sure you want to return '"+item_name+"'?");
		
		if(confirm_box == true) {
							
			url = returnLostRecordURL +  record_id.toString();
			
			console.log(record_id.toString());
			
			console.log(url);
			
			$.ajax({
        url:url,
        dataType:'post',
        cache:false,
        complete: function(callback){
        	
        	confirm_box = null;
        	
        	reload_lost_items_table();
        	reload_returned_lost_items_table();
        	
        	notify("success", item_name + " Was Successfully Returned."); 
        }
     });
			
		} else {
			return;
		}
	}	
		
	function delete_item_record()
	{
		
		record_id = $(this).data('id');
		
		item_name = $(this).data('name');
		
		confirm_box = confirm("Are you sure you want to delete '"+item_name+"'?");
		
		if(confirm_box == true) {
							
			url = deleteRecordURL +  record_id.toString();
			
			$.ajax({
        url:url,
        dataType:'post',
        cache:false,
        complete: function(callback){
        	
        	confirm_box = null;
        	
        	reload_found_items_table();
        	
        	notify("success", item_name + " Was Successfully Deleted.");  
        }
     });
			
		} else {
			return;
		}
	}
	
	function delete_lost_item_record()
	{
		
		record_id = $(this).data('id');
		
		item_name = $(this).data('name');
		
		confirm_box = confirm("Are you sure you want to delete '"+item_name+"'?");
		
		if(confirm_box == true) {
							
			url = deleteLostRecordURL +  record_id.toString();
			
			$.ajax({
        url:url,
        dataType:'post',
        cache:false,
        complete: function(callback){
        	
        	confirm_box = null;
        	
        	reload_lost_items_table();
        	
        	notify("success", item_name + " Was Successfully Deleted.");  
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
					"sAjaxSource": getUnclaimedFoundItemsURL,
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
	
	function reload_claimed_found_items_table() 
	{
		if (typeof foundItemClaimedTable == 'undefined') {
			 foundItemClaimedTable = $('#found-items-claimed-table').dataTable({
					"sDom": "<'row'<'span6'l><'span6'f>r>t<'row'<'span6'i><'span6'p>>",
					"bProcessing": true,
					"bServerSide": true,
					"sPaginationType": "bootstrap",
					"bAutoWidth": false,
					"aaSorting": [[ 4, "desc" ]],
					"sAjaxSource": getClaimedFoundItemsURL,
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
		 		foundItemClaimedTable.fnClearTable( 0 );
				foundItemClaimedTable.fnDraw();
		 }
	}
	
	function reload_lost_items_table() 
	{
		if (typeof lostItemTable == 'undefined') {
				lostItemTable = $('#found-items-table').dataTable({
					"sDom": "<'row'<'span6'l><'span6'f>r>t<'row'<'span6'i><'span6'p>>",
					"bProcessing": true,
					"bServerSide": true,
					"sPaginationType": "bootstrap",
					"bAutoWidth": false,
					"aaSorting": [[ 3, "desc" ]],
					"sAjaxSource": getUnclaimedLostItemsURL,
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
		 		lostItemTable.fnClearTable( 0 );
				lostItemTable.fnDraw();
		 }
	}
	
	function reload_returned_lost_items_table() 
	{
		if (typeof lostItemClaimedTable == 'undefined') {
			 lostItemClaimedTable = $('#found-items-claimed-table').dataTable({
					"sDom": "<'row'<'span6'l><'span6'f>r>t<'row'<'span6'i><'span6'p>>",
					"bProcessing": true,
					"bServerSide": true,
					"sPaginationType": "bootstrap",
					"bAutoWidth": false,
					"aaSorting": [[ 4, "desc" ]],
					"sAjaxSource": getClaimedLostItemsURL,
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
		 		lostItemClaimedTable.fnClearTable( 0 );
				lostItemClaimedTable.fnDraw();
		 }
	}
	
	function getJsonListAndAddItToNode(url, node, type) 
	{
		
		$.getJSON(url, function(data) {
		  
		  node.empty();			  
		
			if (type === "container") {
			  $.each(data, function(key, val) {
			    node.append('<option value="' + val.id + '">' + val.container + '</option>');
			  });
		  } else if (type === "location") {
		  	$.each(data, function(key, val) {
			    node.append('<option value="' + val.id + '">' + val.location + '</option>');
			  });
		  } else {
		  	node.parent().append('There was an error loading…')
		  }
		
		});
	}
	
	function getJsonRecord(url, type)
	{
		
		$.getJSON(url, function(data) {
						
			if (type == "edit") {
				
				//console.log("Item: "+data.item+"  Container: "+data.container+"  Location: "+data.location);
				$("#edit_record_id").val(data.id);
				$("#edit_record_item").val(data.item);
				$("#edit_record_container").val(data.container);
				$("#edit_record_location").val(data.location);
			
			}
				
		});
	}
	
	function getJsonLostItemRecord(url, type)
	{
		
		$.getJSON(url, function(data) {
						
			if (type == "edit") {
				
				//console.log("Item: "+data.item+"  Container: "+data.container+"  Location: "+data.location);
				$("#edit_record_id").val(data.id);
				$("#edit_record_item").val(data.item);
				$("#edit_record_location").val(data.location);
				$("#edit_record_name").val(data.name);
				$("#edit_record_phone").val(data.phone);
				$("#edit_record_email").val(data.email);
			
			}
				
		});
	}
	
 	
}); 