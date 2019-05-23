<?php echo form_open('User/update_password');?>
	<div class="form-group">
	<label for="name">Old Password</label>
	<input type="password" class="form-control" id="old_password" name="old_password" placeholder="Enter your current password">

	</div>
	<div class="form-group">
	<label for="email">New Password</label>
	<input type="password" class="form-control" id="new_password" name="new_password" placeholder="Enter a new password">

	</div>
	<div class="form-group">
	<label for="message">New Password Confrim</label>
	<input type="password" class="form-control" id="new_password_confirm" name="new_password_confirm" placeholder="Re-enter the new password for confirmation">

	</div>
	<?php echo validation_errors('<p class="error">');?>
    <p class="error">
    <?php if ($bool) {
            echo $string;
        } 
    ?>
    </p>
   <?php echo form_submit('submit', 'Update',array("class"=>"btn btn-success","id"=>"submit"));?>
    
<?php echo form_close();?>
	<!-- <div class="form-group">
	</div> -->