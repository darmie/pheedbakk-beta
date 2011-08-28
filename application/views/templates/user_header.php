<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?php echo $title; ?></title>
    <?php echo link_tag("assets/css/users/user-layout.css"); ?>
<script type="text/javascript" src="//localhost/pheedbak/assets/js/top_up/top_up-min.js"></script>
<script type="text/javascript" src="//localhost/pheedbak/assets/js/jquery.growl.js"></script>
<script type="text/javascript" src="//localhost/pheedbak/assets/js/jscript.js"></script> 
<!--[if lt IE 9]>
  <script type="text/javascript" src="http://stan-js.googlecode.com/hg/version/0.1/stan.min.js"></script>
<![endif]-->
</head>
<body>

<div id="header">
	<div class="logo">
		<?php echo anchor("users",img("assets/img/logo.png")); ?>
	</div>
	
    <div id="search-box">
    	<?php echo form_open("",array("id"=>"site-search")); ?>
        <input type="text" name="term" placeholder="Search">
        <input type="submit" value="Search">
        <?php echo form_close(); ?>
    </div>
    
    <div id="notifications">
    	
    </div>
    
    <div id="userbox">
    	<ul>
        	<li><?=anchor('users','Home') ?></li>
        	<li><a href="#"><?php echo $username; ?></a>
            	<ul class="sub-menu">
                	<li><?=anchor('users/profile','My Profile') ?></li>
                    <li><?=anchor('logout','Logout') ?></li>
                </ul>
            </li>
        </ul>
    </div>
    
</div>