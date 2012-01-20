<!DOCTYPE html>
<html>
<head lang="en">
  <meta charset="utf-8">
  <title>UCF - Lost and Found</title>
  <link rel="stylesheet" href="<?php echo base_url(); ?>css/reset.css" />
  <link rel="stylesheet" href="<?php echo base_url(); ?>css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>css/style.css" />
  <script src="<?php echo base_url(); ?>js/jquery.js"></script>
  <script src="<?php echo base_url(); ?>js/bootstrap-modal.js"></script>
  <script src="<?php echo base_url(); ?>js/bootstrap-alerts.js"></script>
  <script src="<?php echo base_url(); ?>js/bootstrap-tabs.js"></script>
  <script src="<?php echo base_url(); ?>js/bootstrap-dropdown.js"></script>
  <script src="<?php echo base_url(); ?>js/loader.js"></script>
</head>
<body>
	<div class="container">
   
    <div class="topbar-wrapper" style="z-index: 5;">
    <div class="topbar" data-dropdown="dropdown">
	      <div class="topbar-inner">
	        <div class="container">
	          <h3 class="logo"><a href="#">Lost & Found</a></h3>
	          <ul class="nav">
	            <li class="active"><a href="#">Found Items</a></li>
	            <li><a href="#">Lost Items</a></li>
	          </ul>
	          <form class="pull-left" action="">
	            <input type="text" placeholder="Search">
	          </form>
	          <ul class="nav secondary-nav">
	            <li class="dropdown">
	              <a href="#" class="dropdown-toggle">Jaime Smeriglio</a>
	              <ul class="dropdown-menu">
	                <li><a href="#">Account Settings</a></li>
	                <li><a href="#">Preferences</a></li>
	                <li class="divider"></li>
	                <li><a href="#">Logout</a></li>
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
        <h1>Add Item</h1>
        <p>Here is a list of the items currently stored in containers. If you have found a new one: </p>
        <p><button id="add-item" data-controls-modal="add-item-modal" class="btn">Add an Item</button></p>
      </div>
      <div class="span12">
       	<h1 style="float:left;">Found Items</h1>
       	<p style="float:right;padding-top:10px;color:#A88552;"><span class="found-items-count">4</span> Items found</p>
       	<table id="employee-table" class="zebra-striped">
          <thead>
            <tr>
              <th> Item </th>
              <th> Container </th>
              <th> Location </th>
              <th> Date Found </th>
              <th> Actions </th>
            </tr>
          </thead>
          <tbody>
	          <tr>
	          	<td>White iPhone 4s</td>
	          	<td>Phones</td>
	          	<td>1st Floor</td>
	          	<td>2012-01-12</td>
	          	<td>
	          		<button data-controls-modal="edit-item-modal" data-id="1" class="btn small"><img data-controls-modal="edit-record-modal" src="images/edit.png" alt="edit" width="13" height="13" /></button>
	          		<button data-controls-modal="delete-item-modal" data-id="1" class="btn small"><img src="images/trash.png" alt="trash" width="10" height="13" /></button>
	          	</td>
	          </tr>
	          <tr>
	          	<td>Financial Accounting Concepts</td>
	          	<td>Books</td>
	          	<td>2nd Floor</td>
	          	<td>2012-01-10</td>
	          	<td>
	          		<button data-controls-modal="edit-item-modal" data-id="1" class="btn small"><img data-controls-modal="edit-record-modal" src="images/edit.png" alt="edit" width="13" height="13" /></button>
	          		<button data-controls-modal="delete-item-modal" data-id="1" class="btn small"><img src="images/trash.png" alt="trash" width="10" height="13" /></button>
	          	</td>
	          </tr>
	          <tr>
	          	<td>Gray Oakley Shades (Glasses)</td>
	          	<td>Accessories</td>
	          	<td>1st Floor</td>
	          	<td>2012-01-12</td>
	          	<td>
	          		<button data-controls-modal="edit-item-modal" data-id="1" class="btn small"><img data-controls-modal="edit-record-modal" src="images/edit.png" alt="edit" width="13" height="13" /></button>
	          		<button data-controls-modal="delete-item-modal" data-id="1" class="btn small"><img src="images/trash.png" alt="trash" width="10" height="13" /></button>
	          	</td>
	          </tr>
	          <tr>
	          	<td>Lady Gagas Virginity</td>
	          	<td>Virginities</td>
	          	<td>Her Crib</td>
	          	<td>1986-03-28</td>
	          	<td>
	          		<button data-controls-modal="edit-item-modal" data-id="1" class="btn small"><img data-controls-modal="edit-record-modal" src="images/edit.png" alt="edit" width="13" height="13" /></button>
	          		<button data-controls-modal="delete-item-modal" data-id="1" class="btn small"><img src="images/trash.png" alt="trash" width="10" height="13" /></button>
	          	</td>
	          </tr>
         </tbody>
       </table>
      </div>
    </div>
    
    <!-- Add Modal -->
		<div id="add-item-modal" class="modal fade">
		  <div class="modal-header">
		    <a href="#" class="close">x</a>
		    <h3>Add an Item</h3>
		  </div>
		  <div class="modal-body">
		    <?php echo form_open('found_items/create', 'id="create_found_item"'); ?>
		      <div class="clearfix">
		        <label for="item">Item:</label>
		        <div class="input"><input type="text" id="item" name="item" placeholder="White iPhone 4s" /></div>
		      </div>
		      <div class="clearfix">
		        <label for="container">Container:</label>
		        <div class="input">
              <select class="large" name="container" id="container">
                <option value="1">Cell Phones</option>
                <option value="2">Computers</option>
                <option value="3">Misc Electronics</option>
                <option value="4">Books</option>
                <option value="5">Wallets</option>
                <option value="6">Car Keys</option>
                <option value="7">Accessories</option>
              </select>
            </div>
		      </div>
		      <div class="clearfix">
		        <label for="location">Location Found:</label>
		        <div class="input">
              <select class="large" name="location" id="location">
                <option value="1">Lobby</option>
                <option value="2">1st Floor</option>
                <option value="3">2nd Floor</option>
              </select>
            </div>
		      </div>
		      <div class="clearfix">
		        <label for="date">Date:</label>
		        <div class = "input"> 
						  <input type="text" name="date" id="date" placeholder="yyyy-mm-dd" /> 
						</div> 
		      </div>
		    <?php echo form_close(); ?>
		  </div>
		  <div class="modal-footer">
		    <button id="create_found_item_submit_btn" class="btn primary">Add</button>
		  </div>
		</div>
		<!-- End Add Modal -->
		
		<!-- Edit Modal -->
		<div id="edit-item-modal" class="modal fade">
		  <div class="modal-header">
		    <a href="#" class="close">x</a>
		    <h3>Edit an Item</h3>
		  </div>
		  <div class="modal-body">
		    <form id="employee-form">
		      <div class="clearfix">
		        <label for="firstName">Item:</label>
		        <div class="input"><input type="text" name="firstName" placeholder="White iPhone 4s" /></div>
		      </div>
		      <div class="clearfix">
		        <label for="container">Container:</label>
		        <div class="input">
              <select class="large" name="mediumSelect" id="container">
                <option>Cell Phones</option>
                <option>Computers</option>
                <option>Misc Electronics</option>
                <option>Books</option>
                <option>Wallets</option>
                <option>Car Keys</option>
                <option>Accessories</option>
              </select>
            </div>
		      </div>
		      <div class="clearfix">
		        <label for="location">Location Found:</label>
		        <div class="input">
              <select class="large" name="mediumSelect" id="location">
                <option>Lobby</option>
                <option>1st Floor</option>
                <option>2nd Floor</option>
                <option>Books</option>
                <option>Wallets</option>
                <option>Car Keys</option>
              </select>
            </div>
		      </div>
		      <div class="clearfix">
		        <label for="role">Date:</label>
		        <div class = "input"> 
						  <input type="date" id="expires" placeholder="yyyy-mm-dd" /> 
						</div> 
		      </div>
		    </form>
		  </div>
		  <div class="modal-footer">
		    <button id="create-item" class="btn primary">Add</button>
		  </div>
		</div>
		<!-- End Edit Modal -->

  </div>
</body>
</html>