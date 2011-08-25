<div id="content_for_layout">
	<div id="left-bar">
    	<div id="menu">
    	<ul>
        	<li><?=anchor('keywords','Keywords') ?></li>
            <li><?=anchor('users/conversations','Conversations') ?></li>
            <li><?=anchor('users/discussions','Discussions') ?></li>
        </ul>
        </div>
    </div>
    
    <div id="main-page">
    	<div id="conversations">
        	<h3><?php echo $user; ?> And i</h3>
            <div id="conversation_box">
            	<?php echo form_open("",array("id"=>"converse")); ?>
                <textarea name="meessage" cols="40">
                </textarea>
                <input type="submit" class="submit_btn" value="Send" />
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
    
    <div id="right-bar">
    	<div id="info-box">
    		<p>Conversationns between you and other PheedBakk users</p>
    		<p>See help and support for more info</p>
        </div>
    </div>
    
</div>