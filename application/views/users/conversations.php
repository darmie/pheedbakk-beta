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
        	<h3>Your Conversations</h3>
            <div id="user_conversations">
            <?php foreach($conversations as $gist): ?>
            	<p>Between me and <?=$gist['reciever_id'] ?></p>
            <?php endforeach; ?>
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