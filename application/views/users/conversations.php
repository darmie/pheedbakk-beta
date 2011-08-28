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
    	<div id="conversations">
        	<h3>Your Conversations</h3>
            <div id="conversations-toolbar">
            </div>
            <div id="user_conversations">
          	<?php if(count($messages) < 1 ): ?>
            <p>You have no conversations</p>
            <?php endif; ?>
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