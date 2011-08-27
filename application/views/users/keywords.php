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
    	<div id="keywords">
    		<div id="toolbar">
    			<h3>Your Keywords</h3>
    			<a href="#keyword_form" class="submit_btn"
                 toptions="type=dom,height=200,width=300,effect = fade,overlayClose = 1,shaded=1">
              	Add Keyword
                </a>
    		</div>
    		<div id="user_keywords">
    		</div>
    	</div>
    	<div id="keyword_form" class="hidden-inline-form">
    		<?php echo form_open("",array("id"=>"newKeyword"));?>
    		<?php echo form_label("Enter a keyword","keyword");?>
    		<?php echo form_input("keyword",""); ?>
            <input class="submit_btn" type="submit" value="Save" />
    		<?php echo form_close();?>
            <div id="progress">
            </div>
    	</div>
    </div>
    
    <div id="right-bar">
    	<div id="info-box">
    		<p>Keywords are the major way of sharing and recieving information on PheedBakk</p>
    		<p>You can manage your keywords here</p>
        </div>
    </div>
    
</div>