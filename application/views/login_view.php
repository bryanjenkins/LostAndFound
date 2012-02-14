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
  <script src="<?php echo base_url(); ?>js/login.js"></script>
</head>
<body>
	<div id="main" class="container">
		<div class="row">
			<div class="span4"></div>
			<div class="span6">
				<div id="login-modal" class="modal fade">
				  <div class="modal-header">
				    <h3>UCF Lost & Found</h3>
				  </div>
				  <div class="modal-body">
				  	<?php echo form_open('login/validate_credentials', 'id="login_form"'); ?>
				      <div class="clearfix">
				        <label for="username">Username:</label>
				        <div class="input">
				        	<input type="text" id="username" name="username" placeholder="" />
				        </div>
				      </div>
				      <div class="clearfix">
				        <label for="password">Password:</label>
				        <div class="input">
				        	<input type="password" id="password" name="password" placeholder="" />
				        </div>
				      </div>
				    <?php echo form_close(); ?>
					</div>	
					<div class="modal-footer">
				    <button id="login_btn" class="btn primary">Login</button>
				  </div>
				</div>
			</div>
			<div class="span4"></div>
		</div>
	</div>
</body>
</html>