<!DOCTYPE html>
<html>
<head lang="en">
  <meta charset="utf-8">
  <title>UCF - Lost and Found</title>
  <link rel="stylesheet" href="<?php echo base_url(); ?>css/reset.css" />
  <link rel="stylesheet" href="<?php echo base_url(); ?>css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>css/style.css" />
  <script src="<?php echo base_url(); ?>js/jquery.js"></script>
  <script src="<?php echo base_url(); ?>js/jquery.dataTables.min.js"></script>
  <script src="<?php echo base_url(); ?>js/bootstrap-modal.js"></script>
  <script src="<?php echo base_url(); ?>js/bootstrap-alerts.js"></script>
  <script src="<?php echo base_url(); ?>js/bootstrap-tabs.js"></script>
  <script src="<?php echo base_url(); ?>js/bootstrap-dropdown.js"></script>
  <script src="<?php echo base_url(); ?>js/bootstrap-twipsy.js"></script>
  <script src="<?php echo base_url(); ?>js/bootstrap-paging.js"></script>
  <script src="<?php echo base_url(); ?>js/loader.js"></script>
</head>
<body>
	<div id="main" class="container">
   
    <div class="topbar-wrapper" style="z-index: 5;">
    <div class="topbar" data-dropdown="dropdown">
	      <div class="topbar-inner">
	        <div class="container">
	          <h3 class="logo"><a href="#">Lost & Found</a></h3>
	          <ul class="nav">
	            <li><a href="<?php echo base_url(); ?>">Found Items</a></li>
	            <li class="active"><a href="#">Lost Items</a></li>
	            <li><a href="#">Accounts</a></li>
	          </ul>
	          <ul class="nav secondary-nav">
	            <li class="dropdown">
	              <a href="#" class="dropdown-toggle"><?php echo $name ?></a>
	              <ul class="dropdown-menu">
	                <li><a href="#">Add New Account</a></li>
	                <li class="divider"></li>
	                <li><a href="#" data-controls-modal="add-container-modal">Add a Container</a></li>
	                <li><a href="#" data-controls-modal="add-location-modal">Add a Location</a></li>
	                <li class="divider"></li>
	                <li><a href="lost_items/logout">Logout</a></li>
	              </ul>
	            </li>
	          </ul>
	        </div>
	      </div><!-- /topbar-inner -->
	    </div><!-- /topbar -->
	  </div>
	  
	  <!-- Notification Area -->
		<div class="row">
      <div class="span16" id="alert-area">
      </div>
    </div>
    <!-- End Notification Area -->
	  
    <div class="row">
      <div class="span4">
        <h1>Add Lost Item</h1>
        <p>Here is a list of the items currently stored in containers. If you have found a new one: </p>
        <p><button id="add-item" data-controls-modal="add-item-modal" class="btn">Add Lost Item</button></p>
        <!--
<p>If the container does not exist: </p>
        <p><button id="add-item" data-controls-modal="add-container-modal" class="btn">Add a Container</button></p>
        <p>Or, if the location does not exist: </p>
        <p><button id="add-item" data-controls-modal="add-location-modal" class="btn">Add a Location</button></p>
-->
      </div>
      <div class="span12">
       	<ul class="tabs" data-tabs="tabs" >
       		<li class="active"><a href="#lost_items">Missing Items</a></li>
  				<li><a href="#claimed_items">Returned Items</a></li>
  				<li><a href="#expired_items">Expired Items</a></li>
       	</ul>
       	<div class="pill-content">
				  <div class="active" id="lost_items">
				  	<table id="lost-items-table" class="datatable zebra-striped">
					     <thead>
					      <tr>
						       <th class="sorting">Item</th>
						       <th class="sorting">Location</th>
						       <th class="sorting">Owner's Name</th>
						       <th class="sorting">Owner's Phone</th>
						       <th class="sorting">Date Found</th>
						       <th>Actions</th>
						      </tr>
						    </thead>
						   	<tbody>
						     	<tr>
										<td colspan="5" class="dataTables_empty">Loading...</td>
									</tr>
					     	</tbody>
		    		</table>
				  </div>
				  <div id="claimed_items">
				  	<table id="lost-items-claimed-table" class="datatable zebra-striped">
					     <thead>
					      <tr>
						       <th class="sorting">Item</th>
						       <th class="sorting">Owner's Name</th>
						       <th class="sorting">Owner's Phone</th>
						       <th class="sorting">Returned By</th>
						       <th class="sorting">Returned Date</th>
						      </tr>
						    </thead>
						   	<tbody>
						     	<tr>
										<td colspan="5" class="dataTables_empty">Loading...</td>
									</tr>
					     	</tbody>
		    		</table>
				  </div>
				  <div id="expired_items">
				  	<table id="lost-expired-items-table" class="datatable zebra-striped">
					     <thead>
					      <tr>
						       <th class="sorting">Item</th>
						       <th class="sorting">Location</th>
						       <th class="sorting">Owner's Name</th>
						       <th class="sorting">Owner's Phone</th>
						       <th class="sorting">Expired On</th>
						      </tr>
						    </thead>
						   	<tbody>
						     	<tr>
										<td colspan="5" class="dataTables_empty">Loading...</td>
									</tr>
					     	</tbody>
		    		</table>
				  </div>
				</div>
      </div>
    </div>
    
    <!-- Add Item Modal -->
		<div id="add-item-modal" class="modal fade">
		  <div class="modal-header">
		    <a href="#" class="close">x</a>
		    <h3>Add an Item</h3>
		  </div>
		  <div class="modal-body">
		    <?php echo form_open('lost_items/create_lost_item', 'id="create_lost_item"'); ?>
		      <div class="clearfix">
		        <label for="add_record_item">Item:</label>
		        <div class="input">
		        	<input type="text" id="add_record_item" name="add_record_item" placeholder="White iPhone 4s" />
		        </div>
		      </div>
		      <div class="clearfix">
		        <label for="add_record_location">Location Found:</label>
		        <div class="input">
              <select class="large" name="add_record_location" id="add_record_location"></select>
            </div>
		      </div>
		      <div class="clearfix">
		        <label for="add_record_name">Owner's Name:</label>
            <div class="input">
            	<input type="text" id="add_record_name" name="add_record_name" placeholder="John Doe" />
            </div>
		     	</div>
		      <div class="clearfix">
		        <label for="add_record_phone">Owner's Phone:</label>
		        <div class="input">
              <input type="text" id="add_record_phone" name="add_record_phone" placeholder="(555) 555-5555" />
            </div>
		      </div>
		      <div class="clearfix">
		        <label for="add_record_email">Owner's Email:</label>
		        <div class="input">
              <input type="text" id="add_record_email" name="add_record_email" placeholder="email@gmail.com" />
            </div>
		      </div>
		    <?php echo form_close(); ?>
		  </div>
		  <div class="modal-footer">
		    <button id="create_lost_item_submit_btn" class="btn primary">Add</button>
		  </div>
		</div>
		<!-- End Add Item Modal -->
		
		<!-- Add Add Location Modal -->
		<div id="add-location-modal" class="modal fade">
		  <div class="modal-header">
		    <a href="#" class="close">x</a>
		    <h3>Add a Location</h3>
		  </div>
		  <div class="modal-body">
		    <?php echo form_open('found_items/create_location', 'id="create_new_location"'); ?>
		      <div class="clearfix">
		        <label for="add_location">Location Name:</label>
		        <div class="input"><input type="text" id="add_location" name="add_location" placeholder="Lobby" /></div>
		      </div>
		    <?php echo form_close(); ?>
		  </div>
		  <div class="modal-footer">
		    <button id="create_location_submit_btn" class="btn primary">Add</button>
		  </div>
		</div>
		<!-- End Add Location Modal -->
		
		<!-- Add Add Container Modal -->
		<div id="add-container-modal" class="modal fade">
		  <div class="modal-header">
		    <a href="#" class="close">x</a>
		    <h3>Add a Container</h3>
		  </div>
		  <div class="modal-body">
		    <?php echo form_open('found_items/create_container', 'id="create_new_container"'); ?>
		      <div class="clearfix">
		        <label for="add_container">Container Name:</label>
		        <div class="input"><input type="text" id="add_container" name="add_container" placeholder="Cell Phones" /></div>
		      </div>
		    <?php echo form_close(); ?>
		  </div>
		  <div class="modal-footer">
		    <button id="create_container_submit_btn" class="btn primary">Add</button>
		  </div>
		</div>
		<!-- End Add Container Modal -->
		
		<!-- Edit Item Modal -->
		<div id="edit-item-modal" class="modal fade">
		  <div class="modal-header">
		    <a href="#" class="close">x</a>
		    <h3>Edit an Item</h3>
		  </div>
		  <div class="modal-body">
		    <?php echo form_open('lost_items/update_lost_item', 'id="edit_lost_item"'); ?>
		      <input type="hidden" name="edit_record_id" id="edit_record_id" value="" /> 
		      <div class="clearfix">
		        <label for="edit_record_item">Item:</label>
		        <div class="input">
		        	<input type="text" id="edit_record_item" name="edit_record_item" placeholder="White iPhone 4s" />
		        </div>
		      </div>
		      <div class="clearfix">
		        <label for="edit_record_location">Location Found:</label>
		        <div class="input">
              <select class="large" name="edit_record_location" id="edit_record_location"></select>
            </div>
		      </div>
		      <div class="clearfix">
		        <label for="edit_record_name">Owner's Name:</label>
            <div class="input">
            	<input type="text" id="edit_record_name" name="edit_record_name" placeholder="John Doe" />
            </div>
		     	</div>
		      <div class="clearfix">
		        <label for="edit_record_phone">Owner's Phone:</label>
		        <div class="input">
              <input type="text" id="edit_record_phone" name="edit_record_phone" placeholder="(555) 555-5555" />
            </div>
		      </div>
		      <div class="clearfix">
		        <label for="edit_record_email">Owner's Email:</label>
		        <div class="input">
              <input type="text" id="edit_record_email" name="edit_record_email" placeholder="email@gmail.com" />
            </div>
		      </div>
		    <?php echo form_close(); ?>
		  </div>
		  <div class="modal-footer">
		    <button id="update_lost_item_submit_btn" class="btn primary">Update</button>
		  </div>
		</div>
		<!-- End Edit Item Modal -->
		
		<!-- Claim Item Modal -->
		<div id="claim-item-modal" class="modal fade">
		  <div class="modal-header">
		    <a href="#" class="close">x</a>
		    <h3 id="claimed-item-header"></h3>
		  </div>
		  <div class="modal-body">
		    <?php echo form_open('lost_items/claim_found_item', 'id="claim_found_item"'); ?>
		      <input type="hidden" name="claim_record_id" id="claim_record_id" value="" /> 
		      <div class="clearfix">
		        <label for="returned_to">Returned To:</label>
		        <div class="input"><input type="text" id="returned_to" name="returned_to" placeholder="John Doe" /></div>
		      </div>
		      <div class="clearfix">
		        <label for="returned_to_phone">Phone #:</label>
		        <div class="input">
              <input type="text" name="returned_to_phone" id="returned_to_phone" placeholder="555-555-5555" />
            </div>
		      </div>
		    <?php echo form_close(); ?>
		  </div>
		  <div class="modal-footer">
		    <button id="claim_found_item_submit_btn" class="btn primary">Update</button>
		  </div>
		</div>
		<!-- End Claim Item Modal -->

  </div>
</body>
</html>