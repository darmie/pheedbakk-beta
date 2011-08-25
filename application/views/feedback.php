<div id="content_for_layout">
	
    <div id="feedback" class="floating">
    	<div id="text">
        <p>Hello. We hope you had a nice time using PheedBakk</p>
        <p>We thought it would be nice if you could share your opinion on the site or tell us about your experience on the site, 
        your thoughts and opinions will help us improve PheedBakk for you.
        </p>
        <p>We'd loved to know you fared and how it worked for you</p>
        <p align="center">The SwitchBlade Team</p>
        </div>
        
        <div id="feedback-form">
        <h3>Give Us Your feedback</h3>
        	<?php echo form_open("",array("id"=>"feedbackform")); ?>
            <label for="email">Email</label>
            <input type="text" name="email" />
            <label for="comment">Comment</label>
            <textarea name="comment">
            </textarea>
            <label for="send"></label>
            <input type="submit" value="Send" name="Send" class="submit_btn"  />
            <div class="progress"></div>
            </div>
    </div>
    
</div>