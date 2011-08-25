<html>
<body>
<div>
	<img src="//pheedbakk.com/beta/assets/img/logo.png" alt="PheedBakk Logo" />
</div>
	<h1>Activate account for <?php echo $identity;?></h1>
	<p>Please click this link to <?php echo anchor('users/activate/'. $id .'/'. $activation, 'Activate Your Account');?>.</p>
</body>
</html>