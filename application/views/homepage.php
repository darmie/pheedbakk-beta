<div id="content_for_layout">

	<div id="landing_page_content" class="floating">
		<div id="intro">
			<h3>Welcome to PheedBakk</h3>
			<p>PheedBakk enables you to organise and share your information based on common interests.</p>
			
			<?php echo anchor("users/signup","Sign Up",array("class"=>"submit_btn_blue")); ?>
            <?php echo anchor("help","Help And Support",array("class"=>"submit_btn_blue")); ?>
		</div>
		
			<div id="login">
			<?php echo form_open("users/login",array("id"=>"loginform")); ?>
			<label for="email">Email</label>
			<input type="text" name="email">
			<div class="form_error">
				<?php echo form_error('email'); ?>
			</div>
			
			<label for="password">Password</label>
			<input type="password" name="password">
			<div class="form_error">
				<?php echo form_error('password'); ?>
			</div>
			
			<label for="remember"></label>
			<?php echo form_checkbox('remember', '1', FALSE);?> Stay Logged In 
			
			<label for="login"></label>
			<input type="submit" value="Login" class="submit_btn" />
                <div id="login-errors">
                <?=@$message; ?>
                </div>
			<p><?php echo anchor("users/resetpassword","Forgot Your Password?"); ?></p>
			
			<?php echo form_close(); ?>
			</div>
			
	</div>
	
</div>
