<div id="content_for_layout">
	<div id="signup" class="floating">
		<?php echo form_open("users/signup",array("id"=>"signupform")); ?>
		
		<h3 class="form_title">Sign Up</h3>
		
		<label for="first_name">First Name</label>
		<input type="text" name="first_name" value="<?php echo set_value('first_name');?>">
		<div class="form_error">
			<?php echo form_error('first_name'); ?>
		</div>
		
		<label for="last_name">Last Name</label>
		<input type="text" name="last_name" value="<?php echo set_value('last_name');?>" >
		<div class="form_error">
			<?php echo form_error('last_name'); ?>
		</div>
		
		<label for="email">Email</label>
		<input type="text" name="email" value="<?php echo set_value('email');?>">
		<div class="form_error">
			<?php echo form_error('email'); ?>
		</div>
		
		<label for="emailconf">Confirm Email Address</label>
		<input type="text" name="emailconf" value="<?php echo set_value('emailconf');?>">
		<div class="form_error">
			<?php echo form_error('emailconf'); ?>
		</div>
		
		<label for="username">Username</label>
		<input type="text"  name="username" value="<?php echo set_value('username');?>">
		<div class="form_error">
			<?php echo form_error('username'); ?>
		</div>
		
		<label for="password">Password</label>
		<input type="password" name="password" value="<?php echo set_value('password');?>">
		<div class="form_error">
			<?php echo form_error('password'); ?>
		</div>
		
		<label for="passconf">Confirm Password</label>
		<input type="password" name="passconf" value="<?php echo set_value('passconf');?>">
		<div class="form_error">
			<?php echo form_error('passconf'); ?>
		</div>
        
		<label for="submit"></label>
		<input type="submit" value="Join" name="submit" class="submit_btn">
		
		<?php echo form_close(); ?>
	</div>
</div>