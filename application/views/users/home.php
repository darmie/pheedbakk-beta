<div id="content_for_layout">
	<div id="left-bar">
       <div id="menu">
    	<ul>
         <li><?=anchor('users','Pheed Stream',array("class"=>"pheed_icon_16")) ?></li>
        <li><?=anchor('keywords','Keywords',array("class"=>"keyword_icon")) ?></li>
        <li><?=anchor('conversations','Conversations',array("class"=>"conservation_icon")) ?></li>
        <li><?=anchor('discussions','Discussions',array("class"=>"discussion_icon")) ?></li>
        <li><?=anchor('users/invite','Invite',array("class"=>"invite_icon")) ?></li>
        </ul>
        </div>
    </div>
    
    <div id="main-page">
    <div id="timeline">
    	<div id="toolbar">
    		<h3 class="pheed_icon">Pheed Stream</h3>
            <?=anchor("pheeds/favourites","Favourtite Pheeds",array("title"=>"Click to see your favourite pheeds")) ?>
        </div>
        
    	<div id="pheed-box">
        	<?php echo form_open("",array("id"=>"pheedform")); ?>
            	<textarea name="pheed" cols="50" id="pheed">
                </textarea><br />
                <input type="submit" value="Pheed" class="submit_btn" />
            <?php echo form_close(); ?>
            <div id="status">
            </div>
        </div>
        
        <div id="pheed-stream">
        	
        </div>
        
        </div>
        
    </div>
    
    <div id="right-bar">
    	<div id="info-box">
        	<p>Welcome to Pheedbakk</p>
            <p>This is your pheed stream</p>
            <p>It display pheeds you want see</p>
            <p>Visit the help and support section to get started</p>
        </div>
    </div>
    
    <div id="user-info-popup" style="display:none">
    </div>
</div>