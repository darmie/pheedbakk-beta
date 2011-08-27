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
    <div id="timeline">
    	<div id="toolbar">
    		<h3>Pheed Stream</h3>
        </div>
        
    	<div id="pheed-box">
        	<?php echo form_open("",array("id"=>"pheedform")); ?>
            	<textarea name="pheed" cols="45" id="pheed">
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
</div>