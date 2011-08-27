<div id="content_for_layout">
	<div id="left-bar">
    	<div id="menu">
    	<ul>
        	<li><?=anchor('keywords','Keywords') ?></li>
            <li><?=anchor('conversations','Conversations') ?></li>
            <li><?=anchor('discussions','Discussions') ?></li>
        </ul>
        </div>
    </div>
    
    <div id="main-page">
    	<div id="conversations">
        	<h3><?php echo $reciever; ?> And i</h3>
            <div id="conversation-timeline">
            </div>
            <div id="conversation_box">
            	<?php echo form_open("",array("id"=>"converse")); ?>
                <input type="hidden" name="conv_id" value="<?php echo $conv_id; ?>" />
                <input type="hidden" name="r_id" value="<?php echo $reciever; ?>" />
                <textarea name="message" cols="40">
                </textarea><br />
                <input type="button" class="submit_btn" value="Send" onclick="post_conversation_msg()"/>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
    
    <div id="right-bar">
    	<div id="info-box">
    		<p>Conversations between you and other PheedBakk users</p>
    		<p>See help and support for more info</p>
        </div>
    </div>
    
</div>