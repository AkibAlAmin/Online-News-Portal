<?php  
	require_once("commonCode.php");
?>
<!DOCTYPE html>
<html>
<head>
	<title>About Us!!!</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="CSS/commonCode.css">
	<link rel="stylesheet" type="text/css" href="CSS/about.css">
</head>
<body>
	<div id="main_body">
		<?php  TITLE_LOGO(); ?>
		<?php NAVIGATION_BAR(); ?>
		<div class="card_container">
			<div class="typewritter">
				<h1>Meet The Owner</h1>
			</div>
			<div class="card">
				<img class="card_img" src="IMG/Akib.jpg" alt="Akib">
				<h1>Akib Al-Amin</h1>
				<p class="title">Student</p>
				<p>Daffodil International University - Bangladesh</p>
				<div style="margin: 24px 0;">
					<a href="https://twitter.com/Akib_AlAmin" target="_blank"><img border="0" alt="twitter" src="IMG/twitter.png" width="25" height="25"></a>  
					<a href="https://www.facebook.com/Akib.AlAmin.bd" target="_blank"><img border="0" alt="facebook" src="IMG/facebook.png" width="25" height="25"></a>
					<a href="https://www.linkedin.com/in/akibalamin/" target="_blank"><img border="0" alt="linkedin" src="IMG/linkedin.png" width="25" height="25"></a>  
				</div>
			</div>
		<?php FOOTER(); ?>
	</div>
</body>
</html>
